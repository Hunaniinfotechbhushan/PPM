<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Updates\Controllers;

use App\Exp\Components\Bookmarks\Repositories\UserSettingRepository;
use App\Exp\Base\BaseController;
use Illuminate\Http\Request;
use App\Exp\Support\Utils;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\User\Models\UserProfile;
use App\Exp\Support\CommonTrait;
use App\Exp\Components\User\Models\LikeDislikeModal;
use App\Exp\Components\User\Models\MemberView;
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

class UpdatesController extends BaseController
{
  use CommonTrait;

  public function index()
  {

    $myVisitor = $this->myVisitor();
    // return $myVisitor;
    $iVisitedOnPrev = $this->iVisit();
    // return $iVisitedOnPrev;
    $userFavData = $this->favorites();
    $userFavMeData = $this->favoritesMe();
    return view('updates.updates',compact('myVisitor','iVisitedOnPrev','userFavData','userFavMeData'));

}

public function myVisitor($orderType = null){
// Who Viewed me
    $myVisitorHtml = "";
    if(isset($orderType)){
        if($orderType == 1){
            $userViewedYou = MemberView::join('user_authorities', 'member_view.by_view_id', '=', 'user_authorities.users__id')
            ->where('member_view.to_view_id',Auth::user()->_id)
            ->select('member_view.*','user_authorities.updated_at AS user_authority_updated_at')
            ->orderBy('member_view.updated_at','DESC')
            ->get();
        }else{
          $userViewedYou = MemberView::join('user_authorities', 'member_view.by_view_id', '=', 'user_authorities.users__id')
          ->where('member_view.to_view_id',Auth::user()->_id)
          ->select('member_view.*','user_authorities.updated_at AS user_authority_updated_at')
          ->orderBy('user_authorities.updated_at','DESC')
          ->get();
      }

  }else{
     $userViewedYou = MemberView::join('user_authorities', 'member_view.by_view_id', '=', 'user_authorities.users__id')
     ->where('member_view.to_view_id',Auth::user()->_id)
     ->select('member_view.*','user_authorities.updated_at AS user_authority_updated_at')
     ->orderBy('member_view.updated_at','DESC')
     ->get();
 }


 $myVisitor = array();
 if($userViewedYou){
   foreach ($userViewedYou as $key => $value) {
    $filter = $this->getFullUserDetails($value->by_view_id);

if(isset($filter->main_user_id)){
    $fetchAllUserLikeDislike = DB::table('like_dislikes')->where('to_users__id',$filter->main_user_id)->where('by_users__id',Auth::user()->_id)->first();
    if (!__isEmpty($fetchAllUserLikeDislike)) {
        $userLikeDislike = $fetchAllUserLikeDislike->like;
    }else{
      $userLikeDislike = 0;
  }
  $profilePictureFolderPathFull = getPathByKey('profile_photo', ['{_uid}' => $filter->user_uid]);
  $profilePictureFolderPath = str_replace("/profile","",$profilePictureFolderPathFull);
  $profilePictureUrl = noThumbImageURL();

                // Check if user profile exists
  if (!__isEmpty($filter)) {
    if (!__isEmpty($filter->profile_picture)) {
        $profilePictureDrive = getMediaUrl($profilePictureFolderPath, $filter->profile_picture);
        $profilePictureUrl = url('/').'/media-storage/users/'.$filter->_uid.'/'.$filter->profile_picture;
    }
}
$userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
$gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;


if(Auth::user()->_id != $filter->users__id){

if(isset($orderType)){
 $userOnlineStatus =  $this->getUserOnlineStatus($value->user_authority_updated_at);
 $myVisitorHtml .= '  <div class="vister d-flex justify-content-between pb-3 py-2">
 <div class="img-about d-flex align-items-flex-start">
 <div class="vister-image-icon">
 <img class="vister-profile-image" src="'.$profilePictureUrl.'" class="lw-user-thumbnail lw-lazy-img">
 <i class="fa-solid fa-camera"></i>
 </div>
 <div>
 <a href="'.url('member').'/'.$filter->_uid.'">

 <p class="user-name">';

 if($userOnlineStatus){

    if($userOnlineStatus == 1){
       $myVisitorHtml .= '<span class="lw-dot lw-dot-success" title="Online"></span>';
   }elseif($userOnlineStatus == 2){
      $myVisitorHtml .=  '<span class="lw-dot lw-dot-warning" title="Idle"></span>';
  }elseif($userOnlineStatus == 3){
   $myVisitorHtml .= '<span class="lw-dot lw-dot-danger" title="Offline"></span>';
}

}
$myVisitorHtml .= $filter->username;

if($userLikeDislike == 1)
{
    $hasLike = "like_true";
    $hasLikeTitle = "Favorite";
}else{
    $hasLike = "";
    $hasLikeTitle = "Favorited";
} 

$myVisitorHtml .= '</p>
</a>
<p class="location">'.substr_replace($filter->heading, "...", 50).'</p>
<p class=" adress">'.$filter->city.'</p>
<div class="d-flex"><a href="'.url('member/').'/'.$filter->user_id.'"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>
<p>
<a href data-action="'.url('/').'/user/'.$filter->user_id.'/1/user-like-dislike" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
<i class="fa-solid fa-heart '.$hasLike.'"></i> <span>'.$hasLikeTitle.'</span></a>
</p>
</div>
</div>
</div>
<div class="d-none d-md-block mt-2">
<div class="about-vistor">
<p class="height"><b>Height : </b>'.$filter->height.'cm</p>
<p class="body"><b>Body : </b>'.$filter->user_body_type.'</p>
<p class="ethnicty"><b>Ethncity : </b>'.$filter->user_ethnicity.'</p>
</div>
</div>
<div class="time">';
if($orderType == 1){
    $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->updated_at).'</p>';
}else{
    if($this->getUserOnlineStatus($value->user_authority_updated_at) == 1){
     $myVisitorHtml .= '<p class="timing">Online</p>';
 }else{
  $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->user_authority_updated_at).'</p>';   
}
}

$myVisitorHtml .= '</div>
</div>';
}else{
    $myVisitor[] = [
        'id'            => $filter->user_id,
        'user_uid'            => $filter->_uid,
        'username'      => $filter->username,
        'profileImage'  => $profilePictureUrl,
        'gender'        => $gender,
        'dob'           => $filter->dob,
        'age'           => isset($filter->dob) ? Carbon::parse($filter->dob)->age : null,
        'city'           => $filter->city,
        'userLikeDislike'   => $userLikeDislike,
        'heading'           => $filter->heading,
        'user_relationship_status' => $filter->user_relationship_status,
        'user_education'           => $filter->user_education,
        'user_ethnicity'           => $filter->user_ethnicity,
        'user_body_type'           => $filter->user_body_type,
        'user_annual_income'           => $filter->user_annual_income,
        'user_net_worth'           => $filter->user_net_worth,
        'user_uid'           => $filter->main_user_uid,
        'user_id'           => $filter->main_user_id,
        'body_type_name'           => $filter->body_type_name,
        'ethnicity_name'           => $filter->ethnicity_name,
        'height'           => $filter->height,
        'userAge'       => $userAge,
        'countryName'   => $filter->countryName,
        'timeAgo' => $this->timeAgo($value->updated_at),
        'userOnlineStatus' => $this->getUserOnlineStatus($value->user_authority_updated_at),
        'isPremiumUser'     => isPremiumUser($filter->user_id),
        'detailString'  => implode(", ", array_filter([$userAge, $gender]))
    ];
}
}

}
}
}

