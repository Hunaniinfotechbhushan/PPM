<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Member\Controllers;

use App\Exp\Components\Bookmarks\Repositories\UserSettingRepository;



use App\Exp\Base\BaseController;
use Illuminate\Http\Request;
use App\Exp\Support\Utils;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\User\Models\UserProfile;
use App\Exp\Support\CommonTrait;
use App\Exp\Components\User\Models\LikeDislikeModal;
use App\Exp\Components\User\Models\MemberView;
use App\Exp\Components\Messenger\Models\ChatModel;
use DB;
use Auth;
use Carbon\Carbon;
use App\Exp\Components\User\Models\UserTag;
use App\Exp\Components\User\Models\AnnualIncome;
use App\Exp\Components\User\Models\Ethnicity;
use App\Exp\Components\User\Models\Education;
use App\Exp\Components\User\Models\Occupation;
use App\Exp\Components\User\Models\RelationshipStatus;
use App\Exp\Components\User\Models\BodyType;
use App\Exp\Components\User\Models\NetWorth;
use App\Exp\Components\UserSetting\Models\UserSettingModel;
use App\Exp\Components\UserSetting\Models\UserPhotosModel;
use App\Exp\Components\Bookmarks\Models\BookMarks;
use App\Exp\Components\Member\Models\ReportUser;
use App\Exp\Components\Member\Models\ImageShowRequest;

class MemberController extends BaseController
{
 /**
     * @var  UserSettingRepository $userSettingRepository - UserSetting Repository
     */
    protected $userSettingRepository;

      /**
     * @var CommonTrait - Common Trait
     */
    use CommonTrait;


public function getUserProfile($userName)
{
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $User = User::where('_uid',end($uriSegments))->first();
    $id = Auth::user()->_id;
   // View user

      $View = DB::table('member_view')->where('to_view_id', $User['_id'])->where('by_view_id', $id)->first();
      if($View){
         DB::table('member_view')->where('to_view_id', $User['_id'])->update(['updated_at' => Carbon::now()]);
    }else{
       $View_add = array('user_id' => Auth::id(),'by_view_id' => $id, 'to_view_id'=> $User['_id']);
       DB::table('member_view')->insert($View_add);
    }
 // Populaer user

     $popular_member = DB::table('popular_member')->where('to_user_id', $User['_id'])->first();
      if($popular_member){
        
         DB::table('popular_member')->where('to_user_id', $User['_id'])->increment('popular');
         ///DB::table('popular_member')->whereId(Auth::user()->_id)->increment('popular');
    }else{
       $popular_member_add = array('users__id' => Auth::id(),'by_user_id' => $id, 'to_user_id'=> $User['_id'],'popular'=> 1,'_uid'=> $User['_uid']);
       DB::table('popular_member')->insert($popular_member_add);
    }

     // Check chat is avaliable

    $checkChat = ChatModel::where('from_users__id',Auth::id())->where('to_users__id',$User['_id'])->first();
    if (empty($checkChat)) {
            $conversation = 0;
    }else{
        $conversation = 1;
    }

        $UserProfile = UserProfile::where('users__id',$User['_id'])->first();
        $UserImage = UserPhotosModel::select("*")
         ->where("users__id", "=", $User['_id'])
         ->get();
         $ImageShowRequest = ImageShowRequest::where('request_status','2')->where('sender_id',$id)->with('userPhotos')->first();
    // return $ImageShowRequest['userPhotos'];
            $BookMarks = BookMarks::where('user_id',$User['_id'])->first();
            $LikeDislike = LikeDislikeModal::where('to_users__id',$User['_id'])->first();

          if($User['gender_selection']== 1){

             $UserProfile_details = UserProfile::query()
                    ->select(
                        'user_profiles.*',
                        'net_worth.name as user_net_worth',
                        'annual_income.name as user_annual_income',
                        'body_type.name as user_body_type',
                        'ethnicity.name as user_ethnicity',
                        'education.name as user_education',
                        'relationship_status.name as user_relationship_status',
                        'users.interest_selection',
                        'hair_color.name as user_hair_color',
                        'eye_color.name as user_eye_color',
                        'users.username',
                        'users._id as user_id'
                    )
                    ->join('users', 'users._id', '=', 'user_profiles.users__id')
                    ->join('net_worth', 'net_worth._id', '=', 'user_profiles.net_worth')
                    ->join('annual_income', 'annual_income._id', '=', 'user_profiles.income')
                    ->join('body_type', 'body_type._id', '=', 'user_profiles.body_type')
                    ->join('ethnicity', 'ethnicity._id', '=', 'user_profiles.ethnicity')
                    ->join('education', 'education._id', '=', 'user_profiles.education')
                    ->join('relationship_status', 'relationship_status._id', '=', 'user_profiles.relationship_status')
                    ->join('hair_color', 'hair_color._id', '=', 'user_profiles.hair_color')
                    ->join('eye_color', 'eye_color._id', '=', 'user_profiles.eye_color')
                    ->where('user_profiles.users__id', '=', $User['_id'])
                    ->first();

          }else{

             $UserProfile_details = UserProfile::query()
                    ->select(
                        'user_profiles.*',
                        'body_type.name as user_body_type',
                        'ethnicity.name as user_ethnicity',
                        'education.name as user_education',
                        'relationship_status.name as user_relationship_status',
                        'users.interest_selection',
                        'hair_color.name as user_hair_color',
                        'eye_color.name as user_eye_color',
                        'users.username',
                        'users._id as user_id'
                    )
                    ->join('users', 'users._id', '=', 'user_profiles.users__id')
                    ->join('body_type', 'body_type._id', '=', 'user_profiles.body_type')
                    ->join('ethnicity', 'ethnicity._id', '=', 'user_profiles.ethnicity')
                    ->join('education', 'education._id', '=', 'user_profiles.education')
                    ->join('relationship_status', 'relationship_status._id', '=', 'user_profiles.relationship_status')
                    ->join('hair_color', 'hair_color._id', '=', 'user_profiles.hair_color')
                    ->join('eye_color', 'eye_color._id', '=', 'user_profiles.eye_color')
                    ->where('user_profiles.users__id', '=', $User['_id'])
                    ->first();
          }

                    $userViewedYou = MemberView::where('by_view_id',$User['_id'])->first();
                    
                    if(isset($userViewedYou )){
                        $user_viewed_you_time = $this->getUserOnlineStatusAgo($userViewedYou['updated_at']);  
                    }else{
                        $user_viewed_you_time = '';
                    }

                    $youViewed = MemberView::where('by_view_id',Auth::user()->_id)->first();
                    if($youViewed){
                      $you_view_time = $this->getUserOnlineStatusAgo($youViewed['updated_at']); 
                    }else{
                       $you_view_time = ""; 
                    }

                   $user_activity = array('user_viewed_you_time' => $user_viewed_you_time,'you_view_time' => $you_view_time);
         // echo "<pre>";
         // print_r($user_activity);
         // die;
        $user___id=$User['_id'];
        $userAge = isset($UserProfile_details->dob) ? Carbon::parse($UserProfile_details->dob)->age : null;
        // return $id;
        // return ;
          
    return view('member/profile-visitor',compact('ImageShowRequest','User','UserImage','UserProfile','BookMarks','LikeDislike','UserProfile_details','user___id','userAge','user_activity','conversation'));
}

