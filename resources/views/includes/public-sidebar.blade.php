    <!-- Sidebar -->
        <ul class="navbar-nav sidebar  accordion" id="accordionSidebar">

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

<?php $userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id',Auth::user()->_id)->first(); ?>

    <li class="d-none d-md-block profile-img">

        <!-- profile related -->

        <div class="card">

            <div class="card-body">

               <div class="profile-image">
              @if(isset($userProfileGet->profile_picture))
                <img class="upload-images test" src="{{ asset('media-storage/users/') }}/{{ Auth::user()->_uid }}/{{ $userProfileGet->profile_picture }}">
                @else
                <img class="upload-images" src="{{ asset('imgs/no_thumb_image.jpg') }}">      
                @endif
            </div>


        </div>

    </li>

    <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

    <!-- Heading -->

    <li class="nav-item d-flex justify-content-between">

      <span>Member Since</span><span>@if(isset($userData['UserProfile']->created_at)) <?= date("M d, Y", strtotime($userData['UserProfile']->created_at)); ?> @endif</span>

  </li>

  

  <li class="nav-item d-flex justify-content-between">

      <span><i class="fa-solid fa-circle-question"></i><a href="{{ url('settings') }}?verifications=social">Get Verified </a>   </span><span></span>

  </li>
  
  <li class="nav-item d-flex justify-content-between">

      <span><i class="fa-solid fa-circle-question"></i><a href="{{ url('settings') }}?verifications=social">Connect your Facebook </a>   </span><span></span>

  </li>

  <li class="nav-item d-flex justify-content-between">

      <span><i class="fa-solid fa-circle-question"></i><a href="{{ url('settings') }}?verifications=social">Connect your Instagram</a> </span><span></span>

  </li>

  <li class="nav-item d-flex justify-content-between">

      <span><i class="fa-solid fa-circle-question"></i><a href="{{ url('settings') }}?verifications=social">Connect your LinkedIn</a> </span><span> </span>

  </li>







</ul>

