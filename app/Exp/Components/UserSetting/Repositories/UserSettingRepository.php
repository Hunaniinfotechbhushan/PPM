<?php
/*
* UserSettingRepository.php - Repository file
*
* This file is part of the UserSetting component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\UserSetting\Repositories;

use App\Exp\Base\BaseRepository;
use App\Exp\Components\User\Models\{
    User, UserProfile, UserSubscription, ProfileBoost, UserAuthorityModel, LikeDislikeModal
};
use App\Exp\Components\UserSetting\Models\{
    UserSpecificationModel, UserPhotosModel, UserSettingModel
};
use App\Exp\Components\UserSetting\Interfaces\UserSettingRepositoryInterface;
use Carbon\Carbon;
use DB;
use Auth;
use App\Exp\Support\CommonTrait;

class UserSettingRepository extends BaseRepository
implements UserSettingRepositoryInterface 
{ 
    /**
     * @var CommonTrait - Common Trait
     */
    use CommonTrait;
    
	/**
      * Fetch All Record from Cache
      *
      * @param array $names
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */

    public function fetchUserSettingByName($name)
    {
        return UserSettingModel::whereIn('key_name', $name)
        ->select('_id', 'key_name', 'value', 'data_type', 'users__id')
        ->where('users__id', getUserID())
        ->get();
    }

	/**
      * Store or update user setting data
      *
      * @param array $inputData
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */

    public function storeOrUpdate($inputData)
    {   
        // Check if data updated or inserted
        if (UserSettingModel::bunchInsertUpdate($inputData, '_id')) {
            return true;
        }
        return false;
    }

	 /**
      * Delete user setting by keys
      *
      * @param array $userSettingKeyNames
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */

    public function deleteUserSetting($userSettingKeyNames) 
    {
        if (UserSettingModel::whereIn('_id', $userSettingKeyNames)->delete()) {
            return true;
        }
        return false;
    }
    
    /**
      * Fetch the record of UserSetting
      *
      * @param int $userId
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */

    public function fetchUserDetails($userId)
    {   
        return User::where('users._id', $userId)
        ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
        ->select(
            \__nestedKeyValues([
                'users' => [
                    '_id',
                    'username',
                    'email',
                    'first_name',
                    'last_name',
                    'designation',
                    'mobile_number'
                ],
                'user_profiles' => [
                    '_id AS user_profile_id',
                    'users__id',
                    'countries__id',
                    'profile_picture',
                    'gender',
                    'dob',
                    'city',
                    'about_me',
                    'location_latitude',
                    'location_longitude',
                    'preferred_language',
                    'relationship_status',
                    'work_status',
                    'education',
                    'cover_picture'
                ]
            ])
        )
        ->first();
    }

    /**
      * Fetch User profile
      *
      * @param int $userId
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchUserProfile($userId)
    {
        return UserProfile::where('users__id', $userId)->first();
    }
    
    /**
      * Update User
      *
      * @param object $user
      * @param array $updateData
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function updateUser($user, $updateData)
    {
        if ($user->modelUpdate($updateData)) {
            return true;
        }
        return false;
    }

    /**
      * Store user profile
      *
      * @param array $inputData
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function storeUserProfile($inputData)
    {
        $keyValues = [
            'users__id' => $inputData['user_id'],
            'countries__id',
            'gender' => array_get($inputData, 'gender'),
            'dob' => array_get($inputData, 'dob'),
            'about_me',
            'city',
            'work_status',
            'education',
            'preferred_language',
            'relationship_status',
            'location_latitude',
            'location_longitude'
        ];
        $userProfile = new UserProfile;
        // check if user profile stored successfully
        if ($userProfile->assignInputsAndSave($inputData, $keyValues)) {
            return $userProfile;
        }

        return false;
    }

    /**
      * Update User Profile
      *
      * @param object $userProfile
      * @param array $updateData
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function updateUserProfile($userProfile, $updateData)
    {
        if ($userProfile->modelUpdate($updateData)) {
            return true;
        }
        return false;
    }

    /**
      * Fetch user specification by user id
      *
      * @param int $userId
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */

    public function fetchUserSpecificationById($userId)
    {
        return UserSpecificationModel::where('users__id', $userId)->get();
    }

    /**
      * Store or update user specification data
      *
      * @param array $inputData
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */

    public function storeOrUpdateUserSpecification($inputData)
    {   
        // Check if data updated or inserted
        if (UserSpecificationModel::bunchInsertUpdate($inputData, '_id')) {
            return true;
        }

        return false;
    }

    /**
      * Fetch user photos
      *
      * @param number $userId
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchUserPhotos($userId)
    {
        return UserPhotosModel::where('users__id', $userId)->orderBy('primary', 'desc')->get();


    }

    /**
      * Store user photos
      *
      * @param array $storeData
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function storeUserPhoto($storeData)
    {
        $keyValues = [
            'status' => 1,
            'users__id',
            'file',
            'type',
            'extantion_type',
            'video_thumbnail',
            'is_verified'
        ];

        // echo "<pre>";
        // print_r($storeData);
        // print_r($keyValues);
        // die();

        $newUserPhotosModel = new UserPhotosModel;


        if ($newUserPhotosModel->assignInputsAndSave($storeData, $keyValues)) {

            return $newUserPhotosModel;
        }

        return false;
    }

    /**
      * Fetch Filter data
      *
      * @param array $filterData
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchFilterData($filterData, $ignoreUserIds, $paginateCount = false)
    { 

        if (isset($filterData['paginate']) and !__isEmpty($filterData['paginate'])) {
            $paginateCount = $filterData['paginate'];
        }else{
            $paginateCount = 30;
        }

  

// echo "<pre>";
// print_r(array($filterData['looking_for']));
// die;
       $searchQuery = UserProfile::join('users', 'user_profiles.users__id', '=', 'users._id')
       ->select(
        __nestedKeyValues([
            'users' => [
                '_id AS user_id',
                '_uid AS user_uid',
                'username',
                'first_name',
                'last_name',
                'is_fake'
            ],
            'user_profiles.*', 
            'body_type' => [
                'name AS body_type_name',
            ],

            'like_dislikes.by_users__id as likeId', 
            'user_authorities.updated_at AS user_authority_updated_at', 
            'ethnicity' => [
                'name AS ethnicity_name',
            ],
            'countries' => [
                'name as countryName'
            ]                       
        ])
    )
       ->leftJoin('countries', 'user_profiles.countries__id', '=', 'countries._id')
       ->leftJoin('body_type', 'user_profiles.body_type', '=', 'body_type._id')
       ->leftJoin('like_dislikes', 'user_profiles.users__id', '=', 'like_dislikes.by_users__id')
       ->leftJoin('ethnicity', 'user_profiles.ethnicity', '=', 'ethnicity._id')
       ->leftJoin('user_authorities', 'user_profiles.users__id', '=', 'user_authorities.users__id')
       ->groupBy('users._id')                        
       ->where('users.is_verified','=',1)
       ->where('users.status','=',1)
       ->whereIn('users.gender_selection',$filterData['looking_for'])
       ->whereIn('users.role', array(2));  

       if (isset($filterData['profile_text']) and !__isEmpty($filterData['profile_text'])) {
        $searchQuery->where('users.username','like', '%'.$filterData['profile_text'].'%');
        $searchQuery->orWhere('user_profiles.heading','like', '%'.$filterData['profile_text'].'%');

    }else{


       if (isset($filterData['distance']) and !__isEmpty($filterData['distance'])) {
        $searchQuery->distanceFilter($filterData);
    }  

// nearest            
    if(isset($filterData['short_by'])){

        if($filterData['short_by'] == 'nearest'){

         $searchQuery->distanceFilter($filterData);
     }
 } 



// online  user filter

 if(isset($filterData['short_by'])){
    if($filterData['short_by'] == 'active'){

        $userIdInterrest = explode(',', Auth::user()->interest_selection);
        $OnlineUser = UserProfile::select('users._uid as UID','users.*','user_profiles.*','user_authorities.updated_at as loginstatus','user_authorities.*')
        ->leftJoin('users', 'users._id', '=', 'user_profiles.users__id')
        ->leftJoin('user_authorities', 'user_authorities.users__id', '=', 'users._id')
        ->whereIn('users.gender_selection', $userIdInterrest)
        ->get();


        if($OnlineUser){
            foreach ($OnlineUser as $key => $value) {
                $online_user = $this->getUserOnlineStatus($value['loginstatus']);
                if($online_user == 2 || $online_user == 3){
                    $userIdVerifiedArray[] = $value['_id'];
                }else{
                 $userIdVerifiedArray[] = '';
             }
             $searchQuery->whereIn('user_authorities._id',$userIdVerifiedArray); 
         }     

     }
 }
} 
// Age Filter
      if(isset($filterData['max_age'])){
               // prepare dates for comparison
            $minAgeDate = Carbon::today()->subYears($filterData['min_age'])->toDateString();
            $maxAgeDate = Carbon::today()->subYears($filterData['max_age'])->endOfDay()->toDateString();
            $currentDate = Carbon::now();
                $searchQuery->whereBetween('user_profiles.dob', [$maxAgeDate, $minAgeDate]);

        }


if (isset($filterData['min_height']) and !__isEmpty($filterData['min_height'])) {                                   
  $searchQuery->whereBetween('user_profiles.height', [
    $filterData['min_height'],
    $filterData['max_height']
]);
} 

if (empty($filterData['short_by']) and empty($filterData['distance'])) {
    $searchQuery->distanceFilter($filterData);
}


                      // Id Verified

if (isset($filterData['id_verified']) and !__isEmpty($filterData['id_verified']))
{      
    $userIdVerified = User::where('status',1)->get();

    if($userIdVerified){
        foreach ($userIdVerified as $key => $value) {
            $userIdVerifiedArray[] = $value->_id;                                           
        }     

        $searchQuery->whereIn('users._id',$userIdVerifiedArray); 
    }

}

                       // Favorited You

if (isset($filterData['favorited']) and !__isEmpty($filterData['favorited']))
{      
    $LikeDislikeModal = LikeDislikeModal::where('by_users__id',Auth::user()->_id)->get();

    if($LikeDislikeModal){
        foreach ($LikeDislikeModal as $key => $value) {
            $likeDislikeId[] = $value->to_users__id;                                           
        }     
        if (isset($likeDislikeId)) {

            $searchQuery->whereIn('like_dislikes.to_users__id',$likeDislikeId); 
        }
    }

}

if (isset($filterData['favorited_me']) and !__isEmpty($filterData['favorited_me']))
{      
    $LikeDislikeModal = LikeDislikeModal::where('to_users__id',Auth::user()->_id)->get();

    if($LikeDislikeModal){
        foreach ($LikeDislikeModal as $key => $value) {
            $likeDislikeId[] = $value->by_users__id;                                           
        }     

        $searchQuery->whereIn('like_dislikes.by_users__id',$likeDislikeId); 
    }
}

                                // Body Type Filter
if (isset($filterData['body_type']) and !__isEmpty($filterData['body_type'])) {                
    foreach ($filterData['body_type'] as $key => $value) {
        $body_type[] = $value;                                           
    }                            
    $searchQuery->whereIn('user_profiles.body_type', $body_type);                                        
} 
                                     // Ethnicity Type Filter

if (isset($filterData['ethnicity']) and !__isEmpty($filterData['ethnicity'])) {
  foreach ($filterData['ethnicity'] as $key => $value) {
    $ethnicity[] = $value;                                           
}                            
$searchQuery->whereIn('user_profiles.ethnicity', $ethnicity);                                        
} 

                                 // // Body Type Filter

if (isset($filterData['hair_color']) and !__isEmpty($filterData['hair_color'])) {
  foreach ($filterData['hair_color'] as $key => $value) { $hair_color[] = $value; } 

  $searchQuery->whereIn('user_profiles.hair_color', $hair_color);
} 



                             // // Body Type Filter eye_color

if (isset($filterData['eye_color']) and !__isEmpty($filterData['eye_color'])) {
  foreach ($filterData['eye_color'] as $key => $value) { $eye_color[] = $value; } 

  $searchQuery->whereIn('user_profiles.eye_color', $eye_color);
} 
                                 //    // // Smoke Type Filter

if (isset($filterData['smoke']) and !__isEmpty($filterData['smoke'])) {                                    
    foreach ($filterData['smoke'] as $key => $value) { $smoke[] = $value;}                            
    $searchQuery->whereIn('user_profiles.smoke', $smoke);
} 


                                 //    //    // drink Type Filter

if (isset($filterData['drink']) and !__isEmpty($filterData['drink'])) {                                    
    foreach ($filterData['drink'] as $key => $value) { $drink[] = $value;}                            
    $searchQuery->whereIn('user_profiles.drink', $drink);
} 


                                 //    //    // relationship_status Type Filter

if (isset($filterData['relationship_status']) and !__isEmpty($filterData['relationship_status'])) {
    foreach ($filterData['relationship_status'] as $key => $value) { $relationship_status[] = $value;} 
    $searchQuery->whereIn('user_profiles.relationship_status', $relationship_status);
} 

                                 //    //     // education Type Filter

if (isset($filterData['education']) and !__isEmpty($filterData['education'])) {
    foreach ($filterData['education'] as $key => $value) { $education[] = $value;} 
    $searchQuery->whereIn('user_profiles.education', $education);
} 
                                 //    //         // children Type Filter

if (isset($filterData['children']) and !__isEmpty($filterData['children'])) {
    foreach ($filterData['children'] as $key => $value) { $children[] = $value;} 
    $searchQuery->whereIn('user_profiles.children', $children);
}         
                                 //    //  // children Type Filter

if (isset($filterData['income']) and !__isEmpty($filterData['income'])) {
    foreach ($filterData['income'] as $key => $value) { $income[] = $value;} 
    $searchQuery->whereIn('user_profiles.income', $income);
} 
                                 //    //  // children Type Filter

if (isset($filterData['net_worth']) and !__isEmpty($filterData['net_worth'])) {
    foreach ($filterData['net_worth'] as $key => $value) { $net_worth[] = $value;} 
    $searchQuery->whereIn('user_profiles.net_worth', $net_worth);
} 

                                 //       //  // children Type Filter

if (isset($filterData['city']) and !__isEmpty($filterData['city'])) {


   $searchQuery->where('user_profiles.city','like', '%'.$filterData['city'].'%');
} 

                                    // Serach with name, heading



$searchQuery->where('users._id','!=', getUserID());

if(isset($filterData['short_by'])){
   if($filterData['short_by'] == 'newest'){
     $searchQuery->orderBy('users.created_at', 'desc');
 }

 if($filterData['short_by'] == 'nearest'){
                            // $searchQuery->orderBy('users.created_at', 'desc');
                              //$searchQuery->distanceFilter(500);
 }
    }                      //$userIdVerified = User::where('status',1)->get();

} 

               // return $searchQuery->toSql();
return $searchQuery->latest('user_profiles.updated_at')          
->paginate($paginateCount);
}

	 /**
      * Fetch Filter Random User data
      *
      * @param array $filterData
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchFilterRandomUser($filterData, $ignoreUserIds, $userType)
    {
		// prepare dates for comparison
      $currentDate 	= Carbon::now();
      $searchQuery = UserProfile::basicFilter($filterData)
      ->join('users', 'user_profiles.users__id', '=', 'users._id')
      ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
      ->leftJoin('countries', 'user_profiles.countries__id', '=', 'countries._id')
      ->groupBy('users._id')
      ->where('users.status', 1)
      ->whereNotIn('users._id', $ignoreUserIds);
								//check distance not equal to null
      if ($filterData['distance'] != null) {
         $searchQuery->distanceFilter($filterData);
     }

     if ($userType == 'boosterUser') {
       return $searchQuery->join('profile_boosts', function($profileBoostJoin) use ($currentDate) {
         $profileBoostJoin->on('user_profiles.users__id', '=', 'profile_boosts.for_users__id')
         ->where('profile_boosts.expiry_at', '>', $currentDate);
     })
       ->select(
         'users._id AS user_id',
         'users._uid AS user_uid',
         'users.username',
         'users.first_name',
         'users.last_name',
         'users.is_fake',
         'user_profiles.created_at',
         'user_profiles.updated_at',
         'user_profiles.profile_picture',
         'user_profiles.gender',
         'user_profiles.dob',
         'user_profiles.countries__id',
         'user_profiles.users__id',
         'profile_boosts.created_at as profileBoostCreatedAt',
         'profile_boosts.for_users__id',
         'profile_boosts.for_users__id as profileBoostIds',
         'countries.name as countryName',
         'user_authorities.updated_at AS user_authority_updated_at'
     )
       ->latest('profileBoostCreatedAt')
       ->get();
   } else if ($userType == 'premiumUser') {
       return $searchQuery->join('user_subscriptions', function($subscriptionJoin) use($currentDate) {
         $subscriptionJoin->on('user_profiles.users__id', '=', 'user_subscriptions.users__id')
         ->where('user_subscriptions.expiry_at', '>', $currentDate);
     })
       ->select(
         'users._id AS user_id',
         'users._uid AS user_uid',
         'users.username',
         'users.first_name',
         'users.last_name',
         'users.is_fake',
         'user_profiles.created_at',
         'user_profiles.updated_at',
         'user_profiles.profile_picture',
         'user_profiles.gender',
         'user_profiles.dob',
         'user_profiles.countries__id',
         'user_profiles.users__id',
         'user_subscriptions.created_at as premiumUserCreatedAt',
         'user_subscriptions.users__id as premiumUserIds',
         'user_subscriptions.expiry_at',
         'countries.name as countryName',
         'user_authorities.updated_at AS user_authority_updated_at'
     )
       ->latest('premiumUserCreatedAt')
       ->get();
   } else if ($userType == 'normalUser') {
       return $searchQuery->select(
         'users._id AS user_id',
         'users._uid AS user_uid',
         'users.username',
         'users.first_name',
         'users.last_name',
         'users.is_fake',
         'user_profiles.created_at',
         'user_profiles.updated_at',
         'user_profiles.profile_picture',
         'user_profiles.gender',
         'user_profiles.dob',
         'user_profiles.countries__id',
         'user_profiles.users__id',
         'countries.name as countryName',
         'user_authorities.updated_at AS user_authority_updated_at'
     )
       ->latest('user_profiles.updated_at')
       ->get();
   }
}

    /**
     * fetch active profile boost user.
     *
     * @param array $userID
     * 
     *-----------------------------------------------------------------------*/
    public function fetchAllBoostUsersIgIds($igUsersIds)
    {	
      $currentTime = Carbon::now();

		//if data exist then show records else return blank array
      return ProfileBoost::whereNotIn('for_users__id', $igUsersIds)
      ->where('expiry_at', '>=', $currentTime)
      ->get();
  }

    /**
     * Fetch user subscription data by loggedin user id.
     *
     * @param number $userID
     *
     * @return eloquent collection object
     *---------------------------------------------------------------- */
    public function fetchAllPremiumUsersIgIds($ignoreUsersIds)
    {
      $currentTime = Carbon::now();
      return UserSubscription::select(
         __nestedKeyValues([
          'user_subscriptions.*'
      ])
     )
      ->where('user_subscriptions.expiry_at', '>=', $currentTime)
      ->whereNotIn('user_subscriptions.users__id', $ignoreUsersIds)
      ->get();
  }

    /**
      * Fetch Random User Data
      *
      * @param array $filterData
      * 
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchRandomUserData($filterData, $ignoreUserIds)
    {
        // prepare dates for comparison
        $minAgeDate = Carbon::today()->subYears($filterData['min_age'])->toDateString();
        $maxAgeDate = Carbon::today()->subYears($filterData['max_age'])->endOfDay()->toDateString();

        // $tempArray = [64,25,15,57];
        // $tempStr = implode(',', $tempArray);

        $randomSearchQuery = UserProfile::whereIn('gender', $filterData['looking_for'])
        ->join('users', 'user_profiles.users__id', '=', 'users._id')
        ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
        ->leftJoin('countries', 'user_profiles.countries__id', '=', 'countries._id')
        ->where('users.status', 1)
        ->whereNotIn('users._id', $ignoreUserIds)
        ->whereBetween('user_profiles.dob', [$maxAgeDate, $minAgeDate]);
        if ($filterData['distance'] != null) {
            $randomSearchQuery->distanceFilter($filterData);
        }

        $randomSearchQuery->select(
            __nestedKeyValues([
                'users' => [
                    '_id AS user_id',
                    '_uid AS user_uid',
                    'username',
                    'first_name',
                    'last_name',
                    'is_fake'
                ],
                'user_profiles' => [
                    'created_at',
                    'updated_at',
                    'profile_picture',
                    'gender',
                    'dob',
                    'countries__id',
                    'users__id'
                ],
                'countries' => [
                    'name as countryName'
                ],
                'user_authorities' => [
                    'updated_at AS user_authority_updated_at'
                ]
            ])
        );
        return $randomSearchQuery->get();
    }
}