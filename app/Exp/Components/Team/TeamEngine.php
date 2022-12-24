<?php

/*
* ManageUserEngine.php - Main component file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Team;

use App\Exp\Base\BaseEngine;
use App\Exp\Components\User\Repositories\{ManageUserRepository, CreditWalletRepository};
use App\Exp\Support\Country\Repositories\CountryRepository;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Exp\Support\CommonTrait;
use App\Exp\Components\Media\MediaEngine;
use Illuminate\Support\Facades\Input;
use App\Exp\Components\Team\Models\Team;
use App\Exp\Components\User\Models\{
    User as UserModel,
    UserAuthorityModel,
    PasswordReset,
    SocialAccess,
    LikeDislikeModal,
    ProfileVisitorModel,
    UserGiftModel,
    CreditWalletTransaction,
    UserSubscription,
    UserBlock,
    ProfileBoost,
    UserProfile
};
class TeamEngine extends BaseEngine 
{   
	/**
	* @var CommonTrait - Common Trait
	*/
    use CommonTrait;

    /**
     * @var  ManageUserRepository $manageUserRepository - ManageUser Repository
     */
    protected $manageUserRepository;

    /**
     * @var  CountryRepository $countryRepository - Country Repository
     */
    protected $countryRepository;
    
    /**
     * @var  Faker $faker - Faker
     */
    protected $faker;

	 /**
     * @var  CreditWalletRepository $creditWalletRepository - CreditWallet Repository
     */
    protected $creditWalletRepository;

    /**
     * @var  MediaEngine $mediaEngine - MediaEngine
     */
    protected $mediaEngine;

    /**
      * Constructor
      *
      * @param  ManageUserRepository $manageUserRepository - ManageUser Repository
      * @param  CountryRepository $countryRepository - Country Repository
	  * @param  Faker $faker - Faker
	  * @param  MediaEngine $mediaEngine - MediaEngine
      * @param  CreditWalletRepository $creditWalletRepository - CreditWallet Repository
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(ManageUserRepository $manageUserRepository, CountryRepository $countryRepository, Faker $faker, CreditWalletRepository $creditWalletRepository, MediaEngine $mediaEngine)
    {
        $this->manageUserRepository 	= $manageUserRepository;
        $this->countryRepository 		= $countryRepository;
        $this->faker 					= $faker;
        $this->creditWalletRepository 	= $creditWalletRepository;
        $this->mediaEngine 				= $mediaEngine;
    }


     /**
     * Prepare User List.
     *
     * @param array $inputData
     *
     *---------------------------------------------------------------- */
     public function teamAllData()
     {
       return Team::where('users.role', 1)
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
                'mobile_number',
                'created_at'
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
       ->orderBy('users._id','DESC')
       ->get();

     //   if (User::all()) {
     //     $teams = User::all();
     //     return $teams;
     // }
     // return false;
   }

     /**
     * Prepare User List.
     *
     * @param array $inputData
     *
     *---------------------------------------------------------------- */
     public function processSaveTeam($inputData)
     {

         $dataArray = array(
            "_uid"     =>  rand(),
            "first_name"     =>  $inputData['first_name'],
            "last_name"     =>  $inputData['last_name'],
            "email"     =>  $inputData['email'],
            "username"     =>  $inputData['username'],
            "password"     =>  bcrypt($inputData['password']),
            "role"     =>  1,
        );


         if(isset($inputData['profile_picture']))
         {
           $imageFiles = $inputData['profile_picture'];
           $name=str_random(6).'_'.$imageFiles->getClientOriginalName();
           $imageFiles->move(public_path().'/media-storage/admin/profile/',$name);
           $profile_image = $name;
       }else{
        $profile_image = 'default.png';
    }
    $user = Team::create($dataArray);

    $keyValues = [
        'users__id'     => $user->id,
        'gender'        => 1,
        'profile_picture' => $profile_image,
        'dob'           => date("Y-m-d",strtotime('10-10-1995')),
        'status'        => 0,
    ];

    $userProfile = new UserProfile;
        // check if user profile stored successfully
    if ($userProfile->assignInputsAndSave($inputData, $keyValues)) {

        $userAuthorityData = [
            'user_id' =>  $user->id,
            'user_roles__id' => 1
        ];
            // Add user authority
        if ($this->manageUserRepository->storeUserAuthority($userAuthorityData)) {                
            return true;
        }
            }

    return false;
}

}