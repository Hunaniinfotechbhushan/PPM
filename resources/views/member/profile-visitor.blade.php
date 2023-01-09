@extends('public-master')
@section('content')
<style type="text/css">
    .fa-solid.fa-star.bookmark_true {
        color: #c02d33;
    }

    .vister-profile-main .vister-profile {
        height: 310px;
        border-radius: 7px;
        background-image: none;

    }

    .vister-profile-main .vister-profile img {
        height: 100%;
        width: 100%;
        object-fit: cover;

    }

    .btn.btn-success.report {
        background-color: #e74a3b;
        border-color: #e74a3b;
    }

    .lw-page-content .dropdown-menu {

        left: -613% !important;

    }

    .image-box.add-new-img {
        background-color: #fff;
        border: 1px solid;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex-direction: column;
        width: 105%;
    }

    @media (max-width: 767px) {
        nav.row.navbar.menu-bar {
            margin-bottom: 0px !important;
        }

        .vister-profile-main .vister-profile {
            height: fit-content;
        }

        .message-like-list-footer_outer {
            display: block !important;
        }

        .member-page .bottom-bar-mobile {
            display: none;
        }

        .member-page .message-like-list-footer_outer {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            margin: 0;
            z-index: 9999;
        }

        .bottom-animate {
            position: relative;
            animation: animatebottom 0.4s;
        }

        @keyframes animatebottom {
            from {
                bottom: -300px;
                opacity: 0;
            }

            to {
                bottom: 0;
                opacity: 1;
            }
        }

        .mess-popup {
            z-index: 9999;
        }

        .mess-popup .message-box {
            position: fixed;
            bottom: 0;
            z-index: 9999;
            width: 100%;
        }

        .member-page .modal-backdrop.show {
            display: none;
        }

        .member-page .message-like-list-footer {
            margin: 0;
            display: flex;
            align-items: center;
        }

        .member-page .message-box-popup {
            display: none;
        }

    }

    .heart-like-button {
        border: 1px solid red;
        height: 33px;
        padding-top: 5px;
        border-radius: 5px;
        margin-left: 10px;
    }

    .list-like-button {
        border: 1px solid red;
        height: 33px;
        border-radius: 5px;
        margin-left: 10px;
        margin-right: 20px;
    }

    .lw-page-content .apto-dropdown-wrapper {
        text-align: center;
    }

    .lw-page-content .apto-dropdown-wrapper {
        width: 25px !important;
        border: none !important;
    }

    .lw-page-content>div:nth-child(4) {
        display: none;
    }

    .message-like-list-footer>div:first-child button {
        padding: 5px 60px;
        border: none;
        background-color: red;
        color: white;
        border-radius: 3px;
    }

    .message-like-list-footer_outer {
        display: none;
    }

    .message-like-list-footer {
        background-color: #fff;
        box-shadow: 0px 3px 12px #706e6e;
        padding: 13px 0px;
        margin-bottom: 35px;
    }

    .justify-content-start {
        justify-content: space-around !important;
    }

    .message-like-list-footer>div:last-child button {
        font-size: 22px;
        line-height: normal;
        border: none;
        background-color: transparent;
        color: #a5a5a5;
    }

    .message-like-list-footer>div:nth-child(2) i {
        color: #a5a5a5;
    }

    .message-like-list-footer>div {
        margin-right: 20px;
        margin-left: 5px;
    }


    span.css-8ycd9n {
        display: none;
    }

    @media(max-width:767px) {
        span.css-8ycd9n {
            display: flex;
            -moz-box-align: center;
            align-items: center;
            width: 33px;
            height: 33px;
            cursor: pointer;
            margin: 12px 0px 0px 12px;
            background-color: rgb(51, 51, 51);
            z-index: 999;
            border-radius: 50%;
            opacity: 0.75;
            padding: 4px;
        }

        .lw-page-content>div:nth-child(4) {
            display: block;
        }

        .card .mo-hide {
            display: none !important;
        }

        .list-like-button .dropdown-menu {
            top: -67%;
            left: 62%;
        }

        .desk-view-main {
            display: none;
        }

        .css-8ycd9n {
            position: fixed;
            width: 48px;
            height: 48px;
            display: block;
            z-index: 999;
            top: 0px;
        }

        .vister-profile {
            padding: 0 18px 0 10px;
        }

    }
</style>
<?php
$id = Auth::user()->_id;
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$user = App\Exp\Components\User\Models\User::where('_uid', end($uriSegments))->first();
$UserProfile = App\Exp\Components\User\Models\UserProfile::where('users__id', $user['_id'])->first();
$userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id', $user['_id'])->first();
$ActivityLog = \App\Exp\Components\User\Models\ActivityLog::where('user_id', $user['_id'])->first();

$UserLike = App\Exp\Components\User\Models\LikeDislikeModal::where('to_users__id', $user['_id'])->where('by_users__id', $id)->first();

