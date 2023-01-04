@extends('public-master')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">

<style type="text/css">
    select.select-sidebar {
        color: #000;
    }

    .vister p {
        margin-bottom: 2px;
        font-size: 14px;
        text-decoration: none;
        color: #4e4e4e;
    }

    .vister a:hover {

        text-decoration: none;
        color: #4e4e4e;
    }

    .mr-15 {
        margin-right: 15px;
    }

    /** popup messages **/

    .content-messages {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 100px;
        text-align: center;
        background-color: #fff;
        box-sizing: border-box;
        padding: 10px;
        z-index: 999999999;
        display: none;
        box-shadow: 0px 2px 7px 0px #9b9a9a;
    }

    .content-messages p {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f51b1c;
        margin: 0;
        height: 100%;
        font-size: 16px;
    }

    .close-btn {
        position: absolute;
        right: 5px;
        top: -13px;
        color: white;
        border-radius: 50%;
        padding: 4px;
        color: #f51b1c !important;
        font-size: 28px;
        cursor: pointer;
    }

    /*short by **/

    .dropdown-short select {
        word-wrap: normal;
        border: 1px solid #C7C7C7;
        padding: 7px 7px;
        border-radius: 5px;
        height: 40px;
        font-size: 16px;
    }

    .dropdown-short option:hover {
        color: #F51B1C;
    }

    .dropdown-short option:selected {
        color: #fff;
        background: #F51B1C;
        position: relative;
    }

    .active-short {
        display: block !important;
        background: red !magentant;
        color: #fff !important;
        font-weight: 600 !important;
    }

    .active-short,
    .active-short:hover,
    .active-short:focus,
    .active-short:focus-within,
    .active-short:target {
        background: red !important;
    }

    /* Defines the width of the carousel and centers it on the page */
    .slick-carousel {
        margin: 0 auto;
        width: 100%;
    }

    /* The width of each slide */
    .slick-slide {
        width: 350px;
    }

    /* Color of the arrows */
    .slick-next::before,
    .slick-prev::before {
        color: blue;
    }

    .slick-dots {
        bottom: unset;
        top: 0;
    }

    .slick-dots li button::before {
        font-size: 12px;
    }

    .user-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vister .vister-image-icon .vister-profile-image {
        height: 175px;
        width: 143px;
    }

    .select2-container--default .select2-selection--multiple {
        max-height: auto;
        min-height: 45px;
    }

    .activity-pagination {
        padding-top: 20px;
    }

    #grid_block .vister.align-items-center-1 {
        background-color: #fff9ea;
        border-color: #f6c23e;
    }

    @media screen and (max-width: 576px) {
        .vister .vister-image-icon .vister-profile-image {
            width: 100%;
            height: 200px;
        }

        .card .card-header>.d-flex {
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: flex-end;
            row-gap: 10px;
        }

        .card .card-header .d-flex a.web-button {
            margin-right: 0;
        }

        .card .card-header {
            align-items: center;
        }
    }
</style>

