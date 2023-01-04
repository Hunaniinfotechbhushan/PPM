@extends('public-master')
@section('content')

@section('page-title', strip_tags($userData['userName']))
@section('head-title', strip_tags($userData['userName']))
@section('page-url', url()->current())

@if(isset($userData['aboutMe']))
@section('keywordName', strip_tags($userProfileData['aboutMe']))
@section('keyword', strip_tags($userProfileData['aboutMe']))
@section('description', strip_tags($userProfileData['aboutMe']))
@section('keywordDescription', strip_tags($userProfileData['aboutMe']))
@endif

@if(isset($userData['profilePicture']))
@section('page-image', $userData['profilePicture'])
@endif
@if(isset($userData['coverPicture']))
@section('twitter-card-image', $userData['coverPicture'])
@endif

<style type="text/css">
    .action-button {
        width: fit-content;
        background: #F51B1C;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 5px;
        cursor: pointer;
        padding: 10px 20px;
        margin: 10px 5px;
    }
    .pac-container{
        z-index: 9999;
    }


    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 9999;
        background: rgba(255,255,255,0.8) url("loading.gif") center no-repeat;
    }
/* Turn off scrollbar when body element has the loading class */
body.loading{
    overflow: hidden;   
}
/* Make spinner image visible when body element has the loading class */
body.loading .overlay{
    display: block;
}
.my-profile-verification-area li {
    border-bottom: 1px solid #ece6e6;
    padding-bottom: 5px;
}
</style>

<!-- if user block then don't show profile page content -->
@if($isBlockUser)   
<!-- info message -->
<div class="alert alert-info">
  <?= __tr('This user is unavailable.') ?>
</div>
<!-- / info message -->
@elseif($blockByMeUser)
<!-- info message -->
<div class="alert alert-info">
  <?= __tr('You have blocked this user.') ?>
</div>
<!-- / info message -->
@else


<!-- Begin Page Content -->

<div class="lw-page-content">

    <div class="overlay"></div>

    <!-- header advertisement -->

    <div class="lw-ad-block-h90">

    </div>

    <div class="card mobile-view-none ">

     <div class="card-header ">

      <!-- <h4><i class="fa-solid fa-user" style="color:#F51B1C; border:none !important;"></i>My Profile</h4> -->


      <div class="row">

          <div class="col-sm-12">

            <div class="ProfileInfoCard">
                <div class="ProfileInfoCard-content" style="width: 100%;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <h1 class="ProfileInfoCard-title" style="margin-right: 8px; margin-bottom: 8px;" data-cy="member-right-username"><span class="css-14op033" style="padding: 0px; display: inline;">{{ Auth::user()->username }}</span><span class="css-aa5qdl"></span></h1>
                        <a class="lw-icon-btn" href role="button" id=""  data-toggle="modal" data-target="#userSmallProfileEditPopup">
                            <i class="fa fa-pencil-alt"></i>
                        </a>

                    </div><div>
                      <!-- <p data-cy="heading-txt" class="ProfileInfoCard-bio">{{ $userData['userName'] }}</p> -->
                      <p class="ProfileInfoCard-heading" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><span>{{ $userData['userAge'] }} • </span><span>
                       @if($userData['gender_selection'] == 1)
                       Male
                       @endif
                       @if($userData['gender_selection'] == 2)
                       Female
                       @endif
                   </span><span>@if(isset($userData['UserProfile']->city)) {{ $userData['UserProfile']->city }} @endif</span></p>
                   <p data-cy="heading-txt" class="ProfileInfoCard-bio">@if(isset($userData['UserProfile']->heading)){{ $userData['UserProfile']->heading }}@endif</p>
               </div>
           </div>
       </div>
   </div>     
</div>

</div>

</div>

<div class="card mb-3 bg-white p-3">

    <div class="upload-img">

      <div class="row">

          <div class="col-sm-12">


           <div class="profile d-md-none">
             <?php $userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id',Auth::user()->_id)->first();?>
             <div class="user-profile" style="background-image: url('{{ asset('media-storage/users/') }}/{{ Auth::user()->_uid }}/{{ $userProfileGet->profile_picture }}');">

                <div class="user-about-short">

                  <a class="lw-icon-btn" href role="button" id=""  data-toggle="modal" data-target="#userSmallProfileEditPopup">
                    <i class="fa fa-pencil-alt"></i>
                </a>

                <div class="mobile-short-details">
                    <h4>{{ Auth::user()->username }}</h4>

                    <p class="ProfileInfoCard-heading" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><span>{{ $userData['userAge'] }} • </span><span>
                       @if($userData['gender_selection'] == 1)
                       Male
                       @endif
                       @if($userData['gender_selection'] == 2)
                       Female
                       @endif
                   </span><span>@if(isset($userData['UserProfile']->city)){{ $userData['UserProfile']->city }} @endif</span></p>

                   <p data-cy="heading-txt" class="ProfileInfoCard-bio">@if(isset($userData['UserProfile']->heading)) {{ $userData['UserProfile']->heading }} @endif</p>
               </div>
           </div>

       </div>

   </div>

</div>

</div>

