<?php
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); 
$id = Auth::user()->_id;
$user =App\Exp\Components\User\Models\User::where('_uid',end($uriSegments))->first();
$userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id',$user['_id'])->first(); 
$ActivityLog = \App\Exp\Components\User\Models\ActivityLog::where('user_id',$user['_id'])->first(); 
$UserLike =App\Exp\Components\User\Models\LikeDislikeModal::where('to_users__id',$user['_id'])->where('by_users__id',$id)->first();
$UserLikeBY =App\Exp\Components\User\Models\LikeDislikeModal::where('by_users__id',$id)->where('to_users__id',$user['_id'])->first();
$MemberView =App\Exp\Components\User\Models\MemberView::where('to_view_id',$user['_id'])->first();
?>
<div class="navbar-nav sidebar accordion">
<ul class="sidebar-stickey" id="accordionSidebar">
 <li class="nav-item mt-2 d-sm-block d-md-none">

    <a href class="nav-link" onclick="getChatMessenger('user/messenger/all-conversation', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog">

        <i class="far fa-comments"></i>

        <span>Messenger</span>
    </a>
</li>

<!-- Notification Link -->

<li class="nav-item dropdown no-arrow mx-1 d-sm-block d-md-none">

    <a class="nav-link dropdown-toggle lw-ajax-link-action" href="user/notifications/read-all-notification" data-callback="onReadAllNotificationCallback" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-method="post">

        <i class="fas fa-bell fa-fw"></i>

        <span>Notification</span>

        <span class="badge badge-danger badge-counter" id="lwNotificationCount">0</span>

    </a>

    <!-- Dropdown - Alerts -->

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">

        <h6 class="dropdown-header">

        Notification                </h6>

        <!-- Notification block -->             

        <!-- info message -->

        <a class="dropdown-item text-center small text-gray-500">There are no notification.</a>

        <!-- /info message -->

        <!-- /Notification block -->

    </div>

</li>

<!-- /Notification Link -->



<!-- Nav Item - Messages -->

<li class="nav-item d-sm-block d-md-none">

    <a class="nav-link" href="user/credit-wallet">

        <i class="fas fa-coins fa-fw mr-2"></i>

        <span>Credit Wallet</span>

        <span class="badge badge-success badge-counter">0</span>

    </a>

</li>



<!-- Nav Item - Messages -->

<li class="nav-item d-sm-block d-md-none">

    <a class="nav-link" href  data-toggle="modal" data-target="#boosterModal">

        <i class="fas fa-bolt fa-fw mr-2"></i>

        <span>Profile Booster</span>

        <span id="lwBoosterTimerCountDownOnSB"></span>

    </a>

</li>

<?php 




if(Auth::user()->gender_selection == 1){
    $gender_selection = 'He';
    }else{
$gender_selection = 'She';
    }

// echo "<pre>";
// print_r($user);
// die;
?>

<li class="d-none d-md-block profile-img">

    <!-- profile related -->

    <div class="card">

        <div class="card-body">

           <div class="profile-image">
            <?php    if($userProfileGet['profile_picture']){
             $imgURL = url('/').'/media-storage/users/'.end($uriSegments).'/'.$userProfileGet['profile_picture'];  
         }else{
          $imgURL = url('/').'/imgs/default-image.png';
      } 
      ?>
      <img class="upload-images" src="{{ (isset($imgURL)) ? $imgURL : '' }}">



  </div>



</div>

</li>

<hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

<!-- Heading -->

<li class="nav-item d-flex justify-content-between">

  <span><i class="fa-solid fa-clock"></i>Joined</span><span> @if(isset($UserProfile->created_at)) <?= date("M d, Y", strtotime($UserProfile->created_at)); ?> @endif</span>

</li>

<li class="nav-item d-flex justify-content-between">

  <span><i class="fa-solid fa-clock"></i>Last Active</span><span> @if(isset($ActivityLog->created_at)) <?= date("M d, Y", strtotime($ActivityLog->created_at)); ?> @endif</span>

</li>
@if(isset($UserProfile->city))
<li class="nav-item d-flex justify-content-between">

  <span><i class="fa-solid fa-location-dot"></i> {{(isset($User->recent_login)) ? $User->recent_login : ''}}</span>

</li>
@endif
<li class="nav-item d-flex justify-content-between">

    <span><i class="fa-solid fa-certificate"></i>Verifications</span><span>   </span>

    </li>

    <!-- head -->

 <!--    <li class="nav-item d-flex justify-content-between side-bar-head">

      <span><i class="fa-solid fa-badge-check"></i>
  </span><span> </span>
</li> -->

<!--   <li class="nav-item d-flex text-left">

   <i class="fa-solid fa-comment-dots mt-2"></i>

   <span>Last Messaged  <p class="recent-dis">No messages.<a href="#">New conversation!</a></p></span>



</li> -->
<!-- 
<li class="nav-item d-flex text-left">

   <i class="fa-solid fa-eye mt-2"></i>
   <span>You last viewed her  <p class="recent-dis">{{( isset($user_activity['you_view_time'])) ? $user_activity['you_view_time'] : ''}}</p></span>

</li>
 -->
<li class="nav-item d-flex text-left">
    <i class="fa-solid fa-eye mt-2"></i>
    @if($user_activity['user_viewed_you_time'])
    <span>{{ $gender_selection }} last viewed you<p class="recent-dis">{{ $user_activity['user_viewed_you_time'] }}</p></span>
    @else
    <span>{{ $gender_selection }} last viewed you <p class="recent-dis">Not yet</p></span>
    @endif
</li>



<!-- <li class="nav-item d-flex text-left">


    @php  $hasLike = ""; 
    if(isset($UserLikeBY )){

       if($UserLikeBY['like'] == 1){
           $hasLike = "like_true";
       }else{

           $hasLike = "";

       }

   } @endphp
   <i class="fa-solid fa-heart mt-2 {{ $hasLike }}"></i>
   @if($hasLike)
   <span>You favorited her<p class="recent-dis"></p></span>
   @else
   <span>You favorited her<p class="recent-dis">Not yet</p></span>
   @endif
</li> -->


<li class="nav-item d-flex text-left">


    @php  $hasLike = ""; 
    if(isset($LikeDislike )){

       if($LikeDislike['like'] == 1){
           $hasLike = "like_true";
       }else{

           $hasLike = "";

       }

   } @endphp
   <i class="fa-solid fa-heart mt-2 {{ $hasLike }}"></i>
   @if($hasLike)
   <span>{{ $gender_selection }} favorited you <p class="recent-dis"></p></span>
   @else
   <span>{{ $gender_selection }} favorited you Not yet<p class="recent-dis">Not yet</p></span>
   @endif
</li>


</ul>
</div>