<style type="text/css">
    .event .vister-profile-image {
        height: 170px;
        width: 140px;
        margin-top: 30px;
    }

    .event p.event-title {
        position: absolute;
        top: 12px;
        font-size: 18px;
        font-weight: 500;
        left: 12px;
    }

    .vister .event p.user-name {
        margin-top: 2.5rem;
        font-size: 18px;
    }

    p.result-location {
        font-size: 20px;
    }

    p.event-title {
        width: 100%;
        font-size: 22px;
        font-weight: 500;
        border-bottom: 1px solid #eee;
        padding-bottom: 6px;
    }

    .vister .user-name {
        font-size: 18px;
        font-weight: 500;
    }

    #grid_block .vister {
        border: 1px solid #e9e9e9;
        position: relative;
        margin-bottom: 20px;
        border-radius: 5px;
        padding: 15px;
        flex-wrap: wrap;
    }

    #grid_block .vister>a {
        width: 100%;
    }


    p.user-name {
        margin-top: 2rem;
    }

    .vister-image-icon {
        margin: 2rem 0;
    }

    .view_event_main {
        color: #4e4e4e;
    }

    .pac-container {

        z-index: 1100 !important;

    }

    .filter-ul li {
        list-style: none;
    }

    .like {
        top: 15px;
    }

    .vister-image-icon a {
        display: block;
        width: 115px;
        height: 115px;
        margin-right: 16px;
    }

    .vister-image-icon a img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vister-image-icon i {
        right: 15px;
    }

    .vister-profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .web-button {
        align-items: center;
        display: flex;
        color: #fff !important;
    }

    @media (max-width: 767px) {
        .time text-right {
            width: 21%;
        }

        .gslide-media.gslide-image {
            position: relative !important;
        }

        /*    .gslide-media.gslide-image::after {
      position: absolute;
      content: "...";
      font-size: 50px;
      color: #171717;
      top: 0;
      line-height: 0px;
      right: 8px;
    }*/

        .gslide-media.gslide-image::after {
            position: absolute;
            content: "...";
            font-size: 97px;
            color: #fff;
            bottom: 40px;
            line-height: 0px;
            left: 50%;
            transform: translateX(-50%);
        }
    }


    @media screen and (max-width: 576px) {
        .vister-profile-image {
            height: 100%;
            height: 200px;
        }

        .filter .listing,
        .filter .grid_block {
            display: none;
        }

        .vister-image-icon a {
            height: 100%;
        }

        .desk-vw {
            display: none !important;
        }

        .vister-profile-image,
        .vister-image-icon,
        .img-about.d-flex.align-items-flex-start {
            width: 100%;
        }

        .slick-carousel {
            width: 120px;
            margin-right: 0.5rem;

        }

        .slick-dots li button::before {
            font-size: 8px !important;
        }

        .slick-dots li button {
            width: 0 !important;
            height: 0 !important;
        }

        .slick-dots li {
            margin: 0 !important;
            width: 12px !important;
            height: 12px !important;
        }

        .vister-image-icon {
            width: unset;
        }

    }

    @media screen and (min-width: 577px) {
        .mob-vw {
            display: none !important;
        }
    }

    .select2-hidden-accessible {
        clip: unset !important;
        height: 68px !important;
        overflow-y: scroll !important;
        padding: 0 !important;
        width: 100% !important;
        padding-left: 20px !important;
        border: 1px solid #ccc !important;
        margin-top: 15px !important;
    }

    #grid_block .vister.align-items-center-1:before {
        content: 'featured';
        position: absolute;
        top: -18px;
        right: 0;
        text-transform: uppercase;
        width: auto;
        background-color: #fff9ea;
        border: 1px solid #f6c23e;
        padding: 5px 20px;
        border-radius: 5px;
        font-weight: 700;
        color: #f51b1c !important;
    }

    #grid_block .vister.align-items-center-1 {
        margin-top: 30px;
    }

    #grid_block .vister.align-items-center-1 .like {
        top: 25px;
    }
    .select-drop-down p {
        font-weight: 700;
        text-transform: capitalize;
    }
</style>


