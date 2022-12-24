<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Activity\Controllers;

use App\Exp\Components\Bookmarks\Repositories\UserSettingRepository;
use App\Exp\Base\BaseController;
use Illuminate\Http\Request;
use App\Exp\Support\Utils;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\Activity\Models\Activity;
use App\Exp\Components\User\Models\UserProfile;
use App\Exp\Support\CommonTrait;
use App\Exp\Components\User\Models\MemberView;
use DB;
use Auth;
use Carbon\Carbon;
use App\Exp\Components\Member\Models\ReportUser;
use App\Exp\Components\Story\Models\Story;

class ActivityController extends BaseController
{
  use CommonTrait;
  public function index()
  {


       $getAllstories = Story::where('status',0)->get();
        if (!$getAllstories->isEmpty()) {
            foreach ($getAllstories as $key => $value) {
             if(Carbon::now()->subMinutes(1440)->toDateTimeString() > $value->created_at){        
              Story::where('id', $value->id)->delete();
            }
        }
    }


$getFavUser = DB::table('like_dislikes')->where('by_users__id',Auth::user()->_id)->get();
$getUserId = array();
if($getFavUser){
    foreach ($getFavUser as $key => $value) {
      $getUserId[] = $value->to_users__id;
    }
}


$userInterestedArray =  explode(',', Auth::user()->interest_selection);

$user_local_activity = Activity::join('users', 'users._id', '=', 'activity.user_id')
                  ->join('user_profiles', 'user_profiles.users__id', '=', 'activity.user_id')
                  ->where('activity.status',1)
                  ->whereIn('users.gender_selection',$userInterestedArray)
                  ->select(
                    'users.*',
                    'user_profiles.profile_picture',
                    'activity.user_id',
                    'activity.slug',
                    'activity.activity_log',
                     'activity.event_id',
                    'activity.status as activity_status',
                    'activity.created_at as activity_created_at',
                        )
                  ->orderBy('.activity.created_at','DESC')
                  ->paginate(10);

                  $user_fav_activity = Activity::join('users', 'users._id', '=', 'activity.user_id')
                  ->join('user_profiles', 'user_profiles.users__id', '=', 'activity.user_id')
                  ->where('activity.status',1)
                 ->whereIn('users.gender_selection',$userInterestedArray)
                  ->whereIn('users._id',$getUserId)
                  ->select(
                    'users.*',
                    'user_profiles.profile_picture',
                    'activity.user_id',
                    'activity.slug',
                    'activity.activity_log',
                    'activity.event_id',
                    'activity.status as activity_status',
                    'activity.created_at as activity_created_at',
                        )
                  ->orderBy('.activity.created_at','DESC')
                  ->paginate(10);

                 $getUserStory = Story::join('users', 'users._id', '=', 'story.users_id')
                  ->join('user_profiles', 'user_profiles.users__id', '=', 'story.users_id')
                 // ->whereIn('users.gender_selection',$userInterestedArray)
                  ->where('story.status',0)
                  ->select(
                    'users.*',
                    'user_profiles.profile_picture',
                    'story.type',
                    'story.file',
                    'story.video_thumbnail',
                    'story.view',
                    'story.created_at as story_created_at',
                        )
                  ->orderBy('.story.created_at','DESC')
                  ->paginate(50);



return view('activity.activity',compact('user_local_activity','user_fav_activity','getUserStory'));

}

public function getFullUserDetails($user_id){
    return $UserProfile_details = UserProfile::query()
    ->select(
        'user_profiles.*',
        'net_worth.name as user_net_worth',
        'annual_income.name as user_annual_income',
        'body_type.name as user_body_type',
        'ethnicity.name as user_ethnicity',
        'education.name as user_education',
        'relationship_status.name as user_relationship_status',
        'users.*',
        'users._id as main_user_id',
        'users._uid as main_user_uid',
    )
    ->join('users', 'users._id', '=', 'user_profiles.users__id')
    ->join('net_worth', 'net_worth._id', '=', 'user_profiles.net_worth')
    ->join('annual_income', 'annual_income._id', '=', 'user_profiles.income')
    ->join('body_type', 'body_type._id', '=', 'user_profiles.body_type')
    ->join('ethnicity', 'ethnicity._id', '=', 'user_profiles.ethnicity')
    ->join('education', 'education._id', '=', 'user_profiles.education')
    ->join('relationship_status', 'relationship_status._id', '=', 'user_profiles.relationship_status')
    ->where('user_profiles.users__id', '=', $user_id)
    ->first();
}

}