<div class="row loaded_images">

    @forelse ($userData['userPhotoCollection'] as $key => $collections)
    @if($collections->type == 1)

    <?php  $imageType = 'public'; ?>
    @else
    <?php $imageType = 'private';  ?>
    @endif
    <?php  $imgURL = url('/').'/media-storage/users/'.getUserUID().'/'.$collections->file;
    $videourl = url('/').'/media-storage/users/'.getUserUID().'/'.$collections->video_thumbnail;
    ?>

    <div class="col-4 col-sm-4 col-lg-3 col-md-3 p-1 {{$collections->_id}}">
     <div class="image-box">         
         @if($collections->extantion_type == 'mp4' || $collections->extantion_type == 'MOV' || $collections->extantion_type == 'wmv' || $collections->extantion_type == 'WMV' || $collections->extantion_type == '3gp' || $collections->extantion_type == '3GP' || $collections->extantion_type == 'avi' || $collections->extantion_type == 'AVI' || $collections->extantion_type == 'f4v' || $collections->extantion_type == 'f4v' || $collections->extantion_type == 'MP4' || $collections->extantion_type == 'mov' || $collections->extantion_type == 'webm' || $collections->extantion_type == 'mkv' || $collections->extantion_type == 'flv' || $collections->extantion_type == 'svi' || $collections->extantion_type == 'mpg'|| $collections->extantion_type == 'mpeg'|| $collections->extantion_type == 'amv')
         <div class="outer-settint show_hide"><i class='fa fa-gear photto-setting-icon' id="show_hide" data-photto-id="{{$collections->_id}}"></i></div>
         <div id="trigger_vdo" class="span4 proj-div videoplay trigger_vdo" dataivideo="{{ $imgURL }}">
             @if($collections->type == 2)
             <i class="fa-solid fa-lock lock"></i>
             @endif
             <a href="{{ $imgURL }}" class="glightbox4">
                 <img class="upload-images" src="{{ $videourl }}">
                @if($collections->is_verified == 2)
                 <div class="text-block-on-image">
                    <h5>Pending approval</h5>
                    <p>(doesn't take long)</p>
                </div>
            @endif
                <i class="fa fa-play" aria-hidden="true"></i>
            </a>
            <input type="hidden" id="video_type" dataivideo_type="{{ $collections->extantion_type }}" value="{{$collections->extantion_type}}"> 
        </div>
        <div id="toggle_tst" class="toggle_tst" style="display:none;">
          @if($collections->type == 1)
          <a class="move_photo" data-photto-id="{{$collections->_id}}"  href="#">Move to Private</a>
          @else
          <a class="move_photo_public" data-photto-id="{{$collections->_id}}"  href="#">Move to Public</a>
          @endif
          <a class="delete_photo" data-photto-id="{{$collections->_id}}" href="#">Delete Video</a>
      </div>
      @else
      <div class="outer-settint show_hide"><i class='fa fa-gear photto-setting-icon' id="show_hide" data-photto-id="{{$collections->_id}}"></i>
      </div>
      <div id="trigger_img" class="trigger_img" dataimg="{{ $imgURL }}">


        @if($collections->type == 2)
        <i class="fa-solid fa-lock lock"></i>
        @endif
        <a href="{{ $imgURL }}" class="glightbox4">
            <img class="upload-images image_url_" id="image_url_" src="{{ $imgURL }}">
            @if($collections->is_verified == 2)
                 <div class="text-block-on-image">
                    <h5>Pending approval</h5>
                    <p>(doesn't take long)</p>
                </div>
            @endif

            @if($collections->is_verified == 0)
            <div class="text-block-on-image">
                <h5>Rejected By Admin</h5>
            </div>
            @endif
        </a>
        @if($collections->primary == 1)
        <div class="primay_image"><span>Primary</span></div>
        @endif
    </div>
    <div id="toggle_tst" class="toggle_tst" style="display:none;">

        <?php //echo "<pre>"; print_r($collections); die();?>

        @if($collections->type == 1)
        @if($collections->primary == 0)
        @if($collections->is_verified == 1)
        <a class="set_profile_pic" data-photto-uid="{{$collections->_uid}}" data-photto-id="{{$collections->_id}}" data-photto-name="{{$collections->file}}"  href="#" >Set as Primary</a>
        @endif
        @endif
           @if($collections->is_verified == 1)
        <a class="move_photo" data-photto-id="{{$collections->_id}}"  href="#" >Move to Private</a>
           @endif
        <a class="delete_photo" data-photto-id="{{$collections->_id}}" href="#" >Delete Photo</a>
        
        @else
           @if($collections->is_verified == 1)
        <a class="move_photo_public" data-photto-id="{{$collections->_id}}"  href="#" >Move to Public</a>
           @endif
        <a class="delete_photo" data-photto-id="{{$collections->_id}}" href="#" >Delete Photo</a>
        @endif
        
    </div>
    @endif

</div>

</div>

@empty
@endforelse 



<div class="col-4 col-sm-4 col-lg-3 col-md-3 p-1 ">
   <div class="image-box add-new-image">
       <a data-toggle="modal" data-target="#userPhottoPopup">
          <i class="fa-solid fa-upload"></i>
          <p>Add Image/Video</p>
      </a>
  </div>
</div>
</div>

</div>

</div>







<!-- /User Profile and Cover photo -->

<!-- User Basic Information -->

<div class="card mb-3 d-md-none">            

    <!-- Basic information Header -->

    <div class="card-header">

        <!-- Check if its own profile -->

        <span class="float-right">

          <a class="lw-icon-btn" href role="button" id=""  data-toggle="modal" data-target="#userProfilePopup">

            <i class="fa fa-pencil-alt"></i>

        </a>



        <a class="lw-icon-btn" href role="button" id="lwCloseBasicInfoEditBlock" style="display: none;">

            <i class="fa fa-times"></i>

        </a>

    </span>

    <!-- /Check if its own profile -->

    <h5>Information</h5>

</div>

<!-- /Basic information Header -->

<!-- Basic Information content -->

<div class="card-body my-profile-verification-area">

    <!-- Heading -->

    <li class="nav-item d-flex justify-content-between p-2">


    </li>

    <li class="nav-item d-flex justify-content-between">

      <span><i class="fa-solid fa-circle-question"></i>Joined  </span><span>@if(isset($userData['UserProfile']->created_at))<?= date("M d, Y", strtotime($userData['UserProfile']->created_at)); ?> @endif</span>

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


</div>

</div>







<!-- User Basic Information -->

<div class="card mb-3">            

    <!-- Basic information Header -->

    <div class="card-header">

        <!-- Check if its own profile -->

        <span class="float-right">

            <a class="lw-icon-btn" href role="button" id=""  data-toggle="modal" data-target="#userProfilePopup">

                <i class="fa fa-pencil-alt"></i>

            </a>

            <a class="lw-icon-btn" href role="button" id="lwCloseBasicInfoEditBlock" style="display: none;">

                <i class="fa fa-times"></i>

            </a>

        </span>

        <!-- /Check if its own profile -->

        <h5> Basic Information</h5>



    </div>

    <!-- /Basic information Header -->

    <!-- Basic Information content -->

    <div class="card-body">

        <!-- Static basic information container -->

        <div id="lwStaticBasicInformation">

            <div class="form-group row">

                <!-- First Name -->

                <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                    <label for="looking_for"><strong><?= __tr('Looking For') ?></strong></label>


                    <div class="lw-inline-edit-text" data-model="userData.interest_selection">
                        <?php //echo "<pre>"; print_r($userData['interest_selection']); die;?>
                        @if($userData['interest_selection'] == '1')
                        Men
                        @elseif($userData['interest_selection'] == '2')
                        Women
                        @else
                        Men, Women
                        @endif
                    </div>

                </div>
     @if($userData['gender_selection'] == 1)
                <div class="col-4 col-sm-4">

                    <label for="net_Worth"><strong><?= __tr('Net Worth') ?></strong></label>
                    <div class="lw-inline-edit-text" data-model="userData.last_name">$@if(isset($userData['UserProfile']->user_net_worth)){{ $userData['UserProfile']->user_net_worth ? $userData['UserProfile']->user_net_worth : '-' }} @endif</div>

                </div>



                <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                    <label for="annual_income"><strong><?= __tr('Annual Income') ?></strong></label>
                    <div class="lw-inline-edit-text" data-model="profileData.gender_text">$@if(isset($userData['UserProfile']->user_annual_income)){{ $userData['UserProfile']->user_annual_income ? $userData['UserProfile']->user_annual_income : '-' }} @endif
                    </div>

                </div>
                @else


<div class="col-4 col-sm-4 mb-3 mb-sm-0">

    <label for="relationship"><strong><?= __tr('Relationship') ?></strong></label>
    <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
      @if(isset($userData['UserProfile']->user_relationship_status)){{ $userData['UserProfile']->user_relationship_status ? $userData['UserProfile']->user_relationship_status : '-' }} @endif
  </div>

</div>


    <div class="col-4 col-sm-4 mb-3 mb-sm-0">

        <label for="relationship"><strong><?= __tr('Hair Color') ?></strong></label>
        <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
          @if(isset($userData['UserProfile']->user_hair_color)){{ $userData['UserProfile']->user_hair_color ? $userData['UserProfile']->user_hair_color : '-' }} @endif
      </div>

  </div>

 @endif
            </div>


            <div class="form-group row">

                <!-- Gender -->


                <div class="col-4 col-sm-4">

                    <label><strong><?= __tr('Ethnicity') ?></strong></label>
                    <div class="lw-inline-edit-text" data-model="profileData.formatted_preferred_language">
                     @if(isset($userData['UserProfile']->user_ethnicity)){{ $userData['UserProfile']->user_ethnicity ? $userData['UserProfile']->user_ethnicity : '-' }} @endif
                 </div>

             </div>



             <div class="col-4 col-sm-4 mb-3 mb-sm-0">
                <label><strong><?= __tr('Children') ?></strong></label>
                <div class="lw-inline-edit-text" data-model="profileData.formatted_relationship_status">
                    @if(isset($userData['UserProfile']->children)){{ $userData['UserProfile']->children ? $userData['UserProfile']->children : '-' }} @endif
                </div>

            </div>


            <div class="col-4 col-sm-4">
                <label for="education"><strong><?= __tr('Education') ?></strong></label>
                <div class="lw-inline-edit-text" data-model="profileData.formatted_work_status">
                   @if(isset($userData['UserProfile']->user_education)){{ $userData['UserProfile']->user_education ? $userData['UserProfile']->user_education : '-' }} @endif
               </div>

           </div>



       </div>

       <div class="form-group row">


        <div class="col-4 col-sm-4 mb-3 mb-sm-0">

            <label for="smokes"><strong><?= __tr('Smokes') ?></strong></label>
            <div class="lw-inline-edit-text" data-model="profileData.formatted_education">

                @if(isset($userData['UserProfile']->smoke))
                @if($userData['UserProfile']->smoke == 1)
                Non Smoker
                @elseif($userData['UserProfile']->smoke == 2)
                Light Smoker
                @elseif($userData['UserProfile']->smoke == 3)
                Heavy Smoker
                @else
                -
                @endif
                @endif
            </div>

        </div>


        <div class="col-4 col-sm-4">

            <label for="body_type"><strong><?= __tr('Body Type') ?></strong></label>
            <div class="lw-inline-edit-text" data-model="profileData.birthday">
               @if(isset($userData['UserProfile']->user_body_type)){{ $userData['UserProfile']->user_body_type ? $userData['UserProfile']->user_body_type : '-' }} @endif
           </div>
       </div>


       <div class="col-4 col-sm-4 mb-3 mb-sm-0">

        <label for="relationship"><strong><?= __tr('Eye Color') ?></strong></label>
        <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
          @if(isset($userData['UserProfile']->user_eye_color)){{ $userData['UserProfile']->user_eye_color ? $userData['UserProfile']->user_eye_color : '-' }} @endif
      </div>

  </div>




  <!-- /Work Status -->


  <!-- Education -->


</div>

<div class="form-group row">




  <div class="col-4 col-sm-4 mb-3 mb-sm-0">

    <label for="drinks"><strong><?= __tr('Drinks') ?></strong></label>
    <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
        @if(isset($userData['UserProfile']->drink))
        @if($userData['UserProfile']->drink == 1)
        Non Drinker
        @elseif($userData['UserProfile']->drink == 2)
        Social Drinker
        @elseif($userData['UserProfile']->drink == 3)
        Heavy Drinker
        @else
        -
        @endif
        @endif
    </div>

</div>


<div class="col-4 col-sm-4">

 <label for="height"><strong><?= __tr('Height') ?></strong></label>
 <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
    @if(isset($userData['UserProfile']->height)){{ $userData['UserProfile']->height ? $userData['UserProfile']->height  : '-' }} @if($userData['UserProfile']->height != 'other')<span>cm</span> @endif @endif
</div>


</div>
    @if($userData['gender_selection'] == 1)
<div class="col-4 col-sm-4 mb-3 mb-sm-0">

    <label for="relationship"><strong><?= __tr('Relationship') ?></strong></label>
    <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
      @if(isset($userData['UserProfile']->user_relationship_status)){{ $userData['UserProfile']->user_relationship_status ? $userData['UserProfile']->user_relationship_status : '-' }} @endif
  </div>

</div>
@endif
</div>

<!--- new --->


<div class="form-group row">



    @if($userData['gender_selection'] == 1)
    <div class="col-4 col-sm-4 mb-3 mb-sm-0">

        <label for="relationship"><strong><?= __tr('Hair Color') ?></strong></label>
        <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
          @if(isset($userData['UserProfile']->user_hair_color)){{ $userData['UserProfile']->user_hair_color ? $userData['UserProfile']->user_hair_color : '-' }} @endif
      </div>

  </div>

@endif

</div>


<!---end----->
</div>
</div>

</div>







<!-- /User Basic Information -->

<div class="card mb-3">

    <div class="card-header">

        <span class="float-right">

            <a class="lw-icon-btn" href role="button" id="" data-toggle="modal" data-target="#userAboutMePopup">

                <i class="fa fa-pencil-alt"></i>

            </a>

            <a class="lw-icon-btn" href role="button" id="lwCloseLocationBlock" style="display: none;">

                <i class="fa fa-times"></i>

            </a>

        </span>

        <h5>About</h5>

    </div>

    <div class="card-body about-me-section">

        <!-- info message -->

        <p>@if(isset($userData['UserProfile']->about_me))<?= $userData['UserProfile']->about_me ?> @endif</p>

    </div>

</div>




<!-- /User Basic Information -->

<div class="card mb-3">

    <div class="card-header">

        <span class="float-right">

            <a class="lw-icon-btn" href role="button" id="" data-toggle="modal" data-target="#interestSectionPopup">

                <i class="fa fa-pencil-alt"></i>

            </a>

            <a class="lw-icon-btn" href role="button" id="lwCloseLocationBlock" style="display: none;">

                <i class="fa fa-times"></i>

            </a>

        </span>

        <h5>Interest</h5>

    </div>

    <div class="card-body insterest-section-html-section">

        @if($userData['interest_selection'] == '1')
        Men
        @elseif($userData['interest_selection'] == '2')
        Women
        @else
        Men, Women
        @endif


    </div>

</div>


<!-- /User Basic Information -->

<div class="card mb-3">

    <div class="card-header">

        <span class="float-right">

            <a class="lw-icon-btn" href role="button" id="" data-toggle="modal" data-target="#userLookingForPopup">

                <i class="fa fa-pencil-alt"></i>

            </a>

            <a class="lw-icon-btn" href role="button" id="lwCloseLocationBlock" style="display: none;">

                <i class="fa fa-times"></i>

            </a>

        </span>

        <h5>Looking For</h5>

    </div>

    <div class="card-body looking_for_section">

       <div class="tag-group">
        @if(isset($userData['UserProfile']->user_tag))
        @forelse (unserialize($userData['UserProfile']->user_tag) as $key => $selectedTag)
        <?php  $tagData = \App\Exp\Components\User\Models\UserTag::find($selectedTag);  ?>
        @if($tagData)
        <button class="tag"><?php echo $tagData->name; ?><i class="fa-solid fa-plus"></i></button>
        @endif
        @empty
        <p class="mt-3">CleverHottie hasn't filled out this section yet.</p>
        @endforelse   
        @endif

    </div>

    <div class="tag-group">
      <span> @if(isset($userData['UserProfile']->what_are_you_seeking)) <?= $userData['UserProfile']->what_are_you_seeking ?> @endif</span>

  </div>


</div>

<!-- /User Specifications -->

</div>

</div>

@endif
<!-- /if user block then don't show profile page content -->


<!-- Usert Photto Model -->

<div class="modal fade" id="userPhottoPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0  text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel"></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />
  <form class="userPhottoForm" id="userPhottoForm" method="post" enctype="multipart/form-data">
   <input type="hidden" id="phottoFromInput" name="phottoFrom">
   <input type="hidden" id="videoThumbnailField" name="videoThumbnail">
   <div class="modal-body">
    <div class="upload-input-file">
       <div class="form-group text-center">
        <input id='userUploadPublicPhottoButton' name="public_profile_picture" type='file' hidden/>
        <input id='userPublicUploadFileButton' class="action-button" type='button' value='Add a public photo/video' />

    </div>

    <div class="form-group text-center">
      <input id='userUploadPrivatePhottoButton' name="private_profile_picture" type='file' hidden/>
      <input id='userPrivateUploadFileButton' class="action-button" type='button' value='Add a private photo/video' />      
  </div>
</div>

<div class="imageOrvideo-result">
</div>

</div>
<div id="uploaded-image-video-section"></div>
<hr />
<div class="modal-footer border-top-0 d-flex justify-content-center">
    <p class="css-naj1a3 upload-msg-private">Private photos/videos can only be seen by members that you have shared access with.</p>

    <button type="button" class="btn btn-danger userPhottoCancelBtn" data-dismiss="modal" aria-label="Close">
      Cancel
  </button>
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>

<!-- interest Section popup -->

<!-- Information Edit Popup -->

<div class="modal fade" id="interestSectionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">Edit Your Interest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />
  <form class="interestSectionForm" id="interestSectionForm" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>">
     <input type="hidden" name="action" value="interestSectionEditForm">
     <div class="modal-body">


        <div class="form-group">
            <label for="email1">Looking for</label>  

            @if( strpos(Auth::user()->interest_selection, ',') !== false )
            <label class="css-kzbnq6 css-aan59y">
                <input type="checkbox" name="interest_selection[]" data-cy="male-checkbox" value="1" checked=""><span class="css-pwa2jd">Men</span>
            </label>

            <label class="css-kzbnq6 css-aan59y">
                <input type="checkbox" name="interest_selection[]" data-cy="female-checkbox" value="2" checked=""><span class="css-pwa2jd">Women</span>
            </label>
            @else
            <label class="css-kzbnq6 css-aan59y">
                <input type="checkbox" name="interest_selection[]" data-cy="male-checkbox" value="1" @if(Auth::user()->interest_selection == 1) checked="true" @endif><span class="css-pwa2jd">Men</span>
            </label>

            <label class="css-kzbnq6 css-aan59y">
                <input type="checkbox" name="interest_selection[]" data-cy="female-checkbox" value="2" @if(Auth::user()->interest_selection == 2) checked="true" @endif><span class="css-pwa2jd">Women</span>
            </label>
            @endif

        </div>



    </div>
    <hr />
    <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="button" class="btn btn-danger interestSectionFormCloseBtn" data-dismiss="modal" aria-label="Close">
          Cancel
      </button>
      <button type="submit" class="btn btn-success">Submit</button>
  </div>
</form>
</div>
</div>
</div>


<!-- Information Edit Popup -->

<div class="modal fade" id="userProfilePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">Edit Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />
  
  <form class="basicInfoSectionForm" id="basicInfoSectionForm" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>">
     <input type="hidden" name="action" value="secondStepUserEditForm">
     <div class="modal-body">
        @if($userData['gender_selection'] == 1)
      <div class="form-group">
        <label for="email1">Net Worth</label>       


        <select name="net_worth" class="form-control" id="net_worth">

           @forelse($userData['netWorth'] as $key => $net)
           <option value="<?= $net['_id'] ?>"@if(isset($userData['UserProfile']->net_worth))   <?= ($net['_id'] == $userData['UserProfile']->net_worth) ? 'selected' : '' ?> @endif>$<?= $net['name'] ?></option>
           @empty
           @endforelse
       </select>
   </div>

   <div class="form-group">
    <label for="email1">Annual Income</label>       


    <select name="income" class="form-control" id="net_worth">
        @forelse($userData['annualIncome'] as $key => $annual)
        <option value="<?= $annual['_id'] ?>"@if(isset($userData['UserProfile']->income))  <?= ($annual['_id'] == $userData['UserProfile']->income) ? 'selected' : '' ?> @endif >$<?= $annual['name'] ?></option>
        @empty
        @endforelse
    </select>
</div>

@endif
<div class="form-group">
    <label for="email1">Looking for</label>       

    @if( strpos(Auth::user()->interest_selection, ',') !== false )
    <label class="css-kzbnq6 css-aan59y">
        <input type="checkbox" name="interest_selection[]" data-cy="male-checkbox" value="1" checked=""><span class="css-pwa2jd">Men</span>
    </label>

    <label class="css-kzbnq6 css-aan59y">
        <input type="checkbox" name="interest_selection[]" data-cy="female-checkbox" value="2" checked=""><span class="css-pwa2jd">Women</span>
    </label>
    @else
    <label class="css-kzbnq6 css-aan59y">
        <input type="checkbox" name="interest_selection[]" data-cy="male-checkbox" value="1" @if(Auth::user()->interest_selection == 1) checked="true" @endif><span class="css-pwa2jd">Men</span>
    </label>

    <label class="css-kzbnq6 css-aan59y">
        <input type="checkbox" name="interest_selection[]" data-cy="female-checkbox" value="2" @if(Auth::user()->interest_selection == 2) checked="true" @endif><span class="css-pwa2jd">Women</span>
    </label>
    @endif

    

</div>

<div class="form-group">
    <label for="email1">Preferred Ages</label>   

    <div class="wrapper-range">
      <div class="values">
        <span id="range1">
          <?php 


          if(null !== getUserSettings('min_age')){ echo getUserSettings('min_age'); }else{ echo "18"; } ?>
      </span>
      <span> &dash; </span>
      <span id="range2">
          <?php if(null !== getUserSettings('max_age')){ echo getUserSettings('max_age'); }else{ echo "60"; } ?>+
      </span>
  </div>
  <div class="container-range">
    <div class="slider-track"></div>
    <input type="range" name="min_age" min="18" max="60" value="<?php if(null !== getUserSettings('min_age')){ echo getUserSettings('min_age'); }else{ echo "18"; } ?>" id="slider-1" oninput="slideOne()">

    <input type="range" name="max_age" min="18" max="60" value="<?php if(null !== getUserSettings('max_age')){ echo getUserSettings('max_age'); }else{ echo "60"; } ?>" id="slider-2" oninput="slideTwo()"> 
</div>
</div>
</div>


<div class="form-group">
    <label for="email1">Body Type</label>       


    <select name="body_type" class="form-control" id="body_type">
        @forelse($userData['bodyType'] as $key => $bodytypeval)
        <option value="<?= $bodytypeval['_id'] ?>" @if(isset($userData['UserProfile']->body_type)) <?= ($bodytypeval['_id'] == $userData['UserProfile']->body_type) ? 'selected' : '' ?> @endif ><?= $bodytypeval['name'] ?></option>
        @empty
        @endforelse
    </select>
</div>

<div class="form-group">
    <label for="email1">Height</label>    
    

    <select name="height" class="ppm-form-select" >
        <option text-value="" class="infoSelector" value="">Height</option>
        <option text-value="137 cm" class="infoSelector" value="137" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 137) ? 'selected' : '' ?> @endif >137 cm</option>
        <option text-value="138 cm" class="infoSelector" value="138" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 138) ? 'selected' : '' ?> @endif>138 cm</option>
        <option text-value="139 cm" class="infoSelector" value="139"   @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 139) ? 'selected' : '' ?>@endif>139 cm</option>
        <option text-value="140 cm" class="infoSelector" value="140"  @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 140) ? 'selected' : '' ?>@endif>140 cm</option>
        <option text-value="141 cm" class="infoSelector" value="140" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 141) ? 'selected' : '' ?>@endif>141 cm</option>
        <option text-value="142 cm" class="infoSelector" value="142" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 142) ? 'selected' : '' ?>@endif>142 cm</option>
        <option text-value="143 cm" class="infoSelector" value="143" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 143) ? 'selected' : '' ?>@endif>143 cm</option>
        <option text-value="144 cm" class="infoSelector" value="144" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 144) ? 'selected' : '' ?>@endif>144 cm</option>
        <option text-value="145 cm" class="infoSelector" value="145" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 145) ? 'selected' : '' ?>@endif>145 cm</option>
        <option text-value="146 cm" class="infoSelector" value="146" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 146) ? 'selected' : '' ?>@endif>146 cm</option>
        <option text-value="147 cm" class="infoSelector" value="147" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 147) ? 'selected' : '' ?>@endif>147 cm</option>
        <option text-value="148 cm" class="infoSelector" value="148" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 148) ? 'selected' : '' ?>@endif>148 cm</option>
        <option text-value="149 cm" class="infoSelector" value="149" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 149) ? 'selected' : '' ?>@endif>149 cm</option>
        <option text-value="150 cm" class="infoSelector" value="150"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 150) ? 'selected' : '' ?>@endif>150 cm</option>
        <option text-value="151 cm" class="infoSelector" value="151" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 151) ? 'selected' : '' ?>@endif>151 cm</option>
        <option text-value="152 cm" class="infoSelector" value="152" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 152) ? 'selected' : '' ?>@endif>152 cm</option>
        <option text-value="153 cm" class="infoSelector" value="153"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 153) ? 'selected' : '' ?>@endif>153 cm</option>
        <option text-value="154 cm" class="infoSelector" value="154" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 154) ? 'selected' : '' ?>@endif>154 cm</option>
        <option text-value="155 cm" class="infoSelector" value="155" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 155) ? 'selected' : '' ?>@endif>155 cm</option>
        <option text-value="156 cm" class="infoSelector" value="156"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 156) ? 'selected' : '' ?>@endif>156 cm</option>
        <option text-value="157 cm" class="infoSelector" value="157" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 157) ? 'selected' : '' ?>@endif>157 cm</option>
        <option text-value="158 cm" class="infoSelector" value="158" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 158) ? 'selected' : '' ?>@endif>158 cm</option>
        <option text-value="159 cm" class="infoSelector" value="159"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 159) ? 'selected' : '' ?>@endif>159 cm</option>
        <option text-value="160 cm" class="infoSelector" value="160" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 160) ? 'selected' : '' ?>@endif>160 cm</option>
        <option text-value="161 cm" class="infoSelector" value="161" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 161) ? 'selected' : '' ?>@endif>161 cm</option>
        <option text-value="162 cm" class="infoSelector" value="162"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 162) ? 'selected' : '' ?>@endif>162 cm</option>
        <option text-value="163 cm" class="infoSelector" value="163"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 163) ? 'selected' : '' ?>@endif>163 cm</option>
        <option text-value="164 cm" class="infoSelector" value="164"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 164) ? 'selected' : '' ?>@endif>164 cm</option>
        <option text-value="165 cm" class="infoSelector" value="165" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 165) ? 'selected' : '' ?>@endif>165 cm</option>
        <option text-value="166 cm" class="infoSelector" value="166" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 166) ? 'selected' : '' ?>@endif>166 cm</option>
        <option text-value="167 cm" class="infoSelector" value="167"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 167) ? 'selected' : '' ?>@endif>167 cm</option>
        <option text-value="168 cm" class="infoSelector" value="168"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 168) ? 'selected' : '' ?>@endif>168 cm</option>

        <option text-value="169 cm" class="infoSelector" value="169" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 169) ? 'selected' : '' ?>@endif>169 cm</option>
        <option text-value="170 cm" class="infoSelector" value="170" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 170) ? 'selected' : '' ?>@endif>170 cm</option>
        <option text-value="171 cm" class="infoSelector" value="171"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 171) ? 'selected' : '' ?>@endif>171 cm</option>
        <option text-value="172 cm" class="infoSelector" value="172" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 172) ? 'selected' : '' ?>@endif>172 cm</option>
        <option text-value="173 cm" class="infoSelector" value="173"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 173) ? 'selected' : '' ?>@endif>173 cm</option>
        <option text-value="174 cm" class="infoSelector" value="174" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 174) ? 'selected' : '' ?>@endif>174 cm</option>
        <option text-value="175 cm" class="infoSelector" value="175"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 175) ? 'selected' : '' ?>@endif>175 cm</option>
        <option text-value="176 cm" class="infoSelector" value="176"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 176) ? 'selected' : '' ?>@endif>176 cm</option>
        <option text-value="177 cm" class="infoSelector" value="177"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 177) ? 'selected' : '' ?>@endif>177 cm</option>
        <option text-value="178 cm" class="infoSelector" value="178"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 178) ? 'selected' : '' ?>@endif>178 cm</option>
        <option text-value="179 cm" class="infoSelector" value="179" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 179) ? 'selected' : '' ?>@endif>179 cm</option>
        <option text-value="180 cm" class="infoSelector" value="180"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 180) ? 'selected' : '' ?>@endif>180 cm</option>
        <option text-value="181 cm" class="infoSelector" value="181" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 181) ? 'selected' : '' ?>@endif>181 cm</option>
        <option text-value="182 cm" class="infoSelector" value="182"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 182) ? 'selected' : '' ?>@endif>182 cm</option>
        <option text-value="183 cm" class="infoSelector" value="183" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 183) ? 'selected' : '' ?>@endif>183 cm</option>
        <option text-value="184 cm" class="infoSelector" value="184"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 184) ? 'selected' : '' ?>@endif>184 cm</option>
        <option text-value="185 cm" class="infoSelector" value="185" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 185) ? 'selected' : '' ?>@endif>185 cm</option>

        <option text-value="186 cm" class="infoSelector" value="186"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 186) ? 'selected' : '' ?>@endif>186 cm</option>

        <option text-value="187 cm" class="infoSelector" value="187"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 187) ? 'selected' : '' ?>@endif>187 cm</option>
        <option text-value="188 cm" class="infoSelector" value="188"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 188) ? 'selected' : '' ?>@endif>188 cm</option>
        <option text-value="189 cm" class="infoSelector" value="189"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 189) ? 'selected' : '' ?>@endif>189 cm</option>
        <option text-value="190 cm" class="infoSelector" value="190"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 190) ? 'selected' : '' ?>@endif>190 cm</option>
        <option text-value="191 cm" class="infoSelector" value="191"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 191) ? 'selected' : '' ?>@endif>191 cm</option>
        <option text-value="192 cm" class="infoSelector" value="192"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 192) ? 'selected' : '' ?>@endif>192 cm</option>
        <option text-value="193 cm" class="infoSelector" value="193"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 193) ? 'selected' : '' ?>@endif>193 cm</option>
        <option text-value="194 cm" class="infoSelector" value="194" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 194) ? 'selected' : '' ?>@endif>194 cm</option>
        <option text-value="195 cm" class="infoSelector" value="195"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 195) ? 'selected' : '' ?>@endif>195 cm</option>
        <option text-value="196 cm" class="infoSelector" value="196"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 196) ? 'selected' : '' ?>@endif>196 cm</option>
        <option text-value="197 cm" class="infoSelector" value="197"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 197) ? 'selected' : '' ?>@endif>197 cm</option>
        <option text-value="198 cm" class="infoSelector" value="198" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 198) ? 'selected' : '' ?>@endif>198 cm</option>
        <option text-value="199 cm" class="infoSelector" value="199"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 199) ? 'selected' : '' ?>@endif>199 cm</option>
        <option text-value="200 cm" class="infoSelector" value="200" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 200) ? 'selected' : '' ?>@endif>200 cm</option>
        <option text-value="201 cm" class="infoSelector" value="201" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 201) ? 'selected' : '' ?>@endif>201 cm</option>
        <option text-value="202 cm" class="infoSelector" value="202" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 202) ? 'selected' : '' ?>@endif>202 cm</option>
        <option text-value="203 cm" class="infoSelector" value="203" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 203) ? 'selected' : '' ?>@endif>203 cm</option>
        <option text-value="204 cm" class="infoSelector" value="204"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 204) ? 'selected' : '' ?>@endif>204 cm</option>
        <option text-value="205 cm" class="infoSelector" value="205" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 205) ? 'selected' : '' ?>@endif>205 cm</option>
        <option text-value="206 cm" class="infoSelector" value="206" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 206) ? 'selected' : '' ?>@endif>206 cm</option>
        <option text-value="207 cm" class="infoSelector" value="207" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 207) ? 'selected' : '' ?>@endif>207 cm</option>
        <option text-value="208 cm" class="infoSelector" value="208"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 208) ? 'selected' : '' ?>@endif>208 cm</option>
        <option text-value="209 cm" class="infoSelector" value="209"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 209) ? 'selected' : '' ?>@endif>209 cm</option>
        <option text-value="210 cm" class="infoSelector" value="210"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 210) ? 'selected' : '' ?>@endif>210 cm</option>
        <option text-value="211 cm" class="infoSelector" value="211" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 211) ? 'selected' : '' ?>@endif>211 cm</option>
        <option text-value="212 cm" class="infoSelector" value="212"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 212) ? 'selected' : '' ?>@endif>212 cm</option>
        <option text-value="213 cm" class="infoSelector" value="213" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 213) ? 'selected' : '' ?>@endif>213 cm</option>
        <option text-value="214 cm" class="infoSelector" value="214"  @if(isset($userData['UserProfile']->height))<?= ($userData['UserProfile']->height == 214) ? 'selected' : '' ?>@endif >214 cm</option>
        <option text-value="other" class="infoSelector" value="other" @if(isset($userData['UserProfile']->height)) <?= ($userData['UserProfile']->height == 'other') ? 'selected' : '' ?>@endif >other</option>
    </select>
