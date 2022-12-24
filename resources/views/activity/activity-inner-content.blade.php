@if($value->slug == 'user-story-upload')

<?php  

$getMediaFile = \App\Exp\Components\Story\Models\Story::where('id', $value->activity_log)->first();

$mediaType = "image";
?>
@if($getMediaFile)

@if($getMediaFile->type == 'video')
<?php 
$mediaType = "video";

?>
@endif



<?php 
if($value->profile_picture){

    $imgURL = url('/').'/media-storage/users/'.$value->_uid.'/'.$value->profile_picture;

}else{
    $imgURL = url('/').'/media-storage/no-image.png';
}

$storyTypeTitle = "Uploaded a story";
?>

<div class="add_new_photo_template">
    <div class="left_side_template">
        <img class="vister-profile-image" src="{{ $imgURL }}">
    </div>
    <div class="rigt_side_template">
        <div class="add_photo_header">
            <a class="pro-name" href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
            <!-- <bold>Event Posted : </bold> -->
            <div><strong>{{ $storyTypeTitle }}</strong></div>
            <div class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</div>

        </div>

        @if($mediaType == 'video')
        <a href="{{ url('/') }}/public/frontend/story/{{ $getMediaFile->file }}" class="glightbox4">

            <div class="uploaded_video_picture">
                <div id="trigger_vdo" class="span4 proj-div videoplay trigger_vdo" dataivideo="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}">

                    <img class="activity_uploaded_video_link" src="{{ url('/') }}/public/frontend/story/video-icon-1.png">

                    <!-- <i class="fa fa-play" aria-hidden="true"></i> -->

                </div>

            </div>


        </a>
        @else

        <a href="{{ url('/') }}/public/frontend/story/{{ $getMediaFile->file }}" class="glightbox4">
            <div class="uploaded_video_picture">
                <img class="vister-profile-image" src="{{ url('/') }}/public/frontend/story/{{ $getMediaFile->file }}">
            </div>
        </a>


        @endif


    </div>
</div>

@endif
@endif
<!-- New Event Post -->
@if($value->slug == 'event-added')

<?php $Blockuser = \App\Exp\Components\User\Models\UserBlock::where('to_users__id', $value->_id)->where('by_users__id', Auth::user()->_id)->first(); ?>
@if(empty($Blockuser)) 
<!-- End I visited Section -->
<div class="activity_visitor activity_section">
    <div class="img-about ">
        <div class="vister-image-icon">
            <a href="{{ url('/')}}/event-view/?id={{ $value->event_id }}"><img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $value->profile_picture }}">
                <i class="fa-solid fa-camera"></i> </a>
            </div>
            <div class="message-template">
                <a class="pro-name" href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
                <bold>Added an event : </bold>
                <div><strong>{{ $value->activity_log }}</strong></div>
                <div class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</div>
            </div>
        </div>      
    </div>
    @endif
    @endif

    <!-- New User Added -->
    @if($value->slug == 'new-user-added')
    <!-- End I visited Section -->
    <div class="activity_visitor activity_section">
        <div class="img-about ">
            <div class="vister-image-icon">
                <img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $value->profile_picture }}">
                <i class="fa-solid fa-camera"></i>
            </div>
            <div class="message-template">
                <a class="pro-name" href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
                <span><i class="fa fa-check-circle" aria-hidden="true" style="color:green"> </i></span>
                <!-- <bold>New Profile Added : </bold> -->
                <div><strong>{{ $value->activity_log }}</strong></div>
                <div class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</div>
            </div>
        </div>      
    </div>
    @endif


    <!-- Updated Headlines-->
    @if($value->slug == 'updated_headline')

    <?php $getUserPro = \App\Exp\Components\User\Models\UserProfile::where('users__id', $value->_id)->first();?>
    <!-- End I visited Section -->
    <div class="activity_visitor activity_section">
        <div class="img-about ">
            <div class="vister-image-icon">
                <img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $value->profile_picture }}">
                <i class="fa-solid fa-camera"></i>
            </div>
            <div class="message-template">
                <a class="pro-name" href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
                <span><i class="fa fa-check-circle" aria-hidden="true" style="color:green"> </i></span>
                <!-- <bold>New Profile Added : </bold> -->
                <div><strong>{{ $value->activity_log }}</strong></div>
                <div>{{ $getUserPro->heading }}</div>
                <div class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</div>
            </div>
        </div>      
    </div>
    @endif
    <!-- Upload New Media -->
    @if($value->slug == 'user-media-upload')

    <?php    
    $getMediaFile = DB::table('user_photos')->where('_id',$value->activity_log)->first(); 
    $mediaTypeTitle = "Added a new picture";
    $mediaType = "image";
    ?>
    @if($getMediaFile)

    @if($getMediaFile->extantion_type == 'mp4' || $getMediaFile->extantion_type == 'MOV' || $getMediaFile->extantion_type == 'wmv' || $getMediaFile->extantion_type == 'WMV' || $getMediaFile->extantion_type == '3gp' || $getMediaFile->extantion_type == '3GP' || $getMediaFile->extantion_type == 'avi' || $getMediaFile->extantion_type == 'AVI' || $getMediaFile->extantion_type == 'f4v' || $getMediaFile->extantion_type == 'f4v' || $getMediaFile->extantion_type == 'MP4' || $getMediaFile->extantion_type == 'mov' || $getMediaFile->extantion_type == 'webm' || $getMediaFile->extantion_type == 'mkv' || $getMediaFile->extantion_type == 'flv' || $getMediaFile->extantion_type == 'svi' || $getMediaFile->extantion_type == 'mpg'|| $getMediaFile->extantion_type == 'mpeg'|| $getMediaFile->extantion_type == 'amv')

    <?php 
    $mediaType = "video";
    $mediaTypeTitle = "Added a new video";
    ?>
    @endif
    @endif


    <?php 
    if($value->profile_picture){

        $imgURL = url('/').'/media-storage/users/'.$value->_uid.'/'.$value->profile_picture;

    }else{
        $imgURL = url('/').'/media-storage/no-image.png';
    }
    ?>

    <div class="add_new_photo_template">
        <div class="left_side_template">
            <img class="vister-profile-image" src="{{ $imgURL }}">
        </div>
        <div class="rigt_side_template">
            <div class="add_photo_header">
                <a class="pro-name" href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
                <!-- <bold>Event Posted : </bold> -->
                <div><strong>{{ $mediaTypeTitle }}</strong></div>
                <div class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</div>

            </div>

            @if($mediaType == 'video')
            <a href="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}" class="glightbox4">

                <div class="uploaded_video_picture">
                    <div id="trigger_vdo" class="span4 proj-div videoplay trigger_vdo" dataivideo="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}">

                        <img class="activity_uploaded_video_link" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->video_thumbnail }}">

                        <!-- <i class="fa fa-play" aria-hidden="true"></i> -->

                    </div>
                </div>
            </a>
            @else
            <a href="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}" class="glightbox4">

                <div class="uploaded_video_picture">
                    <img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}">
                </div>
            </a>
            @endif



        </div>
    </div>

    @endif


