<?php

/*
* ManageUserEngine.php - Main component file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\MemberMedia;

use App\Exp\Base\BaseEngine;
use App\Exp\Components\User\Repositories\{ManageUserRepository, CreditWalletRepository};
use Carbon\Carbon;
use DB;
use App\Exp\Support\CommonTrait;
use Illuminate\Support\Facades\Input;
use App\Exp\Components\User\Models\{
    User,
    UserProfile
};
class MemberMediaEngine extends BaseEngine 
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
     * Prepare User List.
     *
     * @param array $inputData
     *
     *---------------------------------------------------------------- */
     public function getAllMedia()
     {
       return     $userPhotos =  User::leftjoin('user_photos', 'users._id', '=', 'user_photos.users__id')
        ->where('user_photos.is_verified',2)
        ->whereNotNull('user_photos._uid')
        ->select(
         __nestedKeyValues([
            'users' => [
               '_id',
               '_uid',
               'first_name',
               'last_name',
               'username',
               DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name")
           ],
           'user_photos' => [
                '_id as media_id',
               '_uid as user_photo_id',
               'file as image_name',
               'video_thumbnail',
               'extantion_type',
               'is_verified',
               'created_at',
               'updated_at'
           ],
       ])
     )
        ->orderBy('user_photos._id','DESC')
        ->get();

     //   if (User::all()) {
     //     $teams = User::all();
     //     return $teams;
     // }
     // return false;
   }

   public function photto_verify_request($id,$verify)
     {
        return DB::table('user_photos')
        ->where('_id', $id)  // find your user by their email
        ->update(array('is_verified' => $verify));
     }

}