</div>



<div class="form-group">
    <label for="email1">Ethnicity</label>       


    <select name="ethnicity" class="form-control" id="ethnicity">
        @forelse($userData['ethnicity'] as $key => $ethnicityval)
        <option value="<?= $ethnicityval['_id'] ?>"  @if(isset($userData['UserProfile']->ethnicity))  <?= ($ethnicityval['_id'] == $userData['UserProfile']->ethnicity) ? 'selected' : '' ?> @endif ><?= $ethnicityval['name'] ?></option>
        @empty
        @endforelse
    </select>
</div>


<div class="form-group">
    <label for="email1">Eye Color</label>
    @if(!isset($userData['EyeColor']))
    @else       
    <select name="eye_color" class="form-control" id="eye_color">
        @forelse($userData['EyeColor'] as $key => $ethnicityval)
        <option value="<?= $ethnicityval['_id'] ?>"  @if(isset($userData['UserProfile']->eye_color))  <?= ($ethnicityval['_id'] == $userData['UserProfile']->eye_color) ? 'selected' : '' ?> @endif ><?= $ethnicityval['name'] ?></option>
        @empty
        @endforelse
    </select>
    @endif
</div>


<div class="form-group">
    <label for="email1">Hair Color</label>  
    @if(!isset($userData['HairColor']))
    @else        
    <select name="hair_color" class="form-control" id="hair_color">
        @forelse($userData['HairColor'] as $key => $HairColor)
        <option value="<?= $HairColor['_id'] ?>"  @if(isset($userData['UserProfile']->hair_color))  <?= ($HairColor['_id'] == $userData['UserProfile']->hair_color) ? 'selected' : '' ?> @endif ><?= $HairColor['name'] ?></option>
        @empty
        @endforelse
    </select>
    @endif