// echo "<pre>";
// print_r($myVisitor);
// die;
if(isset($orderType)){
    return $myVisitorHtml;
}else{
    return $myVisitor;    
}

}


public function iVisit($orderType = null){
    // I visited
    // $iVisitedOnPrevGet = MemberView::where('by_view_id',Auth::user()->_id)->orderBy('updated_at','DESC')->get();
   $myVisitorHtml = "";
   if(isset($orderType)){
    if($orderType == 1){
      $iVisitedOnPrevGet = MemberView::join('user_authorities', 'member_view.to_view_id', '=', 'user_authorities.users__id')
      ->where('member_view.by_view_id',Auth::user()->_id)
      ->select('member_view.*','user_authorities.updated_at AS user_authority_updated_at')
      ->orderBy('member_view.updated_at','DESC')
      ->get();
  }else{
      $iVisitedOnPrevGet = MemberView::join('user_authorities', 'member_view.to_view_id', '=', 'user_authorities.users__id')
      ->where('member_view.by_view_id',Auth::user()->_id)
      ->select('member_view.*','user_authorities.updated_at AS user_authority_updated_at')
      ->orderBy('user_authorities.updated_at','DESC')
      ->get();
  }

}else{
    $iVisitedOnPrevGet = MemberView::join('user_authorities', 'member_view.to_view_id', '=', 'user_authorities.users__id')
    ->where('member_view.by_view_id',Auth::user()->_id)
    ->select('member_view.*','user_authorities.updated_at AS user_authority_updated_at')
    ->orderBy('member_view.updated_at','DESC')
    ->get();
}
$iVisitedOnPrev = array();
foreach ($iVisitedOnPrevGet as $key => $value) {        
    $filter = $this->getFullUserDetails($value->to_view_id);

if(isset($filter->main_user_id)){
    $fetchAllUserLikeDislike = DB::table('like_dislikes')->where('to_users__id',$filter->main_user_id)->where('by_users__id',Auth::user()->_id)->first();
    if (!__isEmpty($fetchAllUserLikeDislike)) {
        $userLikeDislike = $fetchAllUserLikeDislike->like;
    }else{
      $userLikeDislike = 0;
  }
  $profilePictureFolderPathFull = getPathByKey('profile_photo', ['{_uid}' => $filter->user_uid]);
  $profilePictureFolderPath = str_replace("/profile","",$profilePictureFolderPathFull);
  $profilePictureUrl = noThumbImageURL();

                // Check if user profile exists
  if (!__isEmpty($filter)) {
    if (!__isEmpty($filter->profile_picture)) {
        $profilePictureDrive = getMediaUrl($profilePictureFolderPath, $filter->profile_picture);
        $profilePictureUrl = url('/').'/media-storage/users/'.$filter->_uid.'/'.$filter->profile_picture;
    }
}


$userAge = isset($filter->dob) ? Carbon::parse($filter->dob)->age : null;
$gender = isset($filter->gender) ? configItem('user_settings.gender', $filter->gender) : null;

if(Auth::user()->_id != $filter->users__id){

if(isset($orderType)){
   $userOnlineStatus =  $this->getUserOnlineStatus($value->user_authority_updated_at);
   $myVisitorHtml .= '  <div class="vister d-flex justify-content-between pb-3 py-2">
   <div class="img-about d-flex align-items-flex-start">
   <div class="vister-image-icon">
   <img class="vister-profile-image" src="'.$profilePictureUrl.'" class="lw-user-thumbnail lw-lazy-img">
   <i class="fa-solid fa-camera"></i>
   </div>
   <div>
   <a href="'.url('member').'/'.$filter->_uid.'">

   <p class="user-name">';

   if($userOnlineStatus){

    if($userOnlineStatus == 1){
     $myVisitorHtml .= '<span class="lw-dot lw-dot-success" title="Online"></span>';
 }elseif($userOnlineStatus == 2){
  $myVisitorHtml .=  '<span class="lw-dot lw-dot-warning" title="Idle"></span>';
}elseif($userOnlineStatus == 3){
 $myVisitorHtml .= '<span class="lw-dot lw-dot-danger" title="Offline"></span>';
}

}
$myVisitorHtml .= $filter->username;

if($userLikeDislike == 1)
{
    $hasLike = "like_true";
    $hasLikeTitle = "Favorite";
}else{
    $hasLike = "";
    $hasLikeTitle = "Favorited";
} 

$myVisitorHtml .= '</p>
</a>
<p class="location">'.substr_replace($filter->heading, "...", 50).'</p>
<p class=" adress">'.$filter->city.'</p>
<div class="d-flex"><a href="'.url('member/').'/'.$filter->user_id.'"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>
<p>
<a href data-action="'.url('/').'/user/'.$filter->user_id.'/1/user-like-dislike" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
<i class="fa-solid fa-heart '.$hasLike.'"></i> <span>'.$hasLikeTitle.'</span></a>
</p>
</div>
</div>
</div>
<div class="d-none d-md-block mt-2">
<div class="about-vistor">
<p class="height"><b>Height : </b>'.$filter->height.'cm</p>
<p class="body"><b>Body : </b>'.$filter->user_body_type.'</p>
<p class="ethnicty"><b>Ethncity : </b>'.$filter->user_ethnicity.'</p>
</div>
</div>
<div class="time">';
if($orderType == 1){
    $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->updated_at).'</p>';
}else{
    if($this->getUserOnlineStatus($value->user_authority_updated_at) == 1){
       $myVisitorHtml .= '<p class="timing">Online</p>';
   }else{
      $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->user_authority_updated_at).'</p>';   
  }
}

$myVisitorHtml .= '</div>
</div>';
}else{


    $iVisitedOnPrev[] = [
        'id'            => $filter->user_id,
        'user_uid'            => $filter->_uid,
        'username'      => $filter->username,
        'profileImage'  => $profilePictureUrl,
        'gender'        => $gender,
        'dob'           => $filter->dob,
        'age'           => isset($filter->dob) ? Carbon::parse($filter->dob)->age : null,
        'city'           => $filter->city,
        'userLikeDislike'   => $userLikeDislike,
        'heading'           => $filter->heading,
        'user_relationship_status' => $filter->user_relationship_status,
        'user_education'           => $filter->user_education,
        'user_ethnicity'           => $filter->user_ethnicity,
        'user_body_type'           => $filter->user_body_type,
        'user_annual_income'           => $filter->user_annual_income,
        'user_net_worth'           => $filter->user_net_worth,
        'user_uid'           => $filter->main_user_uid,
        'user_id'           => $filter->main_user_id,
        'body_type_name'           => $filter->body_type_name,
        'ethnicity_name'           => $filter->ethnicity_name,
        'height'           => $filter->height,
        'userAge'       => $userAge,
        'countryName'   => $filter->countryName,
        'timeAgo' => $this->timeAgo($value->updated_at),
        'userOnlineStatus' => $this->getUserOnlineStatus($value->user_authority_updated_at),
        'updatedAgo' => $this->getUserOnlineStatusAgo($value->updated_at),
        'isPremiumUser'     => isPremiumUser($filter->user_id),
        'detailString'  => implode(", ", array_filter([$userAge, $gender]))
    ];
}
}
}