$UserLikeBY = App\Exp\Components\User\Models\LikeDislikeModal::where('by_users__id', $id)->where('to_users__id', $user['_id'])->first();

$MemberView = App\Exp\Components\User\Models\MemberView::where('to_view_id', $user['_id'])->first();
// echo "<pre>";
// print_r($UserProfile_details);
// die;

?>
<div id="content-wrapper" class="d-flex flex-column lw-page-bg visitor_profile_page">
    <div id="content">
        <a href="{{ url('search') }}">
            <span class="css-8ycd9n" data-cy-button="go-back">
                <span class="css-11vnpvp"><svg height="24" viewBox="0 0 24 24" width="24" fill="#ffffff">
                        <g>
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
                        </g>
                    </svg>
                </span>
            </span>
        </a>

        <div class="lw-page-content">
            <div class="lw-ad-block-h90"></div>
            <div class="card mb-md-3 mb-md-0 profile_information_header ">
                <div class="card-header " bis_skin_checked="1">
                    <!-- <h4><i class="fa-solid fa-user" style="color:#F51B1C; border:none !important;"></i>My Profile</h4> -->
                    <div class="row" bis_skin_checked="1">
                        <div class="col-sm-12" bis_skin_checked="1">
                            <div class="ProfileInfoCard" bis_skin_checked="1">
                                <div class="ProfileInfoCard-content" style="width: 100%;" bis_skin_checked="1">
                                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;" bis_skin_checked="1">
                                        <h3 style="font-weight:bold;">{{ (isset($UserProfile_details['username'])) ? $UserProfile_details['username'] : '' }}</h3>

                                        <div class="d-flex red">
                                            <?php if (isset($LikeDislike)) {
                                                if ($LikeDislike['like'] == 1) {
                                                    $hasLike = "like_true";
                                                } else {
                                                    $hasLike = "";
                                                }
                                            } ?>

                                            <div class="heart-like-button">
                                                <a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $user['_id'], 'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn">
                                                    <i class="fa-solid fa-heart {{ (isset($hasLike)) ? $hasLike : '' }}"></i>
                                                </a>
                                            </div>
                                            <!--   <div id="lwBookmarkBtn" data-star="{{end($uriSegments)}}" >
                                                @if(isset($BookMarks))
                                                @if($BookMarks['status'] == 1)
                                                <i class="fa-solid fa-star bookmark_true"></i>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-star"></i>
                                            @endif
                                            
                                        </div> -->

                                            <div class="list-like-button">
                                                <div class="apto-dropdown-wrapper">
                                                    <button class="apto-trigger-dropdown">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" data-selected="messenger">
                                                        <!-- <button type="button" value="messenger" tabindex="0" class="dropdown-item">Hide Hot Sir</button> -->
                                                        <!-- Block User button -->
                                                        <a class="text-primary btn-link btn" title="<?= __tr('Block User') ?>" id="lwBlockUserBtn"><i class="fas fa-ban"></i>Block</a>
                                                        <!-- /Block User button -->
                                                        <a class="text-primary btn-link btn" title="<?= __tr('Report') ?>" data-toggle="modal" data-target="#lwReportUserDialog"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</a>
                                                        <!-- /report button -->
                                                        <!-- Block User button -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div bis_skin_checked="1">



                                        <!-- <p data-cy="heading-txt" class="ProfileInfoCard-bio">memebertester</p> -->
                                        <span class="ProfileInfoCard-heading" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{ (isset($userAge)) ? $userAge : '' }} •
                                            @if($User['gender_selection'] == 2) Female @else Male @endif
                                        </span>
                                        <p>{{ (isset($UserProfile_details['city'])) ? $UserProfile_details['city'] : '' }}</p>

                                        <span data-cy="heading-txt" class="ProfileInfoCard-bio">@if(isset($UserProfile_details['heading']))<?= substr_replace($UserProfile_details['heading'], "...", 50) ?> @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 bg-white py-sm-0 px-sm-3">
                <div class="upload-img vister-profile-main">
                    @if($conversation == 0)
                    <form class="message-box desk-view-main" id="messageBoxForm">
                        @csrf
                        <input type="hidden" class="visitorId" name="visitorId" value="{{ (isset($UserProfile_details['user_id'])) ? $UserProfile_details['user_id'] : '' }}">
                        <textarea name="msg" placeholder="Type a Message dfdsf" class="message"></textarea><br>
                        <button type="submit" class="message-send">Send Meassage</button>
                    </form>
                    @endif
                    <div class="row imgvid ">

                        <div class="col-sm-12">
                            <div class="profile d-md-none">
                                <div class="vister-profile">
                                    <?php if ($userProfileGet['profile_picture']) {
                                        $imgURL = url('/') . '/media-storage/users/' . end($uriSegments) . '/' . $userProfileGet['profile_picture'];
                                    } else {
                                        $imgURL = url('/') . '/imgs/default-image.png';
                                    }
                                    ?>

                                    <img class="upload-images" src="{{ (isset($imgURL)) ? $imgURL : '' }}">
                                    <div class="user-about-short">
                                        <!--  <a class="lw-icon-btn" href="" role="button" id="lwEditBasicInformation">
                            <i class="fa fa-pencil-alt"></i> 
                        </a> -->
                                        <h2 style="font-weight:bold;">{{ (isset($user['username'])) ? $user['username'] : '' }}</h2>
                                        <span>{{ (isset($userAge)) ? $userAge : '' }} • </span><span>
                                            @if($User['gender_selection'] == 2) Female @else Male @endif
                                        </span>
                                        <span>
                                            <p>{{ (isset($UserProfile_details['city'])) ? $UserProfile_details['city'] : '' }}</p>
                                        </span>
                                        <p>{{ (isset($userProfileGet['about_me'])) ? $userProfileGet['about_me'] : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row imgvid2">
                        @foreach ($UserImage as $key => $collections)
                            @if($collections->is_verified == 1)
                                @if($collections->type == 1)
                                    <?php $imageType = 'public'; ?>
                                    <?php
                                    if ($collections->file) {
                                        $imgURL = url('/') . '/media-storage/users/' . end($uriSegments) . '/' . $collections->file;
                                    } else {
                                        $imgURL =  url('/imgs/default-image.png');
                                    }

                                    if ($collections->video_thumbnail) {
                                        $videourl = url('/') . '/media-storage/users/' . end($uriSegments) . '/' . $collections->video_thumbnail;
                                    } else {
                                        $videourl =  url('/imgs/no_thumb_image.jpg');
                                    }
                                    ?>
                                    <div class="col-4 col-sm-4 col-lg-3 col-md-3 p-1">
                                        <div class="image-box">
                                            @if($collections->extantion_type == 'mp4' || $collections->extantion_type == 'MOV' || $collections->extantion_type == 'wmv' || $collections->extantion_type == 'WMV' || $collections->extantion_type == '3gp' || $collections->extantion_type == '3GP' || $collections->extantion_type == 'avi' || $collections->extantion_type == 'AVI' || $collections->extantion_type == 'f4v' || $collections->extantion_type == 'f4v' || $collections->extantion_type == 'MP4' || $collections->extantion_type == 'mov' || $collections->extantion_type == 'webm' || $collections->extantion_type == 'mkv' || $collections->extantion_type == 'flv' || $collections->extantion_type == 'svi' || $collections->extantion_type == 'mpg'|| $collections->extantion_type == 'mpeg'|| $collections->extantion_type == 'amv')
                                            <a href="{{ $imgURL }}" class="glightbox4">
                                                <img class="upload-images" src="{{ $videourl }}">
                                                <div class="videoplay">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                            @else
                                            <a href="{{ $imgURL }}" class="glightbox4">
                                                <img class="upload-images" src="{{ (isset($imgURL)) ? $imgURL : '' }}">
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @endforeach
                            @if(isset($ImageShowRequest['userPhotos']))
                                @foreach($ImageShowRequest['userPhotos'] as $image)
                                    <?php
                                        if ($image->file) {
                                            $imgURL = url('/') . '/media-storage/users/' . end($uriSegments) . '/' . $image->file;
                                        } else {
                                            $imgURL =  url('/imgs/default-image.png');
                                        }         
                                    ?>
                                    <div class="col-4 col-sm-4 col-lg-3 col-md-3 p-1">
                                        <div class="image-box">
                                        <a href="{{ $imgURL }}" class="glightbox4">
                                            <img class="upload-images" src="{{ (isset($imgURL)) ? $imgURL : '' }}">
                                        </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        
                        <div class="col-4 col-sm-4 col-lg-3 col-md-3">
                            <div class="image-box add-new-img" id="request-box" user_id="{{ Auth::user()->_id }}" profile_user_id="{{ $User->_id }}" request_sent="0">
                                <p>Private (1)</p>
                                <i class="fa-solid fa-lock"></i>
                                <p>Request to View</p>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-lg-3 col-md-3 p-1 "></div>
                        <div class="col-4 col-sm-4 col-lg-3 col-md-3 p-1 "></div>
                    </div>
                    <div>
                        @if($conversation == 1)

                        <a href="{{ url('messenger?uid=') }}{{ $user['_id'] }}"><button class="web-button">View Message</button></a>

                        @endif
                    </div>
                </div>

            </div>






            <!-- /User Profile and Cover photo -->

            <!-- User Basic Information -->
            <div class="card mb-3 d-md-none">

                <!-- Basic information Header -->

                <div class="card-header mo-hide">

                    <!-- Check if its own profile -->

                    <!-- /Check if its own profile -->

                    <div class="d-flex justify-content-around">
                        <h5><span class="info-activity-button">Information</span></h5>
                        <h5><span class="recent-activity-button">Recent Activity</span></h5>
                    </div>

                </div>

                <!-- /Basic information Header -->

                <!-- Basic Information content -->

                <div class="card-body">

                    <!-- Heading -->

                    <ul>

                        <!--<hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">-->

                        <!-- Heading -->
                        <div class="info-activity-section">
                            <li class="nav-item d-flex justify-content-between mb-3">

                                <span><i class="fa-solid fa-clock"></i>Joined</span><span> Feb 15, 2022</span>

                            </li>

                            <li class="nav-item d-flex justify-content-between mb-3">

                                <span><i class="fa-solid fa-clock"></i>Last Active</span><span> Sep 9, 2022</span>

                            </li>

                            <li class="nav-item d-flex justify-content-between mb-3">

                                <span><i class="fa-solid fa-location-dot"></i>Recent </span><span> {{(isset($User->recent_login)) ? $User->recent_login : ''}} </span>

                            </li>

                            <li class="nav-item d-flex justify-content-between mb-3">

                                <span><i class="fa-solid fa-certificate"></i>Verifications</span><span> </span>

                            </li>
                        </div>
                        <!-- head -->
                        <div class="recent-activity-section">
                            <!--     <li class="nav-item d-flex justify-content-between side-bar-head mb-3">

              <span><i class="fa-solid fa-badge-check"></i>Recent Activity</span><span> </span>

          </li> -->

                            <li class="nav-item d-flex text-left mb-3 mo-hide">

                                <i class="fa-solid fa-comment-dots mt-2"></i>

                                <span>Last Messaged <p class="recent-dis">No messages.<a href="{{ url('messenger') }}">New conversation!</a></p></span>



                            </li>

                            <li class="nav-item d-flex text-left mb-3 mo-hide">

                                <i class="fa-solid fa-eye mt-2"></i>

                                <span>You last viewed her <p class="recent-dis">{{(isset($active_status_time)) ? $active_status_time : ''}}</p></span>



                            </li>

                            <li class="nav-item d-flex text-left">


                                @php $hasLike = "";
                                if(isset($MemberView )){

                                if($MemberView){
                                $hasLike = "like_true";
                                }else{

                                $hasLike = "";

                                }

                                } @endphp
                                <i class="fa-solid fa-eye mt-2 {{ $hasLike }}"></i>
                                @if($hasLike)
                                <span>She last viewed you<p class="recent-dis"></p></span>
                                @else
                                <span>She last viewed you <p class="recent-dis">Not yet</p></span>
                                @endif
                            </li>

                            <li class="nav-item d-flex text-left mo-hide">


                                @php $hasLike = "";
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
                            </li>

                            <li class="nav-item d-flex text-left">


                                @php $hasLike = "";
                                if(isset($LikeDislike )){

                                if($LikeDislike['like'] == 1){
                                $hasLike = "like_true";
                                }else{

                                $hasLike = "";

                                }

                                } @endphp
                                <i class="fa-solid fa-heart mt-2 {{ $hasLike }}"></i>
                                @if($hasLike)
                                <span>She favorited you <p class="recent-dis"></p></span>
                                @else
                                <span>She favorited you Not yet<p class="recent-dis">Not yet</p></span>
                                @endif
                            </li>
                        </div>
                    </ul>

                </div>

            </div>







            <!-- User Basic Information -->

            <div class="card mb-3">

                <!-- Basic information Header -->

                <div class="card-header">

                    <!-- Check if its own profile -->

                    <!-- /Check if its own profile -->

                    <h5> Basic Info</h5>

                </div>

                <!-- /Basic information Header -->

                <div class="card-body">

                    <!-- Static basic information container -->

                    <div id="lwStaticBasicInformation">

                        <div class="form-group row">

                            <!-- First Name -->

                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="looking_for"><strong><?= __tr('Looking For') ?></strong></label>


                                <div class="lw-inline-edit-text" data-model="userData.interest_selection">


                                    @if($User->interest_selection == 1)
                                    Men
                                    @elseif($User->interest_selection == 2)
                                    Women
                                    @else
                                    Men, Women
                                    @endif
                                </div>

                            </div>

                            @if($User->gender_selection == 1)
                            <div class="col-4 col-sm-4">

                                <label for="net_Worth"><strong><?= __tr('Net Worth') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="userData.last_name">

                                    $@if(isset($UserProfile_details['user_net_worth'])){{ $UserProfile_details['user_net_worth'] ? $UserProfile_details['user_net_worth'] : '-' }} @endif
                                </div>


                            </div>



                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="annual_income"><strong><?= __tr('Annual Income') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.gender_text">


                                    $@if(isset($UserProfile_details['user_annual_income'])){{ $UserProfile_details['user_annual_income'] ? $UserProfile_details['user_annual_income'] : '-' }} @endif


                                </div>

                            </div>
                            @else

                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="relationship"><strong><?= __tr('Eye Color') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile_details['user_eye_color'])){{ $UserProfile_details['user_eye_color'] ? $UserProfile_details['user_eye_color'] : '-' }} @endif
                                </div>

                            </div>

                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="relationship"><strong><?= __tr('Hair Color') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile_details['user_hair_color'])){{ $UserProfile_details['user_hair_color'] ? $UserProfile_details['user_hair_color'] : '-' }} @endif
                                </div>

                            </div>


                            @endif

                        </div>


                        <div class="form-group row">

                            <!-- Gender -->


                            <div class="col-4 col-sm-4">

                                <label><strong><?= __tr('Ethnicity') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.formatted_preferred_language">
                                    @if(isset($UserProfile_details['user_ethnicity'])){{ $UserProfile_details['user_ethnicity'] ? $UserProfile_details['user_ethnicity'] : '-' }} @endif
                                </div>

                            </div>



                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">
                                <label><strong><?= __tr('Children') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.formatted_relationship_status">
                                    @if(isset($UserProfile_details['children'])){{ $UserProfile_details['children'] ? $UserProfile_details['children'] : '-' }} @endif
                                </div>

                            </div>


                            <div class="col-4 col-sm-4">
                                <label for="education"><strong><?= __tr('Education') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.formatted_work_status">
                                    @if(isset($UserProfile_details['user_education'])){{ $UserProfile_details['user_education'] ? $UserProfile_details['user_education'] : '-' }} @endif
                                </div>

                            </div>



                        </div>
                        <div class="form-group row">


                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="smokes"><strong><?= __tr('Smokes') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.formatted_education">
                                    @if(isset($UserProfile->smoke))
                                    @if($UserProfile->smoke == 1)
                                    Non Smoker
                                    @elseif($UserProfile->smoke == 2)
                                    Light Smoker
                                    @elseif($UserProfile->smoke == 3)
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
                                    @if(isset($UserProfile_details['user_body_type'])){{ $UserProfile_details['user_body_type'] ? $UserProfile_details['user_body_type'] : '-' }} @endif
                                </div>
                            </div>


                            <!-- <div class="col-4 col-sm-4 mb-3 mb-sm-0">

    <label for="occupation_industry"><strong></strong></label>
    <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
     -
 </div>