</div>





<div class="form-group">
    <label for="email1">Education</label>       


    <select name="education" class="form-control" id="education">
        @forelse($userData['education'] as $key => $educationeval)
        <option value="<?= $educationeval['_id'] ?>" @if(isset($userData['UserProfile']->education))   <?= ($educationeval['_id'] == $userData['UserProfile']->education) ? 'selected' : '' ?> @endif ><?= $educationeval['name'] ?></option>
        @empty
        @endforelse
    </select>
</div>




<div class="form-group">
    <label for="email1">Relationship Status</label>       


    <select name="relationship_status" class="form-control" id="net_worth">
        @forelse($userData['relationshipStatus'] as $key => $relationshipStatusval)
        <option value="<?= $relationshipStatusval['_id'] ?>" @if(isset($userData['UserProfile']->relationship_status))   <?= ($relationshipStatusval['_id'] == $userData['UserProfile']->relationship_status) ? 'selected' : '' ?> @endif ><?= $relationshipStatusval['name'] ?></option>
        @empty
        @endforelse
    </select>
</div>



<div class="form-group">
    <label for="email1">Have Children?</label>       

    <select name="children" class="form-control" id="children">
     @if(isset($userData['UserProfile']->children))
     <option value="0" <?= ($userData['UserProfile']->children == 0) ? 'selected' : '' ?>>0</option>
     <option value="1" <?= ($userData['UserProfile']->children == 1) ? 'selected' : '' ?>>1</option>
     <option value="2" <?= ($userData['UserProfile']->children == 2) ? 'selected' : '' ?>>2</option>
     <option value="3" <?= ($userData['UserProfile']->children == 3) ? 'selected' : '' ?>>3</option>
     <option value="4" <?= ($userData['UserProfile']->children == 4) ? 'selected' : '' ?>>4</option>
     <option value="5" <?= ($userData['UserProfile']->children == 5) ? 'selected' : '' ?>>5</option>
     <option value="6" <?= ($userData['UserProfile']->children == 6) ? 'selected' : '' ?>>6+</option>
     @else

     <option value="0" >0</option>
     <option value="1">1</option>
     <option value="2">2</option>
     <option value="3">3</option>
     <option value="4" >4</option>
     <option value="5">5</option>
     <option value="6">6+</option>

     @endif
 </select>

