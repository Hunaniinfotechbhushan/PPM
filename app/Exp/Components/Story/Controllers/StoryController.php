<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Story\Controllers;

use App\Exp\Components\Bookmarks\Repositories\UserSettingRepository;
use App\Exp\Base\BaseController;
use Illuminate\Http\Request;
use App\Exp\Support\Utils;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\Story\Models\Story;
use App\Exp\Components\User\Models\UserProfile;
use App\Exp\Support\CommonTrait;
use App\Exp\Components\User\Models\MemberView;
use DB;
use Auth;
use Carbon\Carbon;
use App\Exp\Components\Member\Models\ReportUser;
use App\Exp\Components\UserSetting\Models\UserPhotosModel;




class StoryController extends BaseController
{
  use CommonTrait;


  public function uploadStory(Request $request)
  {
   if ($request->ajax()) {
    
    $imageFiles = $request->file('media');

    if($imageFiles){
      $mime = $imageFiles->getMimeType();
      if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") 
      {
        $mediaType = "video";

     $imagethumb = $request->videoThumbnail;  // your base64 encoded

      

      // $imagethumb = str_replace('data:image/png;base64,', '', $imagethumb);
      // $imagethumb = str_replace(' ', '+', $imagethumb);
      // $thumbnailName = str_random(10).time().'.'.'jpg';
      // \File::put(public_path().'/frontend/story/'.$thumbnailName, base64_decode($imagethumb));


       $imagethumb = str_replace('data:image/png;base64,', '', $imagethumb);
        $imagethumb = str_replace(' ', '+', $imagethumb);
        $thumbnailName = str_random(10).'.'.'png';
        \File::put(public_path(). '/frontend/story/' . $thumbnailName, base64_decode($imagethumb));

      }else{

        $thumbnailName='';
        $mediaType = "image";
      }

      $mediaName= rand().'-'.$imageFiles->getClientOriginalName();
      $imageFiles->move(public_path().'/frontend/story/',$mediaName);
    }else{
      $mediaName= 'default.png'; 
    }
     
        


   $dataArray = array(
      "users_id"     =>  Auth::user()->_id,
      "type"   =>     $mediaType,
      "file"   =>     $mediaName,
      "video_thumbnail"  =>   $thumbnailName,
      "view"   =>     '',
      "status"   =>   0
    );


   $storyData =  Story::create($dataArray);

    userActivity(Auth::user()->_uid,Auth::user()->_id,'user-story-upload',$storyData->id,1,"");

    echo json_encode(array('status'=> 'success'));
  }
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

public function get_user_notify_image(Request $request){



    if ($request->photo_id) {

  
        $UserPhotosModel = UserPhotosModel::where('_id',$request->photo_id)->first();

        if($UserPhotosModel){

        $UserPhoto = User::where('_id',$UserPhotosModel['users__id'])->first();

        if($request->slugData == 'photo/media-approve'){

          $messages = 'Your photo/video has been approved';

        }else{

          $messages = 'This photo/video has been rejected. Please no nudity, text, low-quality photos or images without you';
        }
        
          $imgURL = url('/').'/media-storage/users/'.$UserPhoto['_uid'].'/'.$UserPhotosModel['file'];

               
               echo json_encode(array('sucess'=>true,'image'=>$imgURL,'messages' =>$messages));
           
      }
    }else{

      echo json_encode(array('sucess'=>false));
    }

}


}