<div id="wrapper" class="container-fluid">

    <!-- include sidebar -->

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

                    Notification </h6>

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

            <a class="nav-link" href data-toggle="modal" data-target="#boosterModal">

                <i class="fas fa-bolt fa-fw mr-2"></i>

                <span>Profile Booster</span>

                <span id="lwBoosterTimerCountDownOnSB"></span>

            </a>

        </li>



        <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

        @include('events.event-sidebar')

    </ul>



    <!-- Content Wrapper -->

    <div id="content-wrapper" class="d-flex flex-column lw-page-bg">

        <div id="content">
            <!-- Modal -->

            <div class="modal fade" id="boosterModal" tabindex="-1" role="dialog" aria-labelledby="boosterModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="boosterModalLabel">Boost Profile</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                        <div class="modal-body">
                            <!-- insufficient balance error message -->
                            <div class="alert alert-info" id="lwBoosterCreditsNotAvailable" style="display: none;">

                                Your credit balance is too low, please <a href="user/credit-wallet">purchase credits</a>

                            </div>

                            <!-- / insufficient balance error message -->



                            <div class="text-center">



                                This will costs you <span id="lwBoosterPrice">

                                    0 </span>

                                credits for immediate <span id="lwBoosterPeriod">

                                    5 </span>

                                minutes </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancel</button>

                            <a class="btn btn-success btn-sm lw-ajax-link-action" data-callback="onProfileBoosted" href="user/boost-profile" data-method="post"><i class="fas fa-bolt fa-fw"></i> Boost</a>

                        </div>

                    </div>

                </div>

            </div>
            <!--- add event modal -->


            <div class="modal fade add-evnt-modal" id="addEventPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0  text-center">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Add Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <hr />
                        <form class="userPhottoFormEvent" id="userPhottoFormEvent" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="phottoFromInput" name="phottoFrom">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="event-label" for="display-name">Title</label>
                                    <input type="text" name="title" value='' / required>

                                </div>
                                <div class="form-group">
                                    <label class="event-label" for="display-name">Description </label>

                                    <textarea id="w3review" name="description" rows="4" cols="45">

       </textarea>

                                </div>



                                <div class="form-group">
                                    <label class="event-label" for="display-name">Event Date</label>
                                    <!-- <input type="date" class="form-control" name="event_date" placeholder="mm/dd/yyyy" required=""> -->
                                    <select class="select-sidebar drop" name="event_date">

                                        <option value="">Any</option>



                                    </select>

                                </div>


                                <div class="form-group">
                                    <label class="event-label" for="display-name">Location</label>
                                    <input type="hidden" name="location_latitude" id="address-latitude12" value="" />
                                    <input type="hidden" name="location_longitude" id="address-longitude12" value="" />
                                    <input id="searchTextField-popup" type="text" name="location" class="map-input" value="{{ (isset($selectedFilter['location'])) ? $selectedFilter['location'] : '' }}" placeholder="Enter a location" autocomplete="on">

                                </div>
                                <div class="form-group">
                                    <label class="event-label" for="display-name">Meet Type</label>
                                    <select class="select-sidebar" name="meet_type">

                                        <option value="Dinner/Lunch date">Dinner/Lunch date</option>
                                        <option value="Meet at your place">Meet at your place</option>
                                        <option value="Social meetup">Social meetup</option>
                                        <option value="Meet at my place">Meet at my place</option>
                                        <option value="Night out">Night out</option>
                                        <option value="Anything, anywhere">Anything, anywhere</option>
                                        <option value="Hotel meet">Hotel meet</option>
                                        <option value="Club meet">Club meet</option>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="event-label" for="display-name"><a href="#" onclick="togglePopup()"> Privacy (stop these users from seeing your event)</a></label>
                                    <select class="select2 select2-hidden-accessible" name="block_user[]" multiple="" style=" clip: unset !important;
    height: 68px !important;
    overflow-y: scroll !important;
    padding: 0 !important;
    width: 100% !important;
    padding-left: 20px !important;
    border: 1px solid #ccc !important;
    position: relative !important;
    margin-top: 15px !important;" data-select2-id="7" tabindex="-1">

                                        @foreach($UserBock as $key => $value)
                                        <?php


                                        // $UserBlock =App\Exp\Components\User\Models\UserBlock::where('to_users__id',$value['_id'])->where('by_users__id',Auth::user()->_id)->first(); 

                                        // if(empty($UserBlock)){

                                        ?>
                                        <option data-select2-id="<?php echo $value['_id']; ?>" value="<?php echo $value['_id']; ?>"><?php echo $value['username'];     ?></option>
                                        <?php
                                        //} 

                                        ?>
                                        @endforeach

                                    </select>
                                </div>



                                <!-- <div class="form-group file-uploader-main mt-3">
    <input id='userUploadPublicPhottoButton' name="image" type='file' hidden/>
    <input type='file' id='userPublicUploadFileButtons' name="image" class="action-button" type='button' value='Add a public photo' />
    <p class="uploader-txt mb-0 d-flex align-items-center justify-content-center h-100 ">upload <i class="fas fa-upload"></i></p>
     <div class="uploaded-img">
         <img id="blah" src="" >
     </div>


 </div> -->




                            </div>
                            <hr />
                            <div class="modal-footer border-top-0 d-flex justify-content-center">

                                <button type="button" class="btn btn-danger userPhottoCancelBtn c-btn" data-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-success s-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--- messages popup -->

            <div class="content-messages">
                <div onclick="togglePopup()" class="close-btn">
                    ×
                </div>
                <p>
                    If you have blocked a user then their username will not show up
                </p>
            </div>




            <!-- Delete Account Container -->

            <div class="modal fade" id="lwDeleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="messengerModalLabel" aria-hidden="true" style="display: none;">

                <div class="modal-dialog modal-lg" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">Delete account?</h5>

                        </div>

                        <div class="modal-body">

                            <!-- Delete Account Form -->

                            <form class="user lw-ajax-form lw-form" method="post" action="user/delete-account">

                                <!-- Delete Message -->

                                Are you sure you want to delete your account? All content including photos and other data will be permanently removed!
                                <!-- /Delete Message -->

                                <hr />

                                <!-- password input field -->

                                <div class="form-group">

                                    <label for="password">Enter your password</label>

                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required minlength="6">

                                </div>

                                <!-- password input field -->



                                <!-- Delete Account -->

                                <button type="submit" class="lw-ajax-form-submit-action btn btn-primary btn-user btn-block-on-mobile">Delete Account</button>

                                <!-- / Delete Account -->

                            </form>

                            <!-- /Delete Account Form -->

                        </div>

                    </div>

                </div>

            </div>


            <!-- product zoom gallery block -->

            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                <div class="pswp__bg"></div>

                <div class="pswp__scroll-wrap">

                    <div class="pswp__container">

                        <div class="pswp__item"></div>

                        <div class="pswp__item"></div>

                        <div class="pswp__item"></div>

                    </div>

                </div>

            </div>

            <!-- / product zoom gallery block -->

            <!-- End of Topbar -->

            <!-- /include top bar -->



            <!-- Begin Page Content -->

            <div class="lw-page-content px-2">

                <!-- header advertisement -->

                <div class="lw-ad-block-h90">

                </div>

                <div class="card mb-3 desk-vw">

                    <div class="card-header d-flex justify-content-between align-items-center filter">

                        <h3 class="mb-0">
                            <div class="css-r0xk3p" style="font-size: 0.875rem; color: rgb(126, 126, 126);">About <?= $totalCount ?> Results...</div>

                        </h3>


                        <div class="d-flex align-items-center">
                            <div class="d-flex list_style_togle user_search">

                            </div>
                            <div class="col-md-3 col-sm-12 text-right intrest-input pr-0">
                                <form action="<?= route('user.read.events') ?>">
                                    <div class="dropdown-short">

                                        <?php
                                        $AddClass1 = "";
                                        $AddClass3 = "";
                                        if (Request::get('short_by') == 'newest') {
                                            $AddClass1 = "active-short";
                                        }

                                        if (Request::get('short_by') == 'nearest') {
                                            $AddClass3 = "active-short";
                                        }
                                        ?>


                                        <select name="short_by" id="selected-short" class="selected-by-short">

                                            <option class="shot_opt <?php echo $AddClass1; ?>" value="newest" @if(Request::get('short_by')) @if(Request::get('short_by')=='newest' ) selected @endif @endif>Sort By: Newest</option>



                                            <option class="shot_opt <?php echo $AddClass3; ?>" value="nearest" @if(Request::get('short_by')) @if(Request::get('short_by')=='nearest' ) selected @endif @endif>Sort By: Nearest</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card mb-3 ">

                    <div class="card-header d-flex justify-content-between">

                        <h3><i class="fa-solid fa-photo-film"></i>Meets</h3>
                        @if(Auth::user()->is_verified == 1)
                        <div class="d-flex">
                            <!-- <button class="web-button mr-15">My Events</button> -->
                            <a href="{{url('events-views')}}" class="web-button mr-15">My Meets</a>
                            <button data-toggle="modal" data-target="#addEventPopup" class="web-button">Add Meet</button>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="mb-3 d-md-none">

                    <div class="card-header d-flex justify-content-between">

                        <!--    <h3 class="mb-0"><div class="css-r0xk3p" style="font-size: 0.875rem; color: rgb(126, 126, 126);">About <?= $totalCount ?> Results...</div></h3> -->

                        <div class="d-flex">
                            <button id="show_filtermobile" class="web-button event-filter-button">Filters demo</button>

                        </div>
                        <div class="col-md-3 col-sm-12 text-right intrest-input pr-0">
                            <form action="<?= route('user.read.events') ?>">
                                <div class="dropdown-short">

                                    <? if (Request::get('short_by') == 'newest') {
                                        $AddClass1 = "active-short";
                                    } else {
                                        $AddClass1 = " ";
                                    }

                                    if (Request::get('short_by') == 'nearest') {
                                        $AddClass3 = "active-short";
                                    } else {
                                        $AddClass3 = " ";
                                    }

                                    ?>
                                    <select name="short_by" id="selected-short-mob" class="selected-by-short">
                                        <option class="shot_opt <?php echo $AddClass1; ?>" value="newest" @if(Request::get('short_by')) @if(Request::get('short_by')=='newest' ) selected @endif @endif>Sort By: Newest</option>
                                        <option class="shot_opt <?php echo $AddClass3; ?>" value="nearest" @if(Request::get('short_by')) @if(Request::get('short_by')=='nearest' ) selected @endif @endif>Sort By: Nearest</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

                <!--  <div class="card mb-3 ">

    <div class="card-header d-flex justify-content-between align-items-center filter">

     <div class="d-flex">
       <p>Inbox</p>
       <p>Filterd Out</p>
   </div>
   

   <div class="d-flex align-items-center"> 
    <div class="d-flex list_style_togle user_search">
          <i class="fa-solid fa-table-cells listing red_box"></i>
        <i class="fa-solid fa-table-list  grid_block red_box"></i>
     
       
    </div> -->
                <!-- <div class="col-md-3 col-sm-12 text-right intrest-input">
       <form action="">
         <select name="paginate" id="paginateCountForm">
             <option value="30" @if(Request::get('paginate')) @if(Request::get('paginate') == 30) selected @endif @endif>30 per page</option>
             <option value="60" @if(Request::get('paginate')) @if(Request::get('paginate') == 60) selected @endif @endif>60 per page</option>
             <option value="100" @if(Request::get('paginate')) @if(Request::get('paginate') == 100) selected @endif @endif>100 per page</option>
         </select>
     </form>
 </div> -->
                <!-- </div>