if(isset($orderType)){
    return $myVisitorHtml;
}else{
    return $iVisitedOnPrev;    
}

}

}

public function favorites($orderType = null)
{

    // Favorite
    // $getAllFavUsers = DB::table('like_dislikes')->where('by_users__id',Auth::user()->_id)->orderBy('updated_at','DESC')->get();

    $myVisitorHtml = "";
    if(isset($orderType)){
        if($orderType == 1){
         $getAllFavUsers = DB::table('like_dislikes')
         ->join('user_authorities', 'like_dislikes.to_users__id', '=', 'user_authorities.users__id')
         ->where('like_dislikes.by_users__id',Auth::user()->_id)
         ->select('like_dislikes.*','user_authorities.updated_at AS user_authority_updated_at')
         ->orderBy('like_dislikes.updated_at','DESC')
         ->get();
     }else{
         $getAllFavUsers = DB::table('like_dislikes')
         ->join('user_authorities', 'like_dislikes.to_users__id', '=', 'user_authorities.users__id')
         ->where('like_dislikes.by_users__id',Auth::user()->_id)
         ->select('like_dislikes.*','user_authorities.updated_at AS user_authority_updated_at')
         ->orderBy('user_authorities.updated_at','DESC')
         ->get();         
     }

 }else{

     $getAllFavUsers = DB::table('like_dislikes')
     ->join('user_authorities', 'like_dislikes.to_users__id', '=', 'user_authorities.users__id')
     ->where('like_dislikes.by_users__id',Auth::user()->_id)
     ->select('like_dislikes.*','user_authorities.updated_at AS user_authority_updated_at')
     ->orderBy('like_dislikes.updated_at','DESC')
     ->get();
 }
 $userFavData = array();
 if($getAllFavUsers){
    foreach ($getAllFavUsers as $key => $value) {    

        $userFav = $this->getFullUserDetails($value->to_users__id);

     
        if(isset($userFav->main_user_id)){
        $fetchAllUserLikeDislike = DB::table('like_dislikes')->where('to_users__id',$userFav->main_user_id)->where('by_users__id',Auth::user()->_id)->first();
        if ($fetchAllUserLikeDislike) {
            $userLikeDislike = $fetchAllUserLikeDislike->like;
        }else{
          $userLikeDislike = 0;
      }
      $profilePictureFolderPathFull = getPathByKey('profile_photo', ['{_uid}' => $userFav->user_uid]);
      $profilePictureFolderPath = str_replace("/profile","",$profilePictureFolderPathFull);
      $profilePictureUrl = noThumbImageURL();
                // Check if user profile exists
      if (!__isEmpty($userFav)) {
        if (!__isEmpty($userFav->profile_picture)) {
            $profilePictureDrive = getMediaUrl($profilePictureFolderPath, $userFav->profile_picture);
            $profilePictureUrl = url('/').'/media-storage/users/'.$userFav->_uid.'/'.$userFav->profile_picture;
        }
    }


    $userAge = isset($userFav->dob) ? Carbon::parse($userFav->dob)->age : null;
    $gender = isset($userFav->gender) ? configItem('user_settings.gender', $userFav->gender) : null;


    if(Auth::user()->_id != $userFav->users__id){


    if(isset($orderType)){
     $userOnlineStatus =  $this->getUserOnlineStatus($value->user_authority_updated_at);
     $myVisitorHtml .= '  <div class="vister d-flex justify-content-between pb-3 py-2">
     <div class="img-about d-flex align-items-flex-start">
     <div class="vister-image-icon">
     <img class="vister-profile-image" src="'.$profilePictureUrl.'" class="lw-user-thumbnail lw-lazy-img">
     <i class="fa-solid fa-camera"></i>
     </div>
     <div>
     <a href="'.url('member').'/'.$userFav->_uid.'">

     <p class="user-name">';

     if($userOnlineStatus){

        if($userOnlineStatus == 1){
           $myVisitorHtml .= '<span class="lw-dot lw-dot-success" title="Online"></span>';
       }elseif($userOnlineStatus == 2){
          $myVisitorHtml .=  '<span class="lw-dot lw-dot-warning" title="Idle"></span>';
      }elseif($userOnlineStatus == 3){
       $myVisitorHtml .= '<span class="lw-dot lw-dot-danger" title="Offline"></span>';
   }

}
$myVisitorHtml .= $userFav->username;

if($userLikeDislike == 1)
{
    $hasLike = "like_true";
    $hasLikeTitle = "Favorite";
}else{
    $hasLike = "";
    $hasLikeTitle = "Favorited";
} 

$myVisitorHtml .= '</p>
</a>
<p class="location">'.substr_replace($userFav->heading, "...", 50).'</p>
<p class=" adress">'.$userFav->city.'</p>
<div class="d-flex"><a href="'.url('member/').'/'.$userFav->user_id.'"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>
<p>
<a href data-action="'.url('/').'/user/'.$userFav->user_id.'/1/user-like-dislike" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
<i class="fa-solid fa-heart '.$hasLike.'"></i> <span>'.$hasLikeTitle.'</span></a>
</p>
</div>
</div>
</div>
<div class="d-none d-md-block mt-2">
<div class="about-vistor">
<p class="height"><b>Height : </b>'.$userFav->height.'cm</p>
<p class="body"><b>Body : </b>'.$userFav->user_body_type.'</p>
<p class="ethnicty"><b>Ethncity : </b>'.$userFav->user_ethnicity.'</p>
</div>
</div>
<div class="time">';
if($orderType == 1){
    $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->updated_at).'</p>';
}else{
    if($this->getUserOnlineStatus($value->user_authority_updated_at) == 1){
     $myVisitorHtml .= '<p class="timing">Online</p>';
 }else{
  $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->user_authority_updated_at).'</p>';   
}
}

$myVisitorHtml .= '</div>
</div>';
}else{

    $userFavData[] = [
        'id'            => $userFav->user_id,
        'user_uid'            => $userFav->_uid,
        'username'      => $userFav->username,
        'profileImage'  => $profilePictureUrl,
        'gender'        => $gender,
        'dob'           => $userFav->dob,
        'age'           => isset($userFav->dob) ? Carbon::parse($userFav->dob)->age : null,
        'city'           => $userFav->city,
        'userLikeDislike'   => $userLikeDislike,
        'heading'           => $userFav->heading,
        'user_relationship_status' => $userFav->user_relationship_status,
        'user_education'           => $userFav->user_education,
        'user_ethnicity'           => $userFav->user_ethnicity,
        'user_body_type'           => $userFav->user_body_type,
        'user_annual_income'           => $userFav->user_annual_income,
        'user_net_worth'           => $userFav->user_net_worth,
        'user_uid'           => $userFav->main_user_uid,
        'user_id'           => $userFav->main_user_id,
        'body_type_name'           => $userFav->body_type_name,
        'ethnicity_name'           => $userFav->ethnicity_name,
        'height'           => $userFav->height,
        'userAge'       => $userAge,
        'countryName'   => $userFav->countryName,
        'timeAgo' => $this->timeAgo($value->updated_at),
        'userOnlineStatus' => $this->getUserOnlineStatus($value->updated_at),
        'userOnlineStatus' => $this->getUserOnlineStatus($value->user_authority_updated_at),
        'isPremiumUser'     => isPremiumUser($userFav->user_id)
    ];
}
}
}
}
}
if(isset($orderType)){
    return $myVisitorHtml;
}else{
    return $userFavData;    
}

}