</div> -->

                            <div class="col-4 col-sm-4">

                                <label for="height"><strong><?= __tr('Height') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile_details['height'])){{ $UserProfile_details['height'] ? $UserProfile_details['height'] : '-' }} @endif<span>cm</span>
                                </div>


                            </div>






                            <!-- /Work Status -->


                            <!-- Education -->


                        </div>

                        <div class="form-group row">




                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="drinks"><strong><?= __tr('Drinks') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile->drink))
                                    @if($UserProfile->drink == 1)
                                    Non Drinker
                                    @elseif($UserProfile->drink == 2)
                                    Social Drinker
                                    @elseif($UserProfile->drink == 3)
                                    Heavy Drinker
                                    @else
                                    -
                                    @endif
                                    @endif
                                </div>

                            </div>



                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="relationship"><strong><?= __tr('Relationship') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile_details['user_relationship_status'])){{ $UserProfile_details['user_relationship_status'] ? $UserProfile_details['user_relationship_status'] : '-' }} @endif

                                </div>

                            </div>

                            @if($User->gender_selection == 1)
                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="relationship"><strong><?= __tr('Eye Color') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile_details['user_eye_color'])){{ $UserProfile_details['user_eye_color'] ? $UserProfile_details['user_eye_color'] : '-' }} @endif
                                </div>

                            </div>

                            <div class="col-4 col-sm-4 mb-3 mb-sm-0">

                                <label for="relationship"><strong><?= __tr('Hair Color') ?></strong></label>
                                <div class="lw-inline-edit-text" data-model="profileData.mobile_number">
                                    @if(isset($UserProfile_details['user_hair_color'])){{ $UserProfile_details['user_hair_color'] ? $UserProfile_details['user_hair_color'] : '-' }} @endif
                                </div>

                            </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

            <!-- /Static basic information container -->



            <!-- User Basic Information Form -->

            <form class="lw-ajax-form lw-form" lwSubmitOnChange method="post" data-show-message="true" action="user/settings/process-basic-settings" data-callback="getUserProfileData" style="display: none;" id="lwUserBasicInformationForm">

                <div class="form-group row">

                    <!-- First Name -->

                    <div class="col-6 col-sm-6 mb-3 mb-sm-0">

                        <label for="first_name">First Name</label>

                        <input type="text" value="loveria" class="form-control" name="first_name" placeholder="First Name">

                    </div>

                    <!-- /First Name -->

                    <!-- Last Name -->

                    <div class="col-6 col-sm-6">

                        <label for="last_name">Last Name</label>

                        <input type="text" value="Admin" class="form-control" name="last_name" placeholder="Last Name">

                    </div>

                    <!-- /Last Name -->

                </div>

                <div class="form-group row">

                    <!-- Gender -->

                    <div class="col-6 col-sm-6 mb-3 mb-sm-0">

                        <label for="select_gender">Gender</label>

                        <select name="gender" class="form-control" id="select_gender">

                            <option value="" selected disabled>Choose your gender</option>

                            <option value="1">Male</option>

                            <option value="2">Female</option>

                            <option value="3">Secret</option>

                        </select>

                    </div>



                    <!-- /Gender -->

                    <!-- Birthday -->

                    <div class="col-6 col-sm-6">

                        <label for="select_preferred_language">Preferred Language</label>

                        <select name="preferred_language" class="form-control" id="select_preferred_language">

                            <option value="" selected disabled>Choose your Preferred Language</option>

                            <option value="1">English</option>

                            <option value="2">Arabic</option>

                            <option value="3">Dutch</option>

                            <option value="4">French</option>

                            <option value="5">German</option>

                            <option value="6">Italian</option>

                            <option value="7">Portuguese</option>

                            <option value="8">Russian</option>

                            <option value="9">Spanish</option>

                            <option value="10">Turkish</option>

                            <option value="11">Urdu</option>

                            <option value="12">Hindi</option>

                            <option value="13">Marathi</option>

                            <option value="14">Chinese</option>

                            <option value="15">Japanese</option>

                            <option value="16">Bengali</option>

                            <option value="17">Persian</option>

                            <option value="18">Korean</option>

                            <option value="19">Tamil</option>

                            <option value="20">Hausa</option>

                            <option value="21">Indonesian</option>

                            <option value="22">Panjabi</option>

                        </select>

                    </div>

                    <!-- /Preferred Language -->

                </div>

                <div class="form-group row">

                    <!-- Relationship Status -->

                    <div class="col-6 col-sm-6 mb-3 mb-sm-0">

                        <label for="select_relationship_status">Relationship Status</label>

                        <select name="relationship_status" class="form-control" id="select_relationship_status">

                            <option value="" selected disabled>Choose your Relationship Status</option>

                            <option value="1">Single</option>

                            <option value="2">Married</option>

                            <option value="3">Divorced</option>

                            <option value="4">Widow</option>

                        </select>

                    </div>

                    <!-- /Relationship Status -->

                    <!-- Work status -->

                    <div class="col-6 col-sm-6">

                        <label for="select_work_status">Work Status</label>

                        <select name="work_status" class="form-control" id="select_work_status">

                            <option value="" selected disabled>Choose your work status</option>

                            <option value="1">Studying</option>

                            <option value="2">Working</option>

                            <option value="3">Looking for work</option>

                            <option value="4">Retired</option>

                            <option value="5">Self-Employed</option>

                            <option value="6">Other</option>

                        </select>

                    </div>

                    <!-- /Work status -->

                </div>

                <div class="form-group row">

                    <!-- Education -->

                    <div class="col-6 col-sm-6 mb-3 mb-sm-0">

                        <label for="select_education">Education</label>

                        <select name="education" class="form-control" id="select_education">

                            <option value="" selected disabled>Choose your education</option>

                            <option value="1">Secondary school</option>

                            <option value="2">ITI</option>

                            <option value="3">College</option>

                            <option value="4">University</option>

                            <option value="5">Advanced degree</option>

                            <option value="6">Other</option>

                        </select>

                    </div>

                    <!-- /Education -->

                    <!-- Birthday -->

                    <div class="col-6 col-sm-6">

                        <label for="birthday">Birthday</label>

                        <input type="text" name="birthday" value="" placeholder="YYYY-MM-DD" class="form-control" required dateISO="true">

                    </div>

                    <!-- /Birthday -->

                </div>



                <div class="form-group row">

                    <!-- Mobile Number -->

                    <div class="col-6 col-sm-6">

                        <label for="mobile_number">Mobile Number</label>

                        <input type="text" value="9999999999" name="mobile_number" placeholder="Mobile Number" class="form-control" required maxlength="15">

                    </div>

                    <!-- /Mobile Number -->

                </div <!-- About Me -->

                <div class="form-group">

                    <label for="about_me">About Me</label>

                    <textarea class="form-control" name="about_me" id="about_me" rows="3" placeholder="Say something about yourself."></textarea>

                </div>

                <!-- /About Me -->

            </form>

            <!-- /User Basic Information Form -->

        </div>

    </div>







    <!-- /User Basic Information -->

    <div class="card mb-3">

        <div class="card-header">

            <h5>About</h5>

        </div>

        <div class="card-body">

            <!-- info message -->

            <p>{{$UserProfile->about_me}}</p>

        </div>

    </div>



    <!-- /User Basic Information -->

    <div class="card mb-3">
        <div class="card-header">
            <h5>Looking For</h5>
        </div>
        <div class="card-body">
            <div class="tag-group">
                @if(isset($UserProfile->user_tag))
                @forelse (unserialize($UserProfile->user_tag) as $key => $selectedTag)
                <?php $tagData = \App\Exp\Components\User\Models\UserTag::find($selectedTag);  ?>
                @if($tagData)
                <button class="tag"><?php echo $tagData->name; ?><i class="fa-solid fa-plus"></i></button>
                @endif
                @empty
                <p class="mt-3">@if(isset($UserProfile->what_are_you_seeking)) <?= $UserProfile->what_are_you_seeking ?> @endif</p>
                @endforelse
                @endif
            </div>
            <p class="mt-3">{{(isset($UserProfile->what_are_you_seeking)) ? $UserProfile->what_are_you_seeking : ''}}</p>
        </div>
    </div>

    <div class="message-like-list-footer_outer">
        <div id="asd" class="message-box-popup">popup box</div>
        <div class="message-like-list-footer ">

            @if($conversation == 0)
            <div>
                <a href="{{ url('messenger?uid=') }}{{ $user['_id'] }}" class="text-primary btn-link btn" data-toggle="modal" data-target="#lwReportUserDialogMessage"><button>Message</button></a>



            </div>
            @else
            <div>
                <a href="{{ url('messenger?uid=') }}{{ $user['_id'] }}"><button>View Conversations</button></a>
            </div>
            @endif
            <div class="ml-auto">

                <?php if (isset($LikeDislike)) {
                    if ($LikeDislike['like'] == 1) {
                        $hasLike = "like_true";
                    } else {
                        $hasLike = "";
                    }
                } ?>

                <a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $user['_id'], 'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn">
                    <i class="fa-solid fa-heart {{ (isset($hasLike)) ? $hasLike : '' }} fa-2x"></i>
                </a>

            </div>
            <div class="list-like-button">
                <div class="apto-dropdown-wrapper">
                    <button class="apto-trigger-dropdown">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu" data-selected="messenger">
                        <!-- <button type="button" value="messenger" tabindex="0" class="dropdown-item">Hide Hot Sir</button> -->
                        <!-- Block User button -->
                        <a class="text-primary btn-link btn" title="<?= __tr('Block User') ?>" id="lwBlockUserBtn1"><i class="fas fa-ban"></i>Block</a>
                        <!-- /Block User button -->
                        <a class="text-primary btn-link btn" title="<?= __tr('Report') ?>" data-toggle="modal" data-target="#lwReportUserDialog"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</a>
                        <!-- /report button -->
                        <!-- Block User button -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>