</div>

</div> -->

                <div class="card mb-3 d-md-none event-filter" style="display: none;">



                    <ul class="mobile-filter">
                        <li><a class="btn FormFooter-rightLink u-hide--tablet-up js-toggleSidebarBtn css-157uzvc" id="filterSidebarClose">
                                <svg viewBox="0 0 24 24" fill="black" width="24px" height="24px">
                                    <g fill="#949494">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                                    </g>
                                </svg></a></li>
                         @include('events.event-sidebar-mobile')
                    </ul>
                </div>
            </div>






            <!--- Views----->


            <div class="row m-0" id="grid_block">
                <div class="col-md-12">


                    @if(!__isEmpty($dataEvents))
                    @foreach($dataEvents as $filter)

                    <?php $block_user = explode(',', $filter['block_user']); ?>

                    @if(!in_array($filter['auth_id'], $block_user))
                    <?php


                    if ($filter['profile_picture']) {
                        $imgURL = url('/') . '/media-storage/users/' . $filter['UID'] . '/' . $filter['profile_picture'];
                    } else {

                        $imgURL = url('/') . '/imgs/default-image.png';
                    }


                    ?>

                    @if(Auth::user()->is_verified == 1)
                    <a href="<?= route('user.view.events') ?>/?id={{ $filter['_id'] }}">
                        @endif
                        <div class="vister d-flex justify-content-between pb-3  align-items-center-{{$filter['featured']}}">
                            <p class="event-title">{{ isset($filter['title']) ? $filter['title'] : '' }}</p>
                            <a href="<?= route('user.view.events') ?>/?id={{ $filter['_id'] }}">
                                <div class="img-about d-flex align-items-flex-start" style="width: 100%;">
                                    <div class="vister-image-icon">
                                        <div class="slick-carousel mob-vw">
                                            <?php foreach ($filter['user_photos']['photos'] as $photos) {
                                                if ($photos['extantion_type'] == 'jpeg' || $photos['extantion_type'] == 'jpg') {
                                                    $imgURLpop = url('/') . '/media-storage/users/' . $filter['UID'] . '/' . $photos['file']; ?>
                                                    <div class="">
                                                        <div class=" vister-profile-image user-img">
                                                            <img width="300px" class="vister-profile-image" src="{{ $imgURLpop }}">
                                                        </div>
                                                    </div>

                                            <?php  }
                                            } ?>
                                        </div>
                                        <div class="vister-profile-image desk-vw">
                                            <img width="300px" src="{{ $imgURL }}">
                                        </div>


                                        <i class="fa-solid fa-camera"></i>

                                    </div>
                                    <div style="width:100%;">

                                        <p class="user-name">{{$filter['meet_type'] }}</p>


                                        <?php $description = substr($filter['description'], 0, 150) . '...'; ?>

                                        <p>{{$description }} </p>

                                        <?php $event_date = date('D, M d', strtotime($filter['event_date'])); ?>
                                        <p class=" adress text-gray-600">Event On: {{ $event_date }}</p>

                                        <p class=" adress text-gray-600">{{ isset($filter['location']) ? $filter['location'] : '' }}</p>


                                        <p class="text-right"><span class="send">View More</span></p>
                                    </div>
                                </div>
                            </a>
                            <div class="about-vistor">
                                <p class="ethnicty"><b> </b></p>
                            </div>
                            <div>



                                <p class="timing">{{ isset($active_status_time) ? $active_status_time : '' }}</p>

                                <p class="timing"></p>

                                <?php if ($filter['_id'] == $filter['event_id']) {
                                    $hasLike = "like_true";
                                } else {
                                    $hasLike = "";
                                }
                                ?>

                                <div class="like">
                                    <a href data-action="<?= route('event.write.like_dislike', ['toUserUid' => $filter['_id'], 'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn">
                                        <i class="fa-solid fa-heart {{ $hasLike }} "></i>
                                    </a>
                                </div>


                            </div>
                        </div>
                        @if(Auth::user()->is_verified == 1)
                    </a>
                    @endif
                    @endif

                    @endforeach
                    <div class="activity-pagination text-right">
                        {!! $eventsData->links() !!}
                    </div>
                    @else
                    <!-- info message -->
                    <div class="col-sm-12 alert alert-info">
                        <?= __tr('There are no matches found.') ?>
                    </div>
                    <!-- / info message -->
                    @endif



                </div>



            </div>

        </div>



        <!-- /User Specifications -->



    </div>