public function favoritesMe($orderType = null){

// Favorite Me
    // $getAllFavUsers = DB::table('like_dislikes')->where('to_users__id',Auth::user()->_id)->get();
    $myVisitorHtml = "";
    if(isset($orderType)){
        if($orderType == 1){
          $getAllFavUsers = DB::table('like_dislikes')
          ->join('user_authorities', 'like_dislikes.by_users__id', '=', 'user_authorities.users__id')
          ->where('like_dislikes.to_users__id',Auth::user()->_id)
          ->select('like_dislikes.*','user_authorities.updated_at AS user_authority_updated_at')
          ->orderBy('like_dislikes.updated_at','DESC')
          ->get();
      }else{

         $getAllFavUsers = DB::table('like_dislikes')
         ->join('user_authorities', 'like_dislikes.by_users__id', '=', 'user_authorities.users__id')
         ->where('like_dislikes.to_users__id',Auth::user()->_id)
         ->select('like_dislikes.*','user_authorities.updated_at AS user_authority_updated_at')
         ->orderBy('user_authorities.updated_at','DESC')
         ->get();       
     }

 }else{
   $getAllFavUsers = DB::table('like_dislikes')
   ->join('user_authorities', 'like_dislikes.by_users__id', '=', 'user_authorities.users__id')
   ->where('like_dislikes.to_users__id',Auth::user()->_id)
   ->select('like_dislikes.*','user_authorities.updated_at AS user_authority_updated_at')
   ->orderBy('like_dislikes.updated_at','DESC')
   ->get();
}

$userFavMeData = array();

foreach ($getAllFavUsers as $key => $value) {        
    $userFav = $this->getFullUserDetails($value->by_users__id);
      if(isset($userFav->main_user_id)){
    $fetchAllUserLikeDislike = DB::table('like_dislikes')->where('to_users__id',$userFav->main_user_id)->where('by_users__id',Auth::user()->_id)->first();
    if (!__isEmpty($fetchAllUserLikeDislike)) {
        $userLikeDislike = $fetchAllUserLikeDislike->like;
    }else{
      $userLikeDislike = 0;
  }
  $profilePictureFolderPathFull = getPathByKey('profile_photo', ['{_uid}' => $userFav->user_uid]);
  $profilePictureFolderPath = str_replace("/profile","",$profilePictureFolderPathFull);
  $profilePictureUrl = noThumbImageURL();
                // Check if user profile exists
  if (!__isEmpty($userFav)) {
    if (!__isEmpty($userFav->profile_picture)) {
        $profilePictureDrive = getMediaUrl($profilePictureFolderPath, $userFav->profile_picture);
        $profilePictureUrl = url('/').'/media-storage/users/'.$userFav->_uid.'/'.$userFav->profile_picture;
    }
}


$userAge = isset($userFav->dob) ? Carbon::parse($userFav->dob)->age : null;
$gender = isset($userFav->gender) ? configItem('user_settings.gender', $userFav->gender) : null;

  if(Auth::user()->_id != $userFav->users__id){


if(isset($orderType)){
 $userOnlineStatus =  $this->getUserOnlineStatus($value->user_authority_updated_at);
 $myVisitorHtml .= '  <div class="vister d-flex justify-content-between pb-3 py-2">
 <div class="img-about d-flex align-items-flex-start">
 <div class="vister-image-icon">
 <img class="vister-profile-image" src="'.$profilePictureUrl.'" class="lw-user-thumbnail lw-lazy-img">
 <i class="fa-solid fa-camera"></i>
 </div>
 <div>
 <a href="'.url('member').'/'.$userFav->_uid.'">

 <p class="user-name">';

 if($userOnlineStatus){

    if($userOnlineStatus == 1){
       $myVisitorHtml .= '<span class="lw-dot lw-dot-success" title="Online"></span>';
   }elseif($userOnlineStatus == 2){
      $myVisitorHtml .=  '<span class="lw-dot lw-dot-warning" title="Idle"></span>';
  }elseif($userOnlineStatus == 3){
   $myVisitorHtml .= '<span class="lw-dot lw-dot-danger" title="Offline"></span>';
}

}
$myVisitorHtml .= $userFav->username;

if($userLikeDislike == 1)
{
    $hasLike = "like_true";
    $hasLikeTitle = "Favorite";
}else{
    $hasLike = "";
    $hasLikeTitle = "Favorited";
} 

$myVisitorHtml .= '</p>
</a>
<p class="location">'.substr_replace($userFav->heading, "...", 50).'</p>
<p class=" adress">'.$userFav->city.'</p>
<div class="d-flex"><a href="'.url('member/').'/'.$userFav->user_id.'"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>
<p>
<a href data-action="'.url('/').'/user/'.$userFav->user_id.'/1/user-like-dislike" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
<i class="fa-solid fa-heart '.$hasLike.'"></i> <span>'.$hasLikeTitle.'</span></a>
</p>
</div>
</div>
</div>
<div class="d-none d-md-block mt-2">
<div class="about-vistor">
<p class="height"><b>Height : </b>'.$userFav->height.'cm</p>
<p class="body"><b>Body : </b>'.$userFav->user_body_type.'</p>
<p class="ethnicty"><b>Ethncity : </b>'.$userFav->user_ethnicity.'</p>
</div>
</div>
<div class="time">';
if($orderType == 1){
    $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->updated_at).'</p>';
}else{
    if($this->getUserOnlineStatus($value->user_authority_updated_at) == 1){
     $myVisitorHtml .= '<p class="timing">Online</p>';
 }else{
  $myVisitorHtml .= '<p class="timing">'.$this->timeAgo($value->user_authority_updated_at).'</p>';   
}
}

$myVisitorHtml .= '</div>
</div>';
}else{

    $userFavMeData[] = [
        'id'            => $userFav->user_id,
        'user_uid'            => $userFav->_uid,
        'username'      => $userFav->username,
        'profileImage'  => $profilePictureUrl,
        'gender'        => $gender,
        'dob'           => $userFav->dob,
        'age'           => isset($userFav->dob) ? Carbon::parse($userFav->dob)->age : null,
        'city'           => $userFav->city,
        'userLikeDislike'   => $userLikeDislike,
        'heading'           => $userFav->heading,
        'user_relationship_status' => $userFav->user_relationship_status,
        'user_education'           => $userFav->user_education,
        'user_ethnicity'           => $userFav->user_ethnicity,
        'user_body_type'           => $userFav->user_body_type,
        'user_annual_income'           => $userFav->user_annual_income,
        'user_net_worth'           => $userFav->user_net_worth,
        'user_uid'           => $userFav->main_user_uid,
        'user_id'           => $userFav->main_user_id,
        'body_type_name'           => $userFav->body_type_name,
        'ethnicity_name'           => $userFav->ethnicity_name,
        'height'           => $userFav->height,
        'userAge'       => $userAge,
        'countryName'   => $userFav->countryName,
        'timeAgo' => $this->timeAgo($value->updated_at),
        'userOnlineStatus' => $this->getUserOnlineStatus($value->user_authority_updated_at),
        'isPremiumUser'     => isPremiumUser($userFav->user_id)
    ];
}
}
}

if(isset($orderType)){
    return $myVisitorHtml;
}else{
    return $userFavMeData;    
}
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

public function update_select_option(Request $request){
    if($request->tabAction == 'view'){
        $getUsers = $this->myVisitor($request->tabOption);
        echo json_encode(array('status'=> 'success','request'=>$request->tabAction, 'html'=>$getUsers));
    }
    if($request->tabAction == 'visit'){
        $getUsers = $this->iVisit($request->tabOption);
        echo json_encode(array('status'=> 'success','request'=>$request->tabAction, 'html'=>$getUsers));
    }
    if($request->tabAction == 'favorites'){
        $getUsers = $this->favorites($request->tabOption);
        echo json_encode(array('status'=> 'success','request'=>$request->tabAction, 'html'=>$getUsers));
    }
    if($request->tabAction == 'favoritesMe'){
        $getUsers = $this->favoritesMe($request->tabOption);
        echo json_encode(array('status'=> 'success','request'=>$request->tabAction, 'html'=>$getUsers));
    }
}

}