</div>


<div class="form-group">
    <label for="email1">Smoke?</label>     

    <select name="smoke" class="form-control" id="smoke">

       <option value="">-</option>
       @if(isset($userData['UserProfile']->smoke))
       <option value="1" <?= ($userData['UserProfile']->smoke == 1) ? 'selected' : '' ?>>Non Smoker</option>
       <option value="2" <?= ($userData['UserProfile']->smoke == 2) ? 'selected' : '' ?>>Light Smoker</option>
       <option value="3" <?= ($userData['UserProfile']->smoke == 3) ? 'selected' : '' ?>>Heavy Smoker</option>
       @else

       <option value="1">Non Smoker</option>
       <option value="2">Light Smoker</option>
       <option value="3">Heavy Smoker</option>


       @endif



   </select>

</div>

<div class="form-group">
    <label for="email1">Drink?</label>     

    <select name="drink" class="form-control" id="smoke">
       <option value="">-</option>
       @if(isset($userData['UserProfile']->drink))
       <option value="1" <?= ($userData['UserProfile']->drink == 1) ? 'selected' : '' ?>>Non Drinker</option>
       <option value="2" <?= ($userData['UserProfile']->drink == 2) ? 'selected' : '' ?>>Social Drinker</option>
       <option value="3" <?= ($userData['UserProfile']->drink == 3) ? 'selected' : '' ?>>Heavy Drinker</option>
       @else
       <option value="1">Non Drinker</option>
       <option value="2">Social Drinker</option>
       <option value="3">Heavy Drinker</option>

       @endif
   </select>

</div>

</div>
<hr />
<div class="modal-footer border-top-0 d-flex justify-content-center">
    <button type="button" class="btn btn-danger userLookingForFormCloseBtn" data-dismiss="modal" aria-label="Close">
      Cancel
  </button>
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>


<!-- model close -->


<!-- About Us Model -->

<div class="modal fade" id="userAboutMePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">Edit About Me</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />
  <form class="userAboutMeForm" id="userAboutMeForm" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>">
    <input type="hidden" name="action" value="aboutUsForm">
    <div class="modal-body">

       <div class="form-group">

        <textarea class="form-control" name="about_me" rows="8">  @if(isset($userData['UserProfile']->about_me))<?= $userData['UserProfile']->about_me ?> @endif</textarea>
    </div>

</div>
<hr />
<div class="modal-footer border-top-0 d-flex justify-content-center">
    <button type="button" class="btn btn-danger userAboutMePopupCloseBtn" data-dismiss="modal" aria-label="Close">
      Cancel
  </button>
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>


<!-- model close -->
<!-- About Us Model -->

<div class="modal fade" id="userSmallProfileEditPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">Edit About Me</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />

  <form class="userSmallProfileEditForm" id="userSmallProfileEditForm" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>">

    <input type="hidden" name="action" value="firstStepUserEditForm">
    <div class="modal-body">
      <div class="form-group">
        <label for="email1">Display name</label>       

        <input type="text" name="username" value="{{ $userData['userName'] }}" class="form-control">

    </div>
    <div class="form-group">
        <label for="email1">Primary Location</label>       

        <input id="profileLocationTextField" type="text" class="form-control" name="city" value="@if(isset($userData['UserProfile']->city)){{ $userData['UserProfile']->city }} @endif" autocomplete="on">


    </div>
    <div class="form-group">
        <label for="email1">Heading</label>
        <input type="text" class="form-control" name="heading" value="@if(isset($userData['UserProfile']->heading)){{ $userData['UserProfile']->heading }} @endif" autocomplete="on">     
    </div>
</div>
<hr />
<div class="modal-footer border-top-0 d-flex justify-content-center">

    <button type="button" class="btn btn-danger userSmallProfileEditFormBtn" data-dismiss="modal" aria-label="Close">
      Cancel
  </button>
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>


<!-- model close -->



<!-- Looking For Model -->