</div>
</div>


<script type="text/javascript">
    document.getElementById('userPublicUploadFileButton').addEventListener('click', openDialogPublic);

    function openDialogPublic() {
        document.getElementById("phottoFromInput").value = "1";
        document.getElementById('userUploadPublicPhottoButton').click();

    }

    $(document).ready(function() {
        $('.search-event-submit-btn').click(function() {
            $('#event-serach-form').submit()
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>

<script type="text/javascript">
    $(document).ready(function() {

        jQuery('#selected-short').change(function() {
            $(this).find('option').css('background-color', 'red');
            $(this).find('option:selected').css('background-color', 'red');
            this.form.submit();
        });

        jQuery('#selected-short-mob').change(function() {
            $(this).find('option').css('background-color', 'red');
            $(this).find('option:selected').css('background-color', 'red');
            this.form.submit();
        });


        const autocompletes = [];
        const geocoder = new google.maps.Geocoder;
        //$( "#searchTextField-popup" ).click(function() {
        $("body").on("click", "#searchTextField-popup", function(e) {

            $("#address-latitude12").val('');
            $("#address-longitude12").val('');


            e.preventDefault();
            const locationInputsAddress = document.getElementById("searchTextField-popup").value;


            geocoder.geocode({
                'address': locationInputsAddress
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();

                    // document.getElementById("address-latitude12").value = lat;
                    // document.getElementById("address-longitude1").value = lng;

                    $("#address-latitude12").val(lat);
                    $("#address-longitude12").val(lng);


                }
            });
        });


        $('.locationFilterCity input').attr('checked', true);
        $("#locationRd li").click(function() {
            $('#locationRd li input').attr('checked', false);
            $(this).find('input').attr('checked', true);
        });
    });
    $(document).ready(function() {



        $("#filterSidebarClose").click(function() {

            $('.event-filter').hide();


        });

        $("#show_filtermobile").click(function() {

            $('.event-filter').show();


        });

        $("#locationRd li").click(function() {


            $('.serarh_location').show();
        });

        $('#searchTextField').hide();
        $('body').on('click', '.locationFilterMap', function() {
            $('#searchTextField').show();
        });
    });


    function initialize() {
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);

        var input1 = document.getElementById('searchTextField-popup');
        var autocompletePop = new google.maps.places.Autocomplete(input1);

    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
    $("body").on("submit", ".userPhottoFormEvent", function(e) {


        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('event-add') }}",
            dataType: 'json',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                //showSuccessMessage("Updated Successfully");
                if (response.status == 'success') {
                    showSuccessMessage("Event Add Successfully");

                    setInterval(function() {
                        window.location.href = "{{ url('events') }}";
                    }, 1000);

                }
                //
                // console.log(response.data.stored_photo.image_url);


            }

        });

        return false;
    });

    $('#blah').hide();
    userPublicUploadFileButtons.onchange = evt => {
        const [file] = userPublicUploadFileButtons.files
        if (file) {


            $('#blah').show();
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".event-filter").hide();
        $(".event-filter-button").click(function() {
            $(".event-filter").show("slow");
        });
        $("#filterSidebarClose").click(function() {
            $(".event-filter").hide("slow");
        });
    });


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



        var requestData = response.status;

        if (requestData == "success") {
            showSuccessMessage("Event liked successfully.");
            $(".lw-animated-like-heart").toggleClass("lw-is-active");
        }
        var requestData1 = response.status_remove;
        if (requestData1 == "delete") {
            showSuccessMessage("Event Disliked successfully.");
        }
    }



    $(".lw-like-action-btn i").on('click', function() {


        if ($(this).hasClass("like_true")) {

            $(this).removeClass("like_true");
        } else {
            $(this).addClass("like_true");
        }

    });
