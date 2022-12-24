<?php
/*
* HomeController.php - Controller file
*
* This file is part of the Home component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Home\Controllers;
use App\Exp\Components\UserSetting\Repositories\UserSettingRepository;
use App\Exp\Components\User\Repositories\UserRepository;
use App\Exp\Components\UserSetting\UserSettingEngine;
use Carbon\Carbon;
use Auth;
use DB;
use App\Exp\Base\BaseController; 
use App\Exp\Components\Home\HomeEngine;
use App\Exp\Components\User\UserEncounterEngine;
use App\Exp\Components\Filter\FilterEngine;
use App\Exp\Support\CommonUnsecuredPostRequest;
use App\Exp\Components\Pages\ManagePagesEngine;

use App\Exp\Components\User\Models\UserProfile;

use App\Exp\Components\User\Models\User;
use App\Exp\Support\CommonTrait;

class HomeController extends BaseController 
{    


     /**
     * @var CommonTrait - Common Trait
     */
     use CommonTrait;

    /**
     * @var UserRepository - User Repository
     */
    protected $userRepository;
    /**
     * @var  HomeEngine $homeEngine - Home Engine
     */
    protected $homeEngine;

    /**
     * @var  UserEncounterEngine $userEncounterEngine - UserEncounter Engine
     */
    protected $userEncounterEngine;
    
    /**
     * @var  FilterEngine $filterEngine - Filter Engine
     */
    protected $filterEngine;

    /**
     * @var  ManagePagesEngine $managepageEngine - Manage Pages Engine
     */
    protected $managepageEngine;

    /**
      * Constructor
      *
      * @param  HomeEngine $homeEngine - Home Engine
      * @param  ManagePagesEngine $managepageEngine - Manage Pages Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(
        HomeEngine $homeEngine,
        UserEncounterEngine $userEncounterEngine,
        FilterEngine $filterEngine,
        ManagePagesEngine $managepageEngine,
        UserSettingRepository $userSettingRepository,
        UserRepository $userRepository,
        UserSettingEngine $userSettingEngine
    )
    {
        $this->homeEngine           = $homeEngine;
        $this->userEncounterEngine 	= $userEncounterEngine;
        $this->filterEngine         = $filterEngine;
        $this->managepageEngine         = $managepageEngine;
        $this->userSettingRepository = $userSettingRepository;
        $this->userRepository        = $userRepository;
        $this->userSettingEngine     = $userSettingEngine;
    }

    /**
     * View Home Page
     *---------------------------------------------------------------- */


    public function index()
    {
     
        $userInterestedArray =  explode(',', Auth::user()->interest_selection);
        $UserProfilefeature = UserProfile::select('users._uid as UID','users.*','user_profiles.*')
        ->leftJoin('users', 'users._id', '=', 'user_profiles.users__id')
        ->where('user_profiles.is_featured', '=', 1)
        ->whereIn('users.gender_selection',$userInterestedArray)

        ->limit(4)
        ->get();
        $filterData = [];
        foreach ($UserProfilefeature as $filter) {
            // echo '<pre>';
            // print_r($filter);
          
            $userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
            $gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;
            $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos($filter->users__id);
            $userProfileImagesData = array();
            if($userPhotoCollection){
             foreach ($userPhotoCollection as $key => $images) {
              $userProfileImages['file'] = $images->file;
              $userProfileImages['type'] = $images->type;
              $userProfileImages['_uid'] = $images->_uid;
              $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
              $userProfileImagesData[] = $userProfileImages;
          }
      }

      
      $user_block_users = DB::table('user_block_users')->where('to_users__id', $filter->users__id)->where('by_users__id', Auth::user()->_id)->first();
      if(empty($user_block_users)){

       $filterData[] = [
        'id'            => $filter->_id,
        'uid'      => $filter->UID,
        'username'      => $filter->username,
        'fullName'      => $filter->first_name.' '.$filter->last_name,
        'profileImage'  =>$filter->profile_picture,
        'totalPhotto'  => $userPhotoCollection->count(),
        'userPhottoLists'  => $userProfileImagesData,
        'gender'        => $gender,
        'dob'           => $filter->dob,
        'city'           => $filter->city,
        'heading'           => $filter->heading,
        'user_uid'           => $filter->user_uid,
        'user_id'           => $filter->user_id,
        'body_type_name'           => $filter->body_type_name,
        'ethnicity_name'           => $filter->ethnicity_name,
        'height'           => $filter->height,
        'userAge'       => $userAge,
        'countryName'   => $filter->countryName,
        'userOnlineStatus' => $this->getUserOnlineStatus($filter->user_authority_updated_at),
        'userOnlineStatusAgo' => $this->getUserOnlineStatusAgo($filter->user_authority_updated_at),
        'isPremiumUser'     => isPremiumUser($filter->user_id),
        'detailString'  => implode(", ", array_filter([$userAge, $gender]))
    ];
}
}

// New User
$userInterestedArray =  explode(',', Auth::user()->interest_selection);
$NewUser = UserProfile::select('users._uid as UID','users.*','user_profiles.*')
->leftJoin('users', 'users._id', '=', 'user_profiles.users__id')
->orderBy('users.created_at', 'desc')
->whereIn('users.gender_selection',$userInterestedArray)
->limit(4)
->get();

$filterDataNewUser = [];
foreach ($NewUser as $filter) {
    $userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
    $gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;
    $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos($filter->users__id);
    $userProfileImagesData = array();
    if($userPhotoCollection){
     foreach ($userPhotoCollection as $key => $images) {
      $userProfileImages['file'] = $images->file;
      $userProfileImages['type'] = $images->type;
      $userProfileImages['_uid'] = $images->_uid;
      $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
      $userProfileImagesData[] = $userProfileImages;
  }
}


$user_block_users = DB::table('user_block_users')->where('to_users__id', $filter->users__id)->where('by_users__id', Auth::user()->_id)->first();
if(empty($user_block_users)){

   $filterDataNewUser[] = [
    'id'            => $filter->_id,
    'uid'      => $filter->UID,
    'username'      => $filter->username,
    'fullName'      => $filter->first_name.' '.$filter->last_name,
    'profileImage'  =>$filter->profile_picture,
    'totalPhotto'  => $userPhotoCollection->count(),
    'userPhottoLists'  => $userProfileImagesData,
    'gender'        => $gender,
    'dob'           => $filter->dob,
    'city'           => $filter->city,
    'heading'           => $filter->heading,
    'user_uid'           => $filter->user_uid,
    'user_id'           => $filter->user_id,
    'body_type_name'           => $filter->body_type_name,
    'ethnicity_name'           => $filter->ethnicity_name,
    'height'           => $filter->height,
    'userAge'       => $userAge,
    'countryName'   => $filter->countryName,
    'userOnlineStatus' => $this->getUserOnlineStatus($filter->user_authority_updated_at),
    'userOnlineStatusAgo' => $this->getUserOnlineStatusAgo($filter->user_authority_updated_at),
    'isPremiumUser'     => isPremiumUser($filter->user_id),
    'detailString'  => implode(", ", array_filter([$userAge, $gender]))
];
}
}
// Online User
$userInterestedArray =  explode(',', Auth::user()->interest_selection);
$OnlineUser = UserProfile::select('users._uid as UID','users.*','user_profiles.*','user_authorities.updated_at as loginstatus','user_authorities.*')
->leftJoin('users', 'users._id', '=', 'user_profiles.users__id')
->leftJoin('user_authorities', 'user_authorities.users__id', '=', 'users._id')
->whereIn('users.gender_selection',$userInterestedArray)
->limit(10)
->get();
$filterDataOnline = [];
foreach ($OnlineUser as $filter) {

  
    $userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
    $gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;
    $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos($filter->users__id);
    $userProfileImagesData = array();
    if($userPhotoCollection){
     foreach ($userPhotoCollection as $key => $images) {


      $userProfileImages['file'] = $images->file;
      $userProfileImages['type'] = $images->type;
      $userProfileImages['_uid'] = $images->_uid;
      $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
      $userProfileImagesData[] = $userProfileImages;
  }
}
$online_user = $this->getUserOnlineStatus($filter->loginstatus);


if($online_user == 1){
    $user_block_users = DB::table('user_block_users')->where('to_users__id', $filter->users__id)->where('by_users__id', Auth::user()->_id)->first();
    if(empty($user_block_users)){

       $filterDataOnline[] = [
        'id'            => $filter->_id,
        'uid'      => $filter->UID,
        'username'      => $filter->username,
        'fullName'      => $filter->first_name.' '.$filter->last_name,
        'profileImage'  =>$filter->profile_picture,
        'totalPhotto'  => $userPhotoCollection->count(),
        'userPhottoLists'  => $userProfileImagesData,
        'gender'        => $gender,
        'dob'           => $filter->dob,
        'city'           => $filter->city,
        'heading'           => $filter->heading,
        'user_uid'           => $filter->user_uid,
        'user_id'           => $filter->user_id,
        'body_type_name'           => $filter->body_type_name,
        'ethnicity_name'           => $filter->ethnicity_name,
        'height'           => $filter->height,
        'userAge'       => $userAge,
        'countryName'   => $filter->countryName,
        'userOnlineStatus' => $this->getUserOnlineStatus($filter->loginstatus),
        'userOnlineStatusAgo' => $this->getUserOnlineStatusAgo($filter->user_authority_updated_at),
        'isPremiumUser'     => isPremiumUser($filter->user_id),
        'detailString'  => implode(", ", array_filter([$userAge, $gender]))
    ];
}
}
}

    //Recent User
$userInterestedArray =  explode(',', Auth::user()->interest_selection);
$RecentUser = UserProfile::select('users._uid as UID','users.*','user_profiles.*','user_authorities.updated_at as loginstatus','user_authorities.*')
->leftJoin('users', 'users._id', '=', 'user_profiles.users__id')
->leftJoin('user_authorities', 'user_authorities.users__id', '=', 'users._id')
->whereIn('users.gender_selection',$userInterestedArray)
->orderBy('users.created_at', 'desc')
->limit(4)
->get();
$filterDataRecentUser = [];
foreach ($RecentUser as $filter) {

  
    $userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
    $gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;
    $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos($filter->users__id);
    $userProfileImagesData = array();
    if($userPhotoCollection){
     foreach ($userPhotoCollection as $key => $images) {


      $userProfileImages['file'] = $images->file;
      $userProfileImages['type'] = $images->type;
      $userProfileImages['_uid'] = $images->_uid;
      $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
      $userProfileImagesData[] = $userProfileImages;
  }
}
$online_user = $this->getUserOnlineStatus($filter->loginstatus);


if($online_user == 1 || $online_user == 2 || $online_user == 3 || $online_user == 4){
    $user_block_users = DB::table('user_block_users')->where('to_users__id', $filter->users__id)->where('by_users__id', Auth::user()->_id)->first();
    if(empty($user_block_users)){

       $filterDataRecentUser[] = [
        'id'            => $filter->_id,
        'uid'      => $filter->UID,
        'username'      => $filter->username,
        'fullName'      => $filter->first_name.' '.$filter->last_name,
        'profileImage'  =>$filter->profile_picture,
        'totalPhotto'  => $userPhotoCollection->count(),
        'userPhottoLists'  => $userProfileImagesData,
        'gender'        => $gender,
        'dob'           => $filter->dob,
        'city'           => $filter->city,
        'heading'           => $filter->heading,
        'user_uid'           => $filter->user_uid,
        'user_id'           => $filter->user_id,
        'body_type_name'           => $filter->body_type_name,
        'ethnicity_name'           => $filter->ethnicity_name,
        'height'           => $filter->height,
        'userAge'       => $userAge,
        'countryName'   => $filter->countryName,
        'userOnlineStatus' => $this->getUserOnlineStatus($filter->loginstatus),
        'userOnlineStatusAgo' => $this->getUserOnlineStatusAgo($filter->user_authority_updated_at),
        'isPremiumUser'     => isPremiumUser($filter->user_id),
        'detailString'  => implode(", ", array_filter([$userAge, $gender]))
    ];
}
}
}

//Popular Member
$userInterestedArray =  explode(',', Auth::user()->interest_selection);
$PopularUser = UserProfile::select('users._uid as UID','users.*','user_profiles.*','popular_member.popular as popular_count')
->leftJoin('users', 'users._id', '=', 'user_profiles.users__id')
->leftJoin('popular_member', 'popular_member.to_user_id', '=', 'users._id')
->whereIn('users.gender_selection',$userInterestedArray)
->orderBy('popular_member.popular', 'desc')
->limit(4)
->get();

 //                 echo '<pre>';
 // print_r($PopularUser);
 // die('here');

$filterDataPopularUser = [];
foreach ($PopularUser as $filter) {

  
    $userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
    $gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;
    $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos($filter->users__id);
    $userProfileImagesData = array();
    if($userPhotoCollection){
     foreach ($userPhotoCollection as $key => $images) {


      $userProfileImages['file'] = $images->file;
      $userProfileImages['type'] = $images->type;
      $userProfileImages['_uid'] = $images->_uid;
      $userProfileImages['video_thumbnail'] = $images->video_thumbnail;
      $userProfileImagesData[] = $userProfileImages;
  }
}
$user_block_users = DB::table('user_block_users')->where('to_users__id', $filter->users__id)->where('by_users__id', Auth::user()->_id)->first();
if(empty($user_block_users)){
  $filterDataPopularUser[] = [
    'id'            => $filter->_id,
    'uid'      => $filter->UID,
    'username'      => $filter->username,
    'fullName'      => $filter->first_name.' '.$filter->last_name,
    'profileImage'  =>$filter->profile_picture,
    'totalPhotto'  => $userPhotoCollection->count(),
    'userPhottoLists'  => $userProfileImagesData,
    'popular_count'  => $filter->popular_count,
    'gender'        => $gender,
    'dob'           => $filter->dob,
    'city'           => $filter->city,
    'heading'           => $filter->heading,
    'user_uid'           => $filter->user_uid,
    'user_id'           => $filter->user_id,
    'body_type_name'           => $filter->body_type_name,
    'ethnicity_name'           => $filter->ethnicity_name,
    'height'           => $filter->height,
    'userAge'       => $userAge,
    'countryName'   => $filter->countryName,
    'userOnlineStatus' => $this->getUserOnlineStatus($filter->loginstatus),
    'userOnlineStatusAgo' => $this->getUserOnlineStatusAgo($filter->user_authority_updated_at),
    'isPremiumUser'     => isPremiumUser($filter->user_id),
    'detailString'  => implode(", ", array_filter([$userAge, $gender]))
];

}
}
 //    echo '<pre>';
 // print_r($filterDataPopularUser);
 // die('here');

return view('home.index',compact('filterData','filterDataNewUser','filterDataOnline','filterDataRecentUser','filterDataPopularUser'));
}
public function homePage()
{
        // // get encounter data
        // $encounterData = $this->userEncounterEngine->getEncounterUserData();
        // // For Random search use following function
        // $basicSearchData = $this->filterEngine->prepareRandomUserData([], 12);
        // // merge encounter data and basic data
        // $processReaction = array_merge($encounterData['data'], $basicSearchData['data']);

        // return $this->loadPublicView('home', $processReaction);
}

    /**
     * ChangeLocale - It also managed from index.php.
     *---------------------------------------------------------------- */
    protected function changeLocale(CommonUnsecuredPostRequest $request, $localeId = null)
    {
        if (is_string($localeId)) {
            changeAppLocale($localeId);
        }
        if ($request->has('redirectTo')) {
            header('Location: '.base64_decode($request->get('redirectTo')));
            exit();
        }

        return __tr('Invalid Request');
    }

    /**
     * preview page
     *---------------------------------------------------------------- */
    public function previewPage($pageUid, $title)
    {
    	$processReaction = $this->managepageEngine->previewPage($pageUid);

        return $this->loadView('pages.preview', $processReaction['data']);
    }

    /**
     * preview landing page
     *---------------------------------------------------------------- */
    public function landingPage()
    {

       $user = User::count();
// die;

       return view('outer-home',compact('user'));
   }

    /**
     * Search Matches
     *---------------------------------------------------------------- */
    public function searchMatches(CommonUnsecuredPostRequest $request)
    {
        $inputData = $request->all();
        // Set user search data into session
        session()->put('userSearchData', [
            "looking_for"   => $inputData['looking_for'],
            "min_age"       => $inputData['min_age'],
            "max_age"       => $inputData['max_age']
        ]);

        return redirect()->route('user.sign_up');
    }
}