<div class="modal fade" id="userLookingForPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">What are you Seeking?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />
  <form class="userLookingForForm" id="userLookingForForm" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>">
    <input type="hidden" name="action" value="lookingForForm">
    <div class="modal-body">

       <div class="form-group">


           @if($userData['userTag'])
           @forelse ($userData['userTag'] as $key => $tagList)
           @if(isset($userData['UserProfile']->user_tag))
           <?php               
           if( in_array( $tagList['_id'] ,unserialize($userData['UserProfile']->user_tag) ) )
           {
            $tag_selected =  "tag_selected";
            $tag_value = 1;
        }else{
            $tag_selected =  "";
            $tag_value = '';
        }
        ?>
        @endif
        @if(isset($tag_selected))
        <button class="tag user-profile-tag {{ $tag_selected }}" data-id="{{ $tagList['_id'] }}" value="{{ str_replace(' ', '-', $tagList['name']) }}">{{ $tagList['name'] }}<span class="user-tag-sign"> + </span></button>
        @endif
        @if(isset($tag_value))
        <input type="hidden" name="user_tag[]" value="{{ $tag_value }}" class="{{ str_replace(' ', '-', $tagList['name']) }}">
        @endif
        @empty

        @endforelse  
        @endif


    </div>   
    <div class="form-group">
       <label>Describe what you're seeking (Optional)</label>
       <textarea class="form-control" name="what_are_you_seeking" rows="8">@if(isset($userData['UserProfile']->what_are_you_seeking))<?= $userData['UserProfile']->what_are_you_seeking ?> @endif</textarea>
   </div>

</div>
<hr />
<div class="modal-footer border-top-0 d-flex justify-content-center">
    <button type="button" class="btn btn-danger userLookingForFormCloseBtn" data-dismiss="modal" aria-label="Close">
      Cancel
  </button>
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>


<!-- model close -->

<div id="overlay_vdo">
  <div id="popup_vdo">
    <div id="close_vdo">X</div>
    <video id="opn_vid" autoplay="" loop="" controls="" width="100%">
    </video>
</div>
</div>

<div id="overlay_img">
  <div id="popup_img">
    <div id="close_img">X</div>
    <img  id="opn_img" height="25%" width="50%">

</video>
</div>
</div>



@push('appScripts')
@if(getStoreSettings('allow_google_map'))

@endif

<style type="text/css">
  .wrapper-range {
    position: relative;
    width: 100%;
}
.container-range {
    position: relative;
    width: 50%;
    height: 50px;
}
#slider-1, #slider-2, #slider-height1, #slider-height2 {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100%;
    outline: none;
    position: absolute;
    margin: auto;
    top: 4px;
    bottom: 0;
    background-color: transparent;
    pointer-events: none;
    font-size: 10px;
}
.slider-track , .slider-track-height{
    width: 100%;
    height: 5px;
    position: absolute;
    margin: auto;
    top: 0;
    bottom: 0;
    border-radius: 5px;
}
input[type="range"]::-webkit-slider-runnable-track {
    -webkit-appearance: none;
    height: 5px;
}
input[type="range"]::-moz-range-track {
    -moz-appearance: none;
    height: 5px;
}
input[type="range"]::-ms-track {
    appearance: none;
    height: 5px;
}
input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 1.7em;
    width: 1.7em;
    border: 1px solid lightgray;
    background-color: #fff;
    cursor: pointer;
    margin-top: -9px;
    pointer-events: auto;
    border-radius: 50%;
}
input[type="range"]::-moz-range-thumb {
    -webkit-appearance: none;
    height: 1.7em;
    width: 1.7em;
    cursor: pointer;
    border-radius: 50%;
    background-color: #fff;
    pointer-events: auto;
    border: none;
}
input[type="range"]::-ms-thumb {
    appearance: none;
    height: 1.7em;
    width: 1.7em;
    cursor: pointer;
    border-radius: 50%;
    background-color: #fff;
    pointer-events: auto;
}
input[type="range"]:active::-webkit-slider-thumb {
    background-color: #ffffff;
    border: 1px solid #3264fe;
}
.wrapper-range .values {
    display: flex;
    flex-direction: row;
}
.container-range input {
    border: none;
    padding: 0;
}
.wrapper-range .values span ,.wrapper-range .values-height span {
    padding: 0 2px;
}
</style>
<style type="text/css">

    .toggle_tst.show {
        display: block !important;
    }

/*i#show_hide {
    position: absolute;
    bottom: 10px;
    right: 7px;
    color: #fff;
    cursor: pointer;
}*/
.outer-settint.show_hide {
    position: absolute;
    bottom: -17px;
    right: -5px;
    color: #fff;
    /* width: 14%; */
    padding: 20px 10px !important;
    cursor: pointer;
}


#toggle_tst a {
    padding: 10px 15px;
    line-height: 2em;
    width: 100%;
    text-decoration: none;
    display: block;

}

#trigger_img, .trigger_vdo {
    max-height: 250px;
    height: 100%;
    overflow: hidden;
}
div#toggle_tst {
   position: absolute;
   right: 0;
   top: 260px;
   margin: 0;
   background: #fff;
   z-index: 10;
   width: 75%;
   height: auto;
   box-shadow: 0 1px 15px rgb(0 0 0 / 30%);
}
.primay_image {
    position: absolute;
    bottom: 0px;
    background-color: #00000073;
    width: 100%;
    color: white;
    padding: 10px;
}
.outer-settint.show_hide {
    z-index: 1;
}
div#toggle_tst::after {
    content: " ";
    position: absolute;
    right: 13px;
    top: -11px;
    border-top: none;
    border-right: 8px solid transparent;
    border-left: 9px solid transparent;
    border-bottom: 11px solid white;
}

#toggle_tst a:first-child {
    border-bottom: 1px solid rgba(0,0,0,0.2);
}

#overlay_vdo {
  position: fixed;
  height: 100%;
  width: 100%;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0,0,0,0.8);
  display: none;
  z-index:10;
}

#popup_vdo {
    /* max-height: 350px; */
    /* height: 80%; */
    padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    max-width: 600px;
    width: 80%;
    /* margin: 20px auto; */
    /* margin-top: 13% !important; */
}

#close_vdo {
    position: absolute;
    top: -5px;
    right: -5px;
    cursor: pointer;
    color: #fff;
    background-color: #f51b1c;
    padding: 4px 10px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 700;
}
/**img **/

#overlay_img {
  position: fixed;
  height: 100%;
  width: 100%;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0,0,0,0.8);
  display: none;
  z-index:10;
}
#popup_img {
    padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    max-width: 450px;
    width: 100%;
    max-height: 450px;
    height: 100%;
}
#popup_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
#close_img {
    position: absolute;
    top: -5px;
    right: -5px;
    cursor: pointer;
    color: #fff;
    background-color: #f51b1c;
    padding: 4px 10px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 700;
}
@media only screen and (max-width: 1024px) {
    div#toggle_tst {
        width: 100%;
    }
    #toggle_tst a {
        font-size: 14px;
    }

}
@media only screen and (max-width:766px) {
    #popup_img {
        transform: translate(-50%, -56%);
        max-width: 285px;
    }
    #toggle_tst a {
        padding: 10px 10px;
        line-height: 1.4em;
        font-size: 12px;
    }

}

@media only screen and (max-width:767px) {
    /* #trigger_img, .trigger_vdo {
        max-height: 110px;
    } */
    .add-new-image {
        min-height: 110px;
    }
    div#toggle_tst {
        top: 112px;
    }
}

@media only screen and (max-width:480px) {
    #popup_img {
        max-width: 250px;
    }}

    @media only screen and (max-width:375px) {
        #popup_img {
            max-width: Calc(100vw - 60px);
        }}


    </style>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>

    <script type="text/javascript">
        $(document).ready(function() {
          //   $(document).on('click','.trigger_vdo',function(){
          //     var dataivideo =  $(this).attr('dataivideo');
          //     var dataivideo_type = $('#video_type').val();
          //     $("#opn_vid").html('<source src="'+dataivideo+'" type="video/mp4"></source>' );
          //     document.getElementById("opn_vid").load();
          //     document.getElementById("opn_vid").play();
          //     $('#overlay_vdo').fadeIn(300);  
          // });
          $('#close_vdo').click(function() {
            $("#opn_vid").html('');
            $('#overlay_vdo').fadeOut(300);
            var x = document.getElementById("opn_vid"); 
            x.pause(); 

        });


          //   $(document).on('click','.trigger_img',function(){
          //     var dataimg =  $(this).attr('dataimg');
          //     $("#opn_img").attr('src', dataimg);
          //     $('#overlay_img').fadeIn(300);  
          // });
          $('#close_img').click(function() {
            $('#overlay_img').fadeOut(300);
        });
      });

  </script>
  <script>

     $(document).ready(function() {
       $(document).on('click','.show_hide',function(){

           if($(this).next().next().hasClass("show")){

               $(this).next().next().removeClass('show');
           }else{
            $('.upload-img #toggle_tst').removeClass('show');
            $(this).next().next().addClass('show');
        }
    });
   });
</script>