</script>


<script>
    $(function() {
        $("#slider-vertical").slider({
            orientation: "vertical",
            range: "min",
            min: 0,
            max: 100,
            value: 60,
            slide: function(event, ui) {
                $("#amount").val(ui.value);
            }
        });
        $("#amount").val($("#slider-vertical").slider("value"));
    });
</script>
<script type="text/javascript">
    const settings = {
        fill: '#FF0000',
        background: '#d7dcdf'
    }


    const sliders = document.querySelectorAll('.range-slider');


    Array.prototype.forEach.call(sliders, (slider) => {

        slider.querySelector('input').addEventListener('input', (event) => {

            slider.querySelector('span').innerHTML = '0 - ' + event.target.value + ' Km';

            applyFill(event.target);
        });

        applyFill(slider.querySelector('input'));
    });


    function applyFill(slider) {

        const percentage = 100 * (slider.value - slider.min) / (slider.max - slider.min);

        const bg = `linear-gradient(90deg, ${settings.fill} ${percentage}%, ${settings.background} ${percentage+0.1}%)`;
        slider.style.background = bg;
    }
</script>

<!-- jQuery CDN -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- slick Carousel CDN -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js"></script>




<script type="text/javascript">
    $('.slick-carousel').slick({
        infinite: true,
        slidesToShow: 1, // Shows a three slides at a time
        slidesToScroll: 1, // When you click an arrow, it scrolls 1 slide at a time
        arrows: false, // Adds arrows to sides of slider
        dots: true // Adds the dots on the bottom
    });
</script>

<script type="text/javascript">
    // Function to show and hide the popup
    function togglePopup() {
        $(".content-messages").toggle();
    }


    var weekday = new Array(7);
    weekday[0] = "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";

    for (var i = 0; i <= 60; i++) {

        var date = new Date();
        date.setDate(date.getDate() + i);
        const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        $(".drop").append("<option value=" + (date.getDate()) + "-" + (month[date.getMonth()]) + "-" + date.getFullYear() + ">" + (date.getDate()) + " " + (month[date.getMonth()]) + " " + date.getFullYear() + "   (" + weekday[date.getDay()] + ")</option>");
    }
</script>




@stop