</div>

<div class="modal fade mess-popup" id="lwReportUserDialogMessage" tabindex="-1" role="dialog" aria-labelledby="userReportModalLabel" aria-hidden="true">
    <form class="message-box" id="messageBoxFormmobile">
        <div class="modal-dialog modal-md m-0" role="document">

            <div class="modal-content bottom-animate">

                <!-- <div class="modal-header">

                <h5 class="modal-title" id="userReportModalLabel">Write Message</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div> -->



                <div class="modal-body pb-0">

                    <!-- reason input field -->

                    <div class="form-group">
                        <input type="hidden" name="_token" value="">
                        <input type="hidden" class="visitorId" name="visitorId" value="{{ (isset($UserProfile_details['user_id'])) ? $UserProfile_details['user_id'] : '' }}">
                        <textarea name="msg" placeholder="Type a Message" class="message mb-0"></textarea>

                    </div>

                    <!-- / reason input field -->

                </div>



                <!-- modal footer -->

                <div class="modal-footer border-0 justify-content-between">
                    <button type="submit" class="message-send">Send Message</button>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">×</span>

                    </button>

                </div>

    </form>



    <!-- modal footer -->

</div>

<!-- user report Modal-->

<div class="modal fade" id="lwReportUserDialog" tabindex="-1" role="dialog" aria-labelledby="userReportModalLabel" aria-hidden="true">
    <form class="userFormReport" id="userFormReport" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-md" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userReportModalLabel">Abuse Report to Admin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- reason input field -->
                    <div class="form-group">
                        <label for="lwUserReportReason">Reason</label>
                        <input type="hidden" value="{{$user___id}}" name="user_id">
                        <textarea class="form-control" rows="3" id="lwUserReportReason" name="report_reason" required></textarea>
                    </div>
                    <!-- / reason input field -->
                </div>
                <!-- modal footer -->
                <div class="modal-footer mt-3">
                    <button class="btn btn-light btn-sm" id="lwCloseUserReportDialog">Cancel</button>
                    <button type="submit" class="btn btn-success  report">Report</button>
                </div>
    </form>



    <!-- modal footer -->

