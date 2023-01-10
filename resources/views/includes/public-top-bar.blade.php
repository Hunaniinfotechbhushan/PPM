<style>
    .something_add_button {
       font-size: 35px;
       height: 30px;
       width: 30px;
       display: flex;
       justify-content: center;
       align-items: center;
       padding-bottom: 5px !important;
       /*  margin-top: 32px;*/
       /* margin-right: 10px; */
       /* margin-left: 10px; */
       border-radius: 5px;
       border: 3px solid #000;
       color: red;
       border-color: red;
/*     position: absolute;*/
z-index: 99;
}

/**loader**/

.loader {
    border: 9px solid #f3f3f3;
    border-radius: 50%;
    border-top: 9px solid #db3434;
    width: 60px;
    height: 60px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    position: absolute;
    z-index: 999;
    top: 50%;
    left: 50% !important;
}
#uploaded_image {
    background-color: #000000cf !important;
    width: 100% !important;
    height: 100% !important;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 9;
}
/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.ebcf_modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    z-index: 999;
}

/* Modal Content */
.ebcf_modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 28%;
}

/* The Close Button */
.ebcf_close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.ebcf_close:hover,
.ebcf_close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


.loop-noti-media {
    white-space: normal;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    border-left: 1px solid #e3e6f0;
    border-right: 1px solid #e3e6f0;
    border-bottom: 1px solid #e3e6f0;
    line-height: 1.3rem;
}
.topbar .dropdown-list .dropdown-header {
  background-color: #f41c1c;
  border: 1px solid #f41c1c;
  }