    public function reportUser(request  $request){

        $id = Auth::user()->_id;

        $ReportUser = new ReportUser;
        $ReportUser->reason  = $request->report_reason;
        $ReportUser->for_users__id  = $request->user_id;
        $ReportUser->by_users__id  = $id;
        $ReportUser->moderated_by_users__id  = $id;
        
        $ReportUser->save();

        return json_encode(array('status'=> 'success'));

    }

    public function imageApprover(Request $request)
    {
        
        $ImageShowRequest = New ImageShowRequest;
        $ImageShowRequest->reciver_id = $request->reciver_id;
        $ImageShowRequest->sender_id = $request->sender_id;
        $ImageShowRequest->request_status = $request->request_status;
        $ImageShowRequest->save();

        $getUserDetails = getUserDetails($request->sender_id);
        $slug = 'image_show/approve';
        $message = $getUserDetails->username.' have Sent You Request for show your Private Images.';   
        $uid = $getUserDetails->_uid;   
        $status = 1; 
        $action = url('/').'/@'.$getUserDetails->username;
        $is_read = 0;
        $users__id = $request->reciver_id;

        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

        return json_encode(array('status'=> 'success'));
    }

    public function updateImageApprover(Request $request)
    {
        $imageApprover = ImageShowRequest::where('_id',$request->image_id)->first();
        // return $imageApprover;
        if($request->status == 'Active'){
            $status = '2';
        }else{
            $status = '1';  
        }
        $imageApprover->request_status = $status;
        $imageApprover->update();
    
        // return $imageApprover->reciver_id;
        $getUserDetails = getUserDetails($imageApprover->reciver_id);
        $slug = 'image_show/approve/user';   
        $message = 'Your Request Approver by'.$getUserDetails->username. 'To Show There Private Images';   
        $uid = $getUserDetails->_uid;   
        $status = 1; 
        $action = url('/').'/@'.$getUserDetails->username;
        $is_read = 0;
        $users__id = $imageApprover->sender_id;
        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

        return json_encode(array('status'=> 'success'));
    }

}