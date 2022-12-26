<?php
/*
* UserEncounterController.php - Controller file
*
* This file is part of the UserEncounter User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Event\Controllers;

use App\Exp\Base\BaseController;
use App\Exp\Support\CommonUnsecuredPostRequest;
use App\Exp\Components\Event\UserEncounterEngine;
use Request;
use Auth;
use DB;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\User\Models\UserProfile;
// form Requests
use App\Exp\Support\CommonPostRequest;
use App\Exp\Components\Event\UserEngine;
use App\Exp\Support\CommonTrait;
use App\Exp\Components\Event\Models\Event;
use App\Exp\Components\Event\Models\InterestedUser;
use App\Exp\Components\Event\Models\EventLikeDislike;
use App\Exp\Components\UserSetting\Models\UserPhotosModel;
use App\Exp\Components\Notification\Models\NotificationModel;


class EventController extends BaseController
{

    /**
     * @var  UserSettingRepository $userSettingRepository - UserSetting Repository
     */
    protected $userSettingRepository;

    /**
     * @var CommonTrait - Common Trait
     */
    use CommonTrait;

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return round($miles * 1.609344);
        } else if ($unit == "N") {
            return round($miles * 0.8684);
        } else {
            return round($miles);
        }
    }


    public function index(CommonUnsecuredPostRequest $request)
    {
        
        $id = Auth::user()->_id; 
        $user = UserProfile::where('users__id', $id)->get()->first();
        // $events = Event::where('status','1')->get();
        $events = Event::select('users.username','users._uid as UID', 'users.gender_selection', 'user_profiles.dob', 'user_profiles.profile_picture', 'user_profiles.city', 'events.*', 'event_like_dislikes.event_id')
            ->leftJoin('users', 'users._id', '=', 'events.user_id')
            ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
            ->leftJoin('event_like_dislikes', 'event_like_dislikes.event_id', '=', 'events._id');
    
        $events->where('events.status', '1');
        if (isset($request->meet_type)) {
            $events->where('events.meet_type', $request->meet_type);
        }
        if (isset($request->verified_users)) {
            $events->where('users.is_verified', 1);
        }

        if (isset($request->video_verification)) {
            $events->where('users.video_verify', 1);
        }

        if (isset($request->social_verification)) {
            $events->where('users.facebook_verify', 1);
        }

        if (isset($request->location)) {
            $locationArea = preg_replace('/[^a-zA-Z0-9_ -]/s', ' ', $request->location);
            $events->where('events.location', 'like', "%$locationArea%");
        }

        if (isset($request->created_at)) {
            $events->where('events.created_at', date("Y-m-d h:i:s", strtotime($request->created_at)));
        }

        if ($request->short_by == 'newest') {

            $events->orderBy('events.created_at', 'desc');
        }
        
        $eventsData = $events->orderBy('events.created_at', 'desc')->paginate(50);

        if ($request->distance) {
            $distance = $request->distance;
        } else {
            $distance = '2';
        }

        if ($request->short_by == 'nearest') {

            $distance = '1';
        }

        $username = User::where('_id',$id)->first();
        // return $username->gender_selection;
            if ($distance) {
                $res = array();
                $dataEvents = array();
                foreach ($eventsData as  $value) {
                    // return $value->gender_selection;
                    if($username->gender_selection!=$value->gender_selection){

                    $UserPhotosModel = UserPhotosModel::where('users__id', $value['user_id'])->get();
                    $userProfileImagesData = array();
                    if ($UserPhotosModel) {
                        
                        foreach ($UserPhotosModel as $key => $images) {
                            $userProfileImages['file'] = $images->file;
                            $userProfileImages['users__id'] = $images->users__id;
    
                            $userProfileImages['extantion_type'] = $images->extantion_type;
                            $userProfileImages['type'] = $images->type;
                            $userProfileImages['_uid'] = $images->_uid;
                            $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
                            $userProfileImagesData[] = $userProfileImages;
                        }
                    }
                    $userProfileGet = UserProfile::where('users__id', $value['user_id'])->get()->first();
    
                    if (!empty($userProfileImagesData)) {
    
                        $userProfileImagesData = array(0 => array('file' => $userProfileGet['profile_picture'], 'extantion_type' => 'jpg', 'type' => '1', '_uid' => $value['UID'])) + $userProfileImagesData;
                    }
    
    
                    $res = array();
                    $getDistanceKM =  $this->distance($user->location_latitude, $user->location_longitude, $value['location_latitude'], $value['location_longitude'], 'K');
                    if ($value) {
                        $active_status_time = $this->getUserOnlineStatusAgo($value['created_at']);
                    } else {
                        $active_status_time = '';
                    }
    
    
                    if ($getDistanceKM >= $distance) {
    
                        $user_block_users = DB::table('user_block_users')->where('to_users__id', $value['user_id'])->where('by_users__id', Auth::user()->_id)->first();
                        if (empty($user_block_users)) {
                            $dataArray['event_id']  = $value['event_id'];
                            $dataArray['auth_id']  = $id;
    
                            $dataArray['user_photos']['photos']  = $userProfileImagesData;
                            $dataArray['_uid'] = $value['_uid'];
                            $dataArray['_id'] = $value['_id'];
                            $dataArray['UID'] = $value['UID'];
                            $dataArray['profile_picture'] = $value['profile_picture'];
                            $dataArray['title']  = $value['title'];
                            $dataArray['meet_type']  = $value['meet_type'];
    
                            $dataArray['event_date']  = $value['event_date'];
    
                            $dataArray['created_at']  = $value['created_at'];
                            $dataArray['location']  = $value['location'];
                            $dataArray['image']  = $value['image'];
                            $dataArray['description']  = $value['description'];
                            $dataArray['block_user']  = $value['block_user'];
                            $dataEvents[] = $dataArray;
                        }
                    }
                }
            }
            } else {
                $dataEvents = array();
            }
        

        $citydata = $user->city;
        $selectedFilter = [];
        $selectedFilter['meet_type'] = $request->meet_type;
        $selectedFilter['location'] = $request->location;
        $selectedFilter['created_at'] = $request->created_at;
        $totalCount = count($dataEvents);
        // $userProfileGet = UserProfile::where('users__id',$user['_id'])->get();

        $UserBock = User::all();
        return view('events.index', compact('eventsData', 'dataEvents', 'selectedFilter', 'totalCount', 'citydata', 'UserBock'));
    }

    public function viewEvent(Request $request)
    {
        if (isset($_GET['id'])) {

            $event = Event::select('users.username', 'users._id as UserID','users._uid as UID', 'user_profiles.dob', 'user_profiles.profile_picture', 'user_profiles.city', 'events.*')
                ->leftJoin('users', 'users._id', '=', 'events.user_id')
                ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
                ->where('events._id', $_GET['id'])
                ->first();

            $id = Auth::user()->_id;
            if (isset($event)) {

                $UserPhotosModel = UserPhotosModel::where('users__id', $event->UserID)->get();
                if ($UserPhotosModel) {
                    $userProfileImagesData = array();
                    foreach ($UserPhotosModel as $key => $images) {
                        $userProfileImages['file'] = $images->file;
                        $userProfileImages['users__id'] = $images->users__id;

                        $userProfileImages['extantion_type'] = $images->extantion_type;
                        $userProfileImages['type'] = $images->type;
                        $userProfileImages['_uid'] = $images->_uid;
                        $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
                        $userProfileImagesData[] = $userProfileImages;
                    }
                }


                $userProfileGet = UserProfile::where('users__id', $event->UserID)->get()->first();
                $user = UserProfile::where('users__id', $id)->get()->first();


                if (isset($userProfileGet['profile_picture'])) {
                    $files =  $userProfileGet['profile_picture'];
                } else {
                    $files =  '';
                }
                $userProfileImagesData = array(0 => array('file' => $files, 'extantion_type' => 'jpg', 'type' => '1', '_uid' => $event->UID)) + $userProfileImagesData;
                if (isset($userProfileGet->city)) {
                    $citydata =  $userProfileGet->city;
                } else {
                    $citydata =  '';
                }

                $citydata =  $citydata;
                $UserBock = User::all();
                // return $userProfileImagesData;
                return view('events.viewevent', compact('event', 'citydata', 'user', 'userProfileImagesData', 'UserBock'));
            }
        }
    }

    public function viewEvents(Request $request){
        // $id = Auth::user()->_id;
        // $event = Event::where('user_id',$id)->get();
        // return view('events.eventviews');

        // if (isset($_GET['id'])) {
            $get = Event::get();
            // return $get;
            $id = Auth::user()->_id;
            $event = Event::select('users.username', 'users._id as UserID','users._uid as UID', 'user_profiles.dob', 'user_profiles.profile_picture', 'user_profiles.city', 'events.*')
                ->leftJoin('users', 'users._id', '=', 'events.user_id')
                ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
                ->where('user_id',$id)
                ->get();
        
            // return $id; 
            if (isset($event)) {
                // return $event;
                $UserPhotosModel = UserPhotosModel::where('users__id', $id)->get();
                if ($UserPhotosModel) {
                    $userProfileImagesData = array();
                    foreach ($UserPhotosModel as $key => $images) {
                        $userProfileImages['file'] = $images->file;
                        $userProfileImages['users__id'] = $images->users__id;

                        $userProfileImages['extantion_type'] = $images->extantion_type;
                        $userProfileImages['type'] = $images->type;
                        $userProfileImages['_uid'] = $images->_uid;
                        $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
                        $userProfileImagesData[] = $userProfileImages;
                    }
                }


                $userProfileGet = UserProfile::where('users__id', $id)->get()->first();
                $user = UserProfile::where('users__id', $id)->get()->first();


                if (isset($userProfileGet['profile_picture'])) {
                    $files =  $userProfileGet['profile_picture'];
                } else {
                    $files =  '';
                }
                foreach($event as $events){
                    // return $events->UID;
                    $userProfileImagesData = array(0 => array('file' => $files, 'extantion_type' => 'jpg', 'type' => '1', '_uid' => $events->UID)) + $userProfileImagesData;
                    if (isset($userProfileGet->city)) {
                        $citydata =  $userProfileGet->city;
                    } else {
                        $citydata =  '';
                    }
                }
                $citydata =  $citydata;
                $UserBock = User::all();
                // return $userProfileImagesData;
                return view('events.eventviews', compact('event', 'citydata', 'user', 'userProfileImagesData', 'UserBock'));
            }
        // }
    }

    public function addEvent(CommonUnsecuredPostRequest $request)
    {


        $getUserUID = getUserUID();

        if (!file_exists(public_path('/media-storage/event/' . getUserUID()))) {
            mkdir(public_path('/media-storage/event/' . $getUserUID), 0777, true);
        }

        if (isset($request->image)) {

            $imagePublic = $request->image;
            $userPublicImage = rand() . time() . '.' . $imagePublic->getClientOriginalExtension();
            // $destinationPath = public_path('/media-storage/event/'.$getUserUID.'/');
            $destinationPath = public_path('/media-storage/events/');
            $imagePublic->move($destinationPath, $userPublicImage);
            $uploadDone = true;

            $uploadedFileName = $userPublicImage;
        }
        $id = Auth::user()->_id;
        $_uid = Auth::user()->_uid;
        $usersEvent = new Event;
        // $usersEvent->image =  $userPublicImage;
        $usersEvent->title =  $request->title;
        $usersEvent->user_id =  $id;
        $usersEvent->location =  $request->location;
        $usersEvent->event_date =  date('Y-m-d', strtotime($request->event_date));
        $usersEvent->meet_type =  $request->meet_type;
        $usersEvent->location_latitude =  $request->location_latitude;
        $usersEvent->location_longitude =  $request->location_longitude;
        $usersEvent->description =  $request->description;
        $usersEvent->_uid =  $_uid;
        if (isset($request->block_user)) {
            $usersEvent->block_user   = implode(',', $request->block_user);
        }
        $usersEvent->save();

        userActivity($_uid, $id, 'event-added', $request->meet_type, 1, $usersEvent->_id);

        return json_encode(array('status' => 'success'));
    }

    public function interestedUser(CommonUnsecuredPostRequest $request)
    {

        $id = Auth::user()->_id;
        $InterestedUser = new InterestedUser;
        $InterestedUser->user_id = $id;
        $InterestedUser->event_id = $request->event_id;
        $InterestedUser->save();

        $UpdateDetails = Event::where('_id', '=',  $request->event_id)->first();
        $UpdateDetails->InterestedUser = 1;
        $UpdateDetails->save();

        // add notify 
        $event_iddata = Event::where('_id', $request->event_id)->get()->first();
        $getUserDetails = getUserDetails($event_iddata['user_id']);
        $slug = 'event/interested';
        $message = 'Event interested By ' . Auth::user()->username;
        $uid = $getUserDetails->_uid;
        $status = 1;
        $action = url('/') . '/@' . $getUserDetails->username;
        $is_read = 0;
        $users__id = $event_iddata['user_id'];
        notificationUserLog($uid, $slug, $status, $message, $action, $is_read, $users__id, "");

        return json_encode(array('status' => 'success'));
    }


    public function userLikeDislike($toUserUid, $like)
    {
        $id = Auth::user()->_id;


        $View = DB::table('event_like_dislikes')->where('to_user_like', $id)->where('event_id', $toUserUid)->first();

        if (isset($View)) {


            //  DB::table('event_like_dislikes')->where('by_user_like', $toUserUid)->update(['like' => $like]);
            DB::table('event_like_dislikes')->delete($View->id);

            return json_encode(array('status_remove' => 'delete'));
        } else {



            $View_add = array('user_id' => Auth::id(), 'by_user_like' => $toUserUid, 'to_user_like' => $id, 'event_id' => $toUserUid, 'like' => $like);
            DB::table('event_like_dislikes')->insert($View_add);


            return json_encode(array('status' => 'success'));
        }
    }
}