<script type="text/javascript">

  function initialize() {
   var input = document.getElementById('profileLocationTextField');
   var autocomplete = new google.maps.places.Autocomplete(input);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
  $(".upload-msg-private").hide();
  document.getElementById('userPublicUploadFileButton').addEventListener('click', openDialogPublic);

  function openDialogPublic() {

    document.getElementById("phottoFromInput").value = "1";
    document.getElementById('userUploadPublicPhottoButton').click();

}

document.getElementById('userPrivateUploadFileButton').addEventListener('click', openDialogPrivate);

function openDialogPrivate() {
   document.getElementById("phottoFromInput").value = "2";
   document.getElementById('userUploadPrivatePhottoButton').click();
}

$("#userPrivateUploadFileButton").on('click', function(e) {
    e.preventDefault();
        //form reset after success
        $(".upload-msg-private").show();
    });

$("#userPublicUploadFileButton").on('click', function(e) {
    e.preventDefault();
        //form reset after success
        $(".upload-msg-private").hide();
    });
    // Get user profile data
    function getUserProfileData(response) {
        // If successfully stored data
        if (response.reaction == 1) {
            __DataRequest.get("<?= route('user.get_profile_data', ['username' => getUserAuthInfo('profile.username')]) ?>", {}, function(responseData) {
                var requestData = responseData.data;
                var specificationUpdateData = [];
                _.forEach(requestData.userSpecificationData, function(specification) {
                    _.forEach(specification['items'], function(item) {
                        specificationUpdateData[item.name] = item.value;
                    });
                });
                __DataRequest.updateModels('userData', requestData.userData);
                __DataRequest.updateModels('profileData', requestData.userProfileData);
                __DataRequest.updateModels('specificationData', specificationUpdateData);
            });
        }
    }

    /**************** User Like Dislike Fetch and Callback Block Start ******************/

    //on like Callback function
    function onLikeCallback(response) {
        var requestData = response.data;
        //check reaction code is 1 and status created or updated and like status is 1
        if (response.reaction == 1 && requestData.likeStatus == 1 && (requestData.status == "created" || requestData.status == 'updated')) {
            __DataRequest.updateModels({
                'userLikeStatus'    : '<?= __tr('Liked') ?>', //user liked status
                'userDislikeStatus' : '<?= __tr('Dislike') ?>', //user dislike status
            });
            //add class
            $(".lw-animated-like-heart").toggleClass("lw-is-active");
            //check if updated then remove class in dislike heart
            if (requestData.status == 'updated') {
                $(".lw-animated-broken-heart").toggleClass("lw-is-active");
            }
        }
        //check reaction code is 1 and status created or updated and like status is 2
        if (response.reaction == 1 && requestData.likeStatus == 2 && (requestData.status == "created" || requestData.status == 'updated')) {
            __DataRequest.updateModels({
                'userLikeStatus'    : '<?= __tr('Like') ?>', //user like status
                'userDislikeStatus' : '<?= __tr('Disliked') ?>', //user disliked status
            });
            //add class
            $(".lw-animated-broken-heart").toggleClass("lw-is-active");
            //check if updated then remove class in like heart
            if (requestData.status == 'updated') {
                $(".lw-animated-like-heart").toggleClass("lw-is-active");
            }
        }
        //check reaction code is 1 and status deleted and like status is 1
        if (response.reaction == 1 && requestData.likeStatus == 1 && requestData.status == "deleted") {
            __DataRequest.updateModels({
                'userLikeStatus'    : '<?= __tr('Like') ?>', //user like status
            });
            $(".lw-animated-like-heart").toggleClass("lw-is-active");
        }
        //check reaction code is 1 and status deleted and like status is 2
        if (response.reaction == 1 && requestData.likeStatus == 2 && requestData.status == "deleted") {
            __DataRequest.updateModels({
                'userDislikeStatus'     : '<?= __tr('Dislike') ?>', //user like status
            });
            $(".lw-animated-broken-heart").toggleClass("lw-is-active");
        }
        //remove disabled anchor tag class
        _.delay(function() {
            $('.lw-like-dislike-box').removeClass("lw-disable-anchor-tag");
        }, 1000);
    }
    /**************** User Like Dislike Fetch and Callback Block End ******************/


    //send gift callback
    function sendGiftCallback(response) {
        //check success reaction is 1
        if (response.reaction == 1) {
            var requestData = response.data;
            //form reset after success
            $("#lwSendGiftForm").trigger("reset");
            //remove active class after success on select gift radio option
            $("#lwSendGiftRadioBtn_"+requestData.giftUid).removeClass('active');
            //close dialog after success
            $('#lwSendGiftDialog').modal('hide');
            //reload view after 2 seconds on success reaction
            _.delay(function() {
                __Utils.viewReload();
            }, 1000)
        //if error type is insufficient balance then show error message
    } else if (response.data['errorType'] == 'insufficient_balance') {
            //show error div
            $("#lwGiftModalErrorText").show();
        } else {
            //hide error div
            $("#lwGiftModalErrorText").hide();
        }
    }

    //close Send Gift Dialog
    $("#lwCloseSendGiftDialog").on('click', function(e) {
        e.preventDefault();
        //form reset after success
        $("#lwSendGiftForm").trigger("reset");
        //close dialog after success
        $('#lwSendGiftDialog').modal('hide');
    });

    //user report callback
    function userReportCallback(response) {
        //check success reaction is 1
        if (response.reaction == 1) {
            var requestData = response.data;
            //form reset after success
            $("#lwReportUserForm").trigger("reset");
            //close dialog after success
            $('#lwReportUserDialog').modal('hide');
            //reload view after 2 seconds on success reaction
            _.delay(function() {
                __Utils.viewReload();
            }, 1000)
        }
    }

    //close User Report Dialog
    $("#lwCloseUserReportDialog").on('click', function(e) {
        e.preventDefault();
        //form reset after success
        $("#lwReportUserForm").trigger("reset");
        //close dialog after success
        $('#lwReportUserDialog').modal('hide');
    });

    //block user confirmation
    $("#lwBlockUserBtn").on('click', function(e) {
        var confirmText = $('#lwBlockUserConfirmationText');
        //show confirmation 
        showConfirmation(confirmText, function() {
            var requestUrl = '<?= route('user.write.block_user') ?>',
            formData = {
               'block_user_id' : '<?= $userData['userUId'] ?>',
           };                 
            // post ajax request
            __DataRequest.post(requestUrl, formData, function(response) {
                if (response.reaction == 1) {
                    __Utils.viewReload();
                }
            });
        });
    });

    // Click on edit / close button 
    $('#lwEditBasicInformation, #lwCloseBasicInfoEditBlock').click(function(e) {
        e.preventDefault();
        showHideBasicInfoContainer();
    });
    // Show / Hide basic information container
    function showHideBasicInfoContainer() {
        // $('#lwUserBasicInformationForm').toggle();
        // $('#lwStaticBasicInformation').toggle();
        // $('#lwCloseBasicInfoEditBlock').toggle();
        // $('#lwEditBasicInformation').toggle();
    }
    // Show hide specification user settings
    function showHideSpecificationUser(formId, event) {
        event.preventDefault();
        $('#lwEdit'+formId).toggle();
        $('#lw'+formId+'StaticContainer').toggle();
        $('#lwUser'+formId+'Form').toggle();
        $('#lwClose'+formId+'Block').toggle();
    }
    // Click on profile and cover container edit / close button 
    $('#lwEditProfileAndCoverPhoto, #lwCloseProfileAndCoverBlock').click(function(e) {
        e.preventDefault();
        showHideProfileAndCoverPhotoContainer();
    });
    // Hide / show profile and cover photo container
    function showHideProfileAndCoverPhotoContainer() {
        $('#lwProfileAndCoverStaticBlock').toggle();
        $('#lwProfileAndCoverEditBlock').toggle();
        $('#lwEditProfileAndCoverPhoto').toggle();
        $('#lwCloseProfileAndCoverBlock').toggle();
    }
     // After successfully upload profile picture
     function afterUploadedProfilePicture(responseData) {
        $('#lwProfilePictureStaticImage, .lw-profile-thumbnail').attr('src', responseData.data.image_url);
    }
    // After successfully upload Cover photo
    function afterUploadedCoverPhoto(responseData) {
        $('#lwCoverPhotoStaticImage').attr('src', responseData.data.image_url);
    }
</script>
<script type="text/javascript">
 window.onload = function () {
    slideOne();
    slideTwo();
    slideOneHeight1();
    slideTwoheight2();
};

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;

let sliderOneheight = document.getElementById("slider-height1");
let sliderTwoheight = document.getElementById("slider-height2");
let displayValOneheight = document.getElementById("height1");
let displayValTwoheight = document.getElementById("height2");
let sliderTrackheight = document.querySelector(".slider-track-height");

function slideOne() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
      sliderOne.value = parseInt(sliderTwo.value) - minGap;
  }
  displayValOne.textContent = sliderOne.value;
  fillColor();
}
function slideTwo() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
      sliderTwo.value = parseInt(sliderOne.value) + minGap;
  }
  displayValTwo.textContent = sliderTwo.value + "+";
  fillColor();
}

function slideOneHeight1() {
    if (parseInt(sliderTwoheight.value) - parseInt(sliderOneheight.value) <= minGap) {
      sliderOneheight.value = parseInt(sliderTwoheight.value) - minGap;
  }
  displayValOneheight.textContent = sliderOneheight.value + "cm";;
  fillColorhight();
}
function slideTwoheight2() {
    if (parseInt(sliderTwoheight.value) - parseInt(sliderOneheight.value) <= minGap) {
      sliderTwoheight.value = parseInt(sliderOneheight.value) + minGap;
  }
  displayValTwoheight.textContent = sliderTwoheight.value + "cm";
  fillColorhight();
}
function fillColorhight() {
    min_val = sliderOneheight.value - 137;
    maxVal = sliderMaxValueheight - 137;
    max2_val = sliderTwoheight.value - 137;
    percent1 = (min_val / maxVal) * 100;
    percent2 = (max2_val / maxVal) * 100;
  // incVal = percent1 + 25;
  // decVal = percent1 - 45;
  // decVal2 = percent2 - 10;
  // sliderTrackheight.style.background = `linear-gradient(to right, rgb(208 59 80) 30%, rgb(207 42 65) 30%, rgb(213 80 22) 100%, rgb(208 59 80) 100%)`;
  sliderTrackheight.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #cf0404 ${percent1}% , #cf0404 ${percent2}%, #dadae5 ${percent2}%)`;
}
function fillColor() {
  min_val = sliderOne.value - 18;
  maxVal = sliderMaxValue - 18;
  max2_val = sliderTwo.value - 18;
  percent1 = (min_val / maxVal) * 100;
  percent2 = (max2_val / maxVal) * 100;
  sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #cf0404 ${percent1}% , #cf0404 ${percent2}%, #dadae5 ${percent2}%)`;
}