.notify-drop .dropdown-header {
    padding: 15px;
}
.notify-drop .notify-mes {
    padding: 0 15px;
    margin-bottom: 5px;
}
.notify-drop .mess-wrap {
    height: 45px;
    overflow-y: scroll;
}
</style>
<nav class="row navbar navbar-expand navbar-light topbar mb-4 static-top shadow menu-bar">
    <!-- Sidebar Toggle (Topbar) -->
    <a href="{{ url('/') }}" id="sidebarToggleTop" class="btn btn-link  rounded-circle mr-3">
        <img class="lw-logo-img" src="{{ url('/') }}/media-storage/logo/logo.png" alt="PPM">

    </a>

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <?php $userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id',Auth::user()->_id)->first();
    $chatMessages = \App\Exp\Components\Messenger\Models\ChatModel::where('to_users__id',Auth::user()->_id)->where('msg_status',0)->count();
    ?>
    <div class="nav-item dropdown no-arrow d-flex">
        <div class="sidebar-brand d-flex align-items-center" href="home">
            <div class="sidebar-brand-icon">
                <img class="lw-logo-img" src="{{ url('/') }}/media-storage/logo/logo.png" alt="PPM">
            </div>
            <a href="{{ url('/') }}/home">  <img class="lw-logo-img d-sm-none d-none d-md-block" src="{{ url('/') }}/media-storage/logo/logo.png" alt="PPM"></a>
            <ul>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(isset($userProfileGet->profile_picture))
                        <img class="img-profile rounded-circle round-mobile" src="{{ asset('media-storage/users/') }}/{{ Auth::user()->_uid }}/{{ $userProfileGet->profile_picture }}">                 @else               
                        <img class="img-profile rounded-circle round-mobile" src="{{ asset('imgs/no_thumb_image.jpg') }}">      
                        @endif
                    </a>
                    <!-- Dropdown - User Information -->
                    <div id="profile_drop_down" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <div class="d-flex">
                            <div class="img-profile-view">

                                @if(isset($userProfileGet->profile_picture))
                                <img class="img-profile rounded-circle" src="{{ asset('media-storage/users/') }}/{{ Auth::user()->_uid }}/{{ $userProfileGet->profile_picture }}">                 @else               
                                <img class="img-profile rounded-circle" src="{{ asset('imgs/no_thumb_image.jpg') }}">      
                                @endif
                            </div>
                            <div>
                                <p class="user-title">{{ Auth::user()->username }}</p>
                                <p class="profile-type">Stander</p>
                                <button class="upgrade-profile">Upgrade your profile</button>
                            </div>
                        </div>
                        <div class="d-flex about-profile-button">
                            <button class="web-button" onclick="window.location.href='<?= route("user.profile_view", ["username" => getUserAuthInfo('profile.username')]) ?>';">Edit Profile</button>
                            <button class="web-button" onclick="window.location.href='<?= route("user.profile_view", ["username" => getUserAuthInfo('profile.username')]) ?>';">View Profile</button>
                        </div>
                        <div class="bost-profile-button">
                            <button class="web-button">Boost Your Profile</button>
                            <button class="web-button">Get Verification</button>
                        </div>
                        <div class="option-list">
                            <p><i class="fa-solid fa-gear"></i><a href="{{ url('settings') }}">Settings</a></p>
                            <p><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="#" data-toggle="modal" data-target="#logoutModal"><?= __tr('Logout Profile') ?></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center ml-3">






                <ul class="d-flex header-menu">
                    <a href="{{ url('home') }}"> <li @if (Request::is('home')) class="active" @endif> <i class="fa-solid fa-list-check"></i>Activities</li></a>
                    <a href="{{ url('search') }}"> <li @if (Request::is('search')) class="active" @endif> <i class="fa-solid fa-magnifying-glass"></i>Search</li></a>
                    <a href="{{ url('updates') }}"><li @if (Request::is('updates')) class="active" @endif><i class="fa-solid fa-star"></i>Updates</li></a>
                    <a href="{{ url('events') }}"><li @if (Request::is('events')) class="active" @endif><i class="fa-solid fa-photo-film"></i>Meets</li></a>
                    <a href="{{ url('messenger') }}"><li @if (Request::is('messenger')) class="active" @endif><i class="fa-solid fa-comment-dots"></i>Message</li></a>
                </ul>
            </div>  
        </div>
        <ul class="navbar-nav">
  
            <!-- Notification Link -->
            <!-- Notification Link -->
            <?php $getNotification = \App\Exp\Components\User\Models\NotificationLog::where('users__id',Auth::user()->_id)
            ->where('slug','!=',null)->orderBy('_id', 'DESC')->take(20)->get(); 
  
            $getCountNotification = \App\Exp\Components\User\Models\NotificationLog::where('users__id',Auth::user()->_id)
            ->where('is_read',0)
            ->where('slug','!=',null)->count();
            ?>

            <li class="nav-item dropdown no-arrow d-md-block">
                <a href="{{url('image-approver-request')}}" class="nav-link"><i class="fa-solid fa-lock"></i></a>
            </li>
            
            <li class="nav-item dropdown no-arrow mx-1  d-md-block">
                <a id="notificationAlertSection" class="nav-link dropdown-toggle lw-ajax-link-action" href="<?= route('user.notification.write.read_all_notification') ?>" data-callback="onReadAllNotificationCallback" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-method="post">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="badge badge-danger badge-counter" data-model="totalNotificationCount">{{ $getCountNotification }}</span>
                </a>

                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in notify-drop" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        <?= __tr('Notification') ?>
                    </h6>

                    @forelse($getNotification as $key=>$value)
                    <?php
                    if($value->slug == 'photo/media-approve' || $value->slug == 'photo/media-reject' ){

                        $Add_class= 'loop-noti-media';

                    }else{
                        $Add_class= '';

                    } ?>
                    <!-- Notification block -->     
                      <div class="mess-wrap">
                    <a href="#" id="mySizeChart" class="{{ $Add_class }} d-flex align-items-center notify-mes">
                        <div class="notifiyData" idsnotify="{{ $value->users__id }}"></div>
                        <div class="notifiyuid" idsnotify="{{ $value->_uid }}"></div>
                        <div class="slugdatanotify" slugData="{{ $value->slug }}"></div>
                        <div class="photoidshow" photodata="{{ $value->photo_id }}"></div>
                        <div>
                            <div class="small text-gray-500">{{ isset($value->created_at) ? date('d M Y', strtotime($value->created_at)) : '' }}</div>
                            <span class="font-weight-bold">{{ isset($value->message) ? $value->message : '' }}</span>
                        </div>
                        <hr>
                    </a>
                </div>
                    @empty
                    <a class="dropdown-item text-center small text-gray-500"><?= __tr('There are no notification.') ?></a>
                    @endforelse
                    <!-- /Notification block -->
                </div>
            </li>
            <!-- /Notification Link -->
            <?php
            $translationLanguages = getStoreSettings('translation_languages');
            ?>
            <!-- Notification Link -->


            <!-- Language Menu -->
            @if(!__isEmpty($translationLanguages))
            <?php 
            $translationLanguages['en_US'] = [
                'id' => 'en_US',
                'name' => 'English',
                'is_rtl' => false,
                'status' => true
            ];
            ?>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block"><?= (isset($translationLanguages[CURRENT_LOCALE])) ? $translationLanguages[CURRENT_LOCALE]['name'] : '' ?></span>
                    &nbsp; <i class="fas fa-language"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <h6 class="dropdown-header">
                        <?= __tr('Choose your language') ?>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <?php foreach($translationLanguages as $languageId => $language) {
                        if ($languageId == CURRENT_LOCALE or (isset($language['status']) and $language['status'] == false)) continue;
                        ?>
                        <a class="dropdown-item" href="<?= route('locale.change', ['localeID' => $languageId]) .'?redirectTo='.base64_encode(Request::fullUrl());  ?>">
                            <?= $language['name'] ?>
                        </a>
                    <?php } ?>
                </div>
            </li>
            @endif
            <!-- Language Menu -->
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">

                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset($userProfileGet->profile_picture))
                    <img class="img-profile rounded-circle" src="{{ asset('media-storage/users/') }}/{{ Auth::user()->_uid }}/{{ $userProfileGet->profile_picture }}">                 @else               
                    <img class="img-profile rounded-circle" src="{{ asset('imgs/no_thumb_image.jpg') }}">      
                    @endif
                </a>

                <!-- Dropdown - User Information -->
                <div id="profile_drop_down"class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <div class="d-flex">
                        <div class="img-profile-view">
                            @if(isset($userProfileGet->profile_picture))
                            <img class="img-profile rounded-circle" src="{{ asset('media-storage/users/') }}/{{ Auth::user()->_uid }}/{{ $userProfileGet->profile_picture }}">
                            <div class="change_image"><a onclick="window.location.href='<?= route("user.profile_view", ["username" => getUserAuthInfo('profile.username')]) ?>';">Change</a></div>              
                            @else               
                            <img class="img-profile rounded-circle" src="{{ asset('imgs/no_thumb_image.jpg') }}">      
                            @endif
                        </div>
                        <div>
                            <p class="user-title">{{ Auth::user()->username }}</p>
                            <p class="profile-type">Stander</p>
                            <button class="upgrade-profile">Upgrade your profile</button>
                        </div>
                    </div>
                    <div class="d-flex about-profile-button">
                        <button class="web-button" onclick="window.location.href='<?= route("user.profile_view", ["username" => getUserAuthInfo('profile.username')]) ?>';">Edit Profile</button>
                        <button class="web-button" onclick="window.location.href='<?= route("user.profile_view", ["username" => getUserAuthInfo('profile.username')]) ?>';">View Profile</button>
                    </div>
                    <div class="bost-profile-button">
                        <button class="web-button">Boost Your Profile</button>
                        <button class="web-button">Get Verification</button>
                    </div>
                    <div class="option-list">
                        <p><i class="fa-solid fa-gear"></i><a href="{{ url('settings') }}">Settings</a></p>
                        <p><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <a href="#" data-toggle="modal" data-target="#logoutModal">
                                <?= __tr('Logout Profile') ?>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="uploaded_image_loader"></div>

        
        <div id="mySizeChartModal" class="ebcf_modal loop-noti-media-popup">
          <div class="ebcf_modal-content">
            <div class="noti-media-section"></div>
            <div class="image-pop-show-notify"></div>
        </div>
    </div>


    <script type="text/javascript">

        
           // hide notification meida
           var ebModal = document.getElementById('mySizeChartModal');
           window.onclick = function(event) {
            if (event.target == ebModal) {
                ebModal.style.display = "none";
            }
        }


        $(document).ready(function(){
            $('.something_add_button').click(function(){ $('#storyUpload').trigger('click'); });


   // Notification Message read

   $(document).on('click', '#notificationAlertSection', function(e){
        e.preventDefault();
        var User_Id = $('.notifiyData').attr('idsnotify');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:"{{ url('notification-read-request') }}",
            dataType : 'json',
            data: {User_Id:User_Id},              
            beforeSend:function(){

            },   
            success:function(response){
                if(response.sucess == true){

                    $('.image-pop-show-notify').html('<img src="'+response.image+'"  alt="Girl in a jacket" style="width: 100%;">');

                    $('.noti-media-section').html('<h6>'+response.messages+'</h6>');
                }
            }
        });

    });

   // Story Upload
   
    $(document).on('change', '#storyUpload', function(e){
       e.preventDefault();
            // return false;

            var myForm = $("#story_upload_form")[0];

            var formData = new FormData(myForm);
            console.log(formData);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:"{{ url('upload-user-story') }}",
                dataType : 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                   $('#uploaded_image_loader').html("<div id='uploaded_image'><div class='loader'></div></div>");
               },   
               success:function(response){
                if(response.status == 'success'){
                    showSuccessMessage("Story successfully uploaded.");
                    setInterval(function () {
                     location.reload();
                 },1000);
                }
            }
        });

            return false;
        });

            $(document).on('click', '.loop-noti-media', function(e){
                e.preventDefault();
                $('.loop-noti-media-popup').css("display", "block");
                $('.noti-media-section').html('');
                $('.image-pop-show-notify').html('');
                
                var User_Id = $('.notifiyData').attr('idsnotify');
                var Uid =   $(this).find('.notifiyuid').attr('uidsnotify');
                var slugData =  $(this).find('.slugdatanotify').attr('slugData');
                var photo_id =  $(this).find('.photoidshow').attr('photodata');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    url:"{{ url('get-user-notify-image') }}",
                    dataType : 'json',
                    data: {User_Id:User_Id,Uid:Uid,slugData:slugData,photo_id:photo_id},              
                    beforeSend:function(){
                     
                    },   
                    success:function(response){
                        if(response.sucess == true){

                            $('.image-pop-show-notify').html('<img src="'+response.image+'"  alt="Girl in a jacket" style="width: 100%;">');

                            $('.noti-media-section').html('<h6>'+response.messages+'</h6>');
                        }
                    }
                });


            });

    // Public Video Thumbnails Create 

    document.getElementById('storyUpload').addEventListener('change', function(event) {
    //alert('kk');

    const fileCheck = this.files[0];
    const  fileType = fileCheck['type'];
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/apng', 'image/avif', 'image/svg+xml'];
 //console.log(fileType);
 if (!validImageTypes.includes(fileType)) {


  var file = event.target.files[0];


  var fileReader = new FileReader();
  if (file.type.match('image')) {
    fileReader.onload = function() {
      var img = document.createElement('img');
      img.src = fileReader.result;
      document.getElementsByTagName('div')[0].appendChild(img);
  };
  fileReader.readAsDataURL(file);
} else {
    fileReader.onload = function() {
      var blob = new Blob([fileReader.result], {type: file.type});
      var url = URL.createObjectURL(blob);
      var video = document.createElement('video');
      var timeupdate = function() {
        if (snapImage()) {
          video.removeEventListener('timeupdate', timeupdate);
          video.pause();
      }
  };
  video.addEventListener('loadeddata', function() {
    if (snapImage()) {
      video.removeEventListener('timeupdate', timeupdate);
  }
});
  var snapImage = function() {
    var canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    var image = canvas.toDataURL();
    var success = image.length > 100000;
    if (success) {
      var img = document.createElement('img');
      img.src = image;
      console.log(image);

       //$('#videoThumbnailField').val(image);
       document.getElementById('videoThumbnailFieldstory').value = image;
    //  $('#videoThumbnailFieldstory').val(image);
}
return success;
};
video.addEventListener('timeupdate', timeupdate);
video.preload = 'metadata';
video.src = url;
      // Load video in Safari / IE11
      video.muted = true;
      video.playsInline = true;
      video.play();
  };
  fileReader.readAsArrayBuffer(file);
}
}else{

  var file = event.target.files[0];
  var fileReader = new FileReader();
  if (file.type.match('image')) {
    fileReader.onload = function() {
      var img = document.createElement('img');

      img.src = fileReader.result;
          // document.getElementsByTagName('div')[0].appendChild(img);
          var urlimage =  img;

          
          $(".imageOrvideo-result").html(urlimage);
          $(".upload-input-file").hide();
      };
      fileReader.readAsDataURL(file);
      
  };


}
});



});

</script>