</div>

</div>
<!-- mesaage popup -->





</div>


<!-- /user report Modal-->

<script>
    
    $(document).on("click", ".image-box.add-new-img", function(e) {
        var user_id = jQuery(this).attr('user_id'); 
        var profile_user_id = jQuery(this).attr('profile_user_id'); 
        var request_sent = jQuery(this).attr('request_sent'); 
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('image-approver') }}",
            dataType: 'json',
            data: {
                sender_id:user_id,
                reciver_id:profile_user_id,
                request_status:request_sent
            },
            success: function(response) {
                if (response.status == 'success') {
                    showSuccessMessage("Updated Successfully");
                }
            }
        });

        return false;
    });




    //like
    $(".lw-like-action-btn i").on('click', function() {
        console.log('sadhjsvbadhjv');
        if ($(this).hasClass("like_true")) {
            $(this).removeClass("like_true");
        } else {
            $(this).addClass("like_true");
        }

    });

    //report 

    $("body").on("submit", ".userFormReport", function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('report-user') }}",
            dataType: 'json',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == 'success') {
                    showSuccessMessage("Updated Successfully");

                    setInterval(function() {
                        location.reload();
                    }, 1000);
                }
            }
        });

        return false;
    });

    //book mark user
    $("#lwBookmarkBtn").on('click', function(e) {
        var confirmText = $('#lwBlockUserConfirmationTextBook');

        //show confirmation 
        showConfirmation(confirmText, function() {
            var requestUrl = '<?= route('bookmarks.write.book_mark') ?>',


                formData = {
                    'bookmark_user_id': <?= $user['_id'] ?>,
                };
            // post ajax request
            __DataRequest.post(requestUrl, formData, function(response) {

                $("#lwBookmarkBtn").html('');
                $("#lwBookmarkBtn").html('<i class="fa-solid fa-star bookmark_true"></i>');

                //alert('done');

            });
        });
    });

    ////





    //block user confirmation
    $("#lwBlockUserBtn").on('click', function(e) {
        // console.log('afsahjvdhjsvahd');
        // alert('jj');
        var confirmText = "Are you want to sure ";

        //show confirmation 
        showConfirmation(confirmText, function() {
            var requestUrl = '<?= route('user.write.block_user') ?>',
                formData = {
                    'block_user_id': <?= $user['_id'] ?>,
                };
            // post ajax request
            __DataRequest.post(requestUrl, formData, function(response) {
                if (response.reaction == 1) {
                    __Utils.viewReload();
                }
            });
        });
    });


    //block user confirmation
    $("#lwBlockUserBtn1").on('click', function(e) {
        // alert('jj');
        var confirmText = "Are you want to sure ";

        //show confirmation 
        showConfirmation(confirmText, function() {
            var requestUrl = '<?= route('user.write.block_user') ?>',
                formData = {
                    'block_user_id': <?= $user['_id'] ?>,
                };
            // post ajax request
            __DataRequest.post(requestUrl, formData, function(response) {
                if (response.reaction == 1) {
                    __Utils.viewReload();
                }
            });
        });
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

    //Send Message 
    var APP_URL = {!! json_encode(url('/')) !!}
    console.log('APP_URL',APP_URL);
   $("body").on("submit", "#messageBoxForm", function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    var visitorId = $('.visitorId').val();
    console.log('visitorId',visitorId);
    var routeURL = APP_URL+'/messenger/'+visitorId+'/process-send-message-profile';
    console.log('routeURL',routeURL);

    $.ajax({
      type:'POST',
      url:routeURL,
      dataType : 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success:function(response){
         if(response.reaction_code == 1){
             showSuccessMessage(response.message);
             setInterval(function () {
               location.reload();
           },1000);

         }else{
            showErrorMessage(response.message);
        }


    }

});

    return false;
});



    ///mobile


    //on like Callback function
    function onLikeCallback(response) {
        var requestData = response.data;
        //check reaction code is 1 and status created or updated and like status is 1
        if (response.reaction == 1 && requestData.likeStatus == 1 && (requestData.status == "created" || requestData.status == 'updated')) {
            __DataRequest.updateModels({
                'userLikeStatus': '<?= __tr('Liked') ?>', //user liked status
                'userDislikeStatus': '<?= __tr('Dislike') ?>', //user dislike status
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
                'userLikeStatus': '<?= __tr('Like') ?>', //user like status
                'userDislikeStatus': '<?= __tr('Disliked') ?>', //user disliked status
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
                'userLikeStatus': '<?= __tr('Like') ?>', //user like status
            });
            $(".lw-animated-like-heart").toggleClass("lw-is-active");
        }
        //check reaction code is 1 and status deleted and like status is 2
        if (response.reaction == 1 && requestData.likeStatus == 2 && requestData.status == "deleted") {
            __DataRequest.updateModels({
                'userDislikeStatus': '<?= __tr('Dislike') ?>', //user like status
            });
            $(".lw-animated-broken-heart").toggleClass("lw-is-active");
        }
        //remove disabled anchor tag class
        _.delay(function() {
            $('.lw-like-dislike-box').removeClass("lw-disable-anchor-tag");
        }, 1000);
    }
    /**************** User Like Dislike Fetch and Callback Block End ******************/
</script>
@stop