</script>

<script>


    function setLocationCoordinates(key, lat, lng, placeData) {
        __DataRequest.post("<?= route('user.write.location_data') ?>", {
            'latitude': lat,
            'longitude': lng,
            'placeData': placeData.address_components
        }, function(responseData) {
            showHideLocationContainer();
            var requestData = responseData.data;
            __DataRequest.updateModels('profileData', {
                city: requestData.city,
                country_name: requestData.country_name,
                latitude: lat,
                longitude: lng
            });
            var mapSrc = "https://maps.google.com/maps/place?q="+lat+","+lng+"&output=embed";
            $('#gmap_canvas').attr('src', mapSrc)
        });
    };

// $(".lw-animated-heart").on("click", function() {
//     $(this).toggleClass("lw-is-active");
// });







$("body").on("submit", ".basicInfoSectionForm", function(e) {

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type:'POST',
      url:"{{ url('user/settings/process-basic-settings') }}",
      dataType : 'json',
      data :  $('#basicInfoSectionForm').serialize(),
      success:function(response){
         showSuccessMessage("Your basic information updated successfully");
         $('.userLookingForFormCloseBtn').click();
       // console.log(response.data.userData);
       $('#lwStaticBasicInformation').html(response.data.userData);

         // lwStaticBasicInformation


     }

 });

    return false;
});




$("body").on("submit", ".userSmallProfileEditForm", function(e) {

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type:'POST',
      url:"{{ url('user/settings/process-basic-settings') }}",
      dataType : 'json',
      data :  $('#userSmallProfileEditForm').serialize(),
      success:function(response){

        if(response.data.status == false){
          showErrorMessage(response.data.message);
      }else{
        showSuccessMessage("Your information updated successfully");
        $('.userSmallProfileEditFormBtn').click();
        $('.ProfileInfoCard').html(response.data.first_section_data);
        $('.mobile-short-details').html(response.data.mobileViewUserHTML);
    }
}

});

    return false;
});


$("body").on("submit", ".interestSectionForm", function(e) {

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type:'POST',
      url:"{{ url('user/settings/process-basic-settings') }}",
      dataType : 'json',
      data :  $('#interestSectionForm').serialize(),
      success:function(response){

        if(response.data.status == false){
          showErrorMessage(response.data.message);
      }else{
        showSuccessMessage("Your information updated successfully");
        $('.interestSectionFormCloseBtn').click();
        $('.insterest-section-html-section').html(response.data.insterest_section_html_section);
    }
}

});

    return false;
});

$("body").on("submit", ".userAboutMeForm", function(e) {

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type:'POST',
      url:"{{ url('user/settings/process-basic-settings') }}",
      dataType : 'json',
      data :  $('#userAboutMeForm').serialize(),
      success:function(response){
         showSuccessMessage("Updated Successfully");
         $('.userAboutMePopupCloseBtn').click();
         $('.about-me-section').html(response.data.about_me_data);



     }

 });

    return false;
});


$("body").on("submit", ".userPhottoForm", function(e) {
 $("#uploaded-image-video-section").html('');

 e.preventDefault();
 $.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 $.ajax({
  type:'POST',
  url:"{{ url('user/settings/upload-photos') }}",
  dataType : 'json',
  data: new FormData(this),
  processData: false,
  contentType: false,
  success:function(response){


    showSuccessMessage("Updated Successfully");
// if(response.data.message){

// }else{
    // console.log(response.data.stored_photo.image_url);
    $('.loaded_images').html(response.data.stored_photo.image_url);
    $('.userPhottoCancelBtn').click();

// }
}

});

 return false;
});



$("body").on("submit", ".userLookingForForm", function(e) {

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type:'POST',
      url:"{{ url('user/settings/process-basic-settings') }}",
      dataType : 'json',
      data :  $('#userLookingForForm').serialize(),
      success:function(response){
         showSuccessMessage("Updated Successfully");
         $('.userLookingForFormCloseBtn').click();
         $('.looking_for_section').html(response.data.looking_for);

     }

 });

    return false;
});

/****delete ***********/

  // $(".delete_photo").click(function (e) {
    $("body").on("click", ".delete_photo", function(e) {

        e.preventDefault();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

        var image_id =  $(this).attr('data-photto-id');
        
        $(this).closest('.loaded_images').find('.'+image_id).remove();
        
        $.ajax({
          type:'POST',
          url:"{{ url('user/settings/profile-photos-delete') }}",
          dataType : 'json',
          data: {image_id:image_id},
          success:function(response){
             showSuccessMessage("Delete Photos successfully");
             $('.loaded_images').html(response.data.stored_photo.image_url);
             $('.userPhottoCancelBtn').click();

// }
}

});
        
    });

    /*** move private ****/

    
    $("body").on("click", ".move_photo", function(e) {

       e.preventDefault();

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

       var image_id =  $(this).attr('data-photto-id');

     // $(this).closest('.loaded_images').find('.'+image_id).remove();
     $.ajax({
      type:'POST',
      url:"{{ url('user/settings/profile-photos-move') }}",
      dataType : 'json',
      data: {image_id:image_id},
      success:function(response){
         showSuccessMessage("Move to Private Photos successfully");
         $('.loaded_images').html(response.data.stored_photo.image_url);
         $('.userPhottoCancelBtn').click();
         location.reload();


// }
}

});
     
 });

    /*** move public ****/

    
    $("body").on("click", ".move_photo_public", function(e) {

       e.preventDefault();

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

       var image_id =  $(this).attr('data-photto-id');

     // $(this).closest('.loaded_images').find('.'+image_id).remove();
     $.ajax({
      type:'POST',
      url:"{{ url('user/settings/profile-photos-move-public') }}",
      dataType : 'json',
      data: {image_id:image_id},
      success:function(response){
         showSuccessMessage("Move to Public Photos successfully");
         $('.loaded_images').html(response.data.stored_photo.image_url);
         $('.userPhottoCancelBtn').click();
         location.reload();

// }
}

});
     
 });

    /** profile set ***/
    

    
    $("body").on("click", ".set_profile_pic", function(e) {
       e.preventDefault();

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

       var image_id =  $(this).attr('data-photto-id');
       var image_name =  $(this).attr('data-photto-name');
       var image_uid =  $(this).attr('data-photto-uid');
      // $(this).closest('.loaded_images').find('.'+image_id).remove();
      $.ajax({
          type:'POST',
          url:"{{ url('user/settings/profile-photos-set') }}",
          dataType : 'json',
          data: {image_id:image_id,image_name:image_name,image_uid:image_uid},
          success:function(response){
             showSuccessMessage("Profile Photo Update successfully");
             $('.loaded_images').html(response.data.stored_photo.image_url);
             $('.userPhottoCancelBtn').click();
             location.reload();

// }
}

});
      
  });

    $("body").on("click", ".close", function(e) {
        $(".imageOrvideo-result").html('');
        $(".upload-input-file").show();
        

    });
    $("body").on("click", ".userPhottoCancelBtn", function(e) {
        $(".imageOrvideo-result").html('');
        $(".upload-input-file").show();


    });
    


    $(document).ready(function() {

        $(".user-profile-tag").click(function(e){
            e.preventDefault();

            var selectedTag = $(this).attr('value');
            var selectedID =  $(this).attr('data-id');

            if ($(this).hasClass("tag_selected")) {
                $(this).find('.user-tag-sign').html(' + ');
                $('.'+selectedTag).val('');
                $(this).removeClass("tag_selected");
            }else{
             $(this).addClass("tag_selected");
             $('.'+selectedTag).val(selectedID);  
             $(this).find('.user-tag-sign').html(' - ');
         }

     });
    });


// Public Video Thumbnails Create 

document.getElementById('userUploadPublicPhottoButton').addEventListener('change', function(event) {

  const fileCheck = this.files[0];
  const  fileType = fileCheck['type'];
  const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/apng', 'image/avif', 'image/svg+xml'];
// console.log(fileType);
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
      //console.log(image);
      document.getElementById('videoThumbnailField').value = image;
      var urlimage =  '<img src="'+image+'" height="60px" width="60px" alt="Red dot" />';
      $(".imageOrvideo-result").html(urlimage);
      $(".upload-input-file").hide();
      // console.log(urlimage);
          // document.getElementsByTagName('div')[0].appendChild(img);
          // URL.revokeObjectURL(url);
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

// Private Video
document.getElementById('userUploadPrivatePhottoButton').addEventListener('change', function(event) {

  const fileCheck = this.files[0];
  const  fileType = fileCheck['type'];
  const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/apng', 'image/avif', 'image/svg+xml'];

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
      //console.log(image);
      document.getElementById('videoThumbnailField').value = image;
      var urlimage =  '<img src="'+image+'" height="50px" width="50px" alt="Red dot" />';
      $(".imageOrvideo-result").html(urlimage);
      $(".upload-input-file").hide();
          // document.getElementById('uploaded-image-video-section')[0].appendChild(img);
          // URL.revokeObjectURL(url);
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
          $(".imageOrvideo-result").html(urlimage);
          $(".upload-input-file").hide();
      };
      fileReader.readAsDataURL(file);
      
  };

}
});

$(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
</script>


@endpush
@stop

