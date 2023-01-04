@extends('public-master')
@section('content')
@section('page-title', __tr('Find Matches'))
@section('head-title', __tr('Find Matches'))
@section('keywordName', __tr('Find Matches'))
@section('keyword', __tr('Find Matches'))
@section('description', __tr('Find Matches'))
@section('keywordDescription', __tr('Find Matches'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
<style type="text/css">
    /*short by **/

    .dropdown-short select{
        word-wrap: normal;
        border: 1px solid #C7C7C7;
        padding: 7px 7px;
        border-radius: 5px;
        height: 40px;
        font-size: 16px;
    }
    .dropdown-short option:hover{
      color: #F51B1C;
  }
  .dropdown-short option:selected{
   color: #fff;
   background: #F51B1C;
   position: relative;
}
.active-short {
  display: block !important;
  background: red !important;
  color: #fff!important;
  font-weight: 600!important;
}

.active-short, .active-short:hover, .active-short:focus, .active-short:focus-within, .active-short:target {
 background: red !important;
}

    /** /

    /* Defines the width of the carousel and centers it on the page */
    .slick-carousel {
      margin: 0 auto;
      width: 1000px;
  }

/* The width of each slide */
.slick-slide {
  width: 350px;
}

/* Color of the arrows */
.slick-slider{
    width: 100% !important;
}
.slick-next::before, .slick-prev::before {
  color: blue;
}
.slick-dots{
  bottom: unset;
  top: 0;
}
.slick-dots li button::before  {
  font-size: 8px !important;
}
.user-img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.slick-dots li{
    margin: 0 !important;
    width: 12px !important;
    height: 12px !important;
}
.slick-dots li button{
    width: 0 !important;
    height: 0 !important;
}

#grid_block,
#list_view{
    display: none;
}

.grid_active{
    display:flex !important;
}
.list_active{
    display: block !important;
}
</style>
<style type="text/css">
    .filter i {
        padding: 7px;
        margin: 0px;
        border: 1px solid rgb(204, 204, 204);
        font-size: 21px;
        -moz-box-align: center;
        -moz-box-pack: center;
        justify-content: center;
        box-sizing: border-box;
        padding: 9px 13px;
        font-size: 20px;
        font-weight: 700;
        line-height: 1;
        outline: currentcolor none medium;
        cursor: pointer;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
    }
    .filter i:hover {
        background-color: white;
        padding: 9px 13px;
        box-shadow: 0px 0px 6px 1px #cbcbcb;
        border-radius: 3px;
        border: 1px solid #000;
    }

    .filter select {
        padding: 7px 7px;
    }
    .fa-solid.fa-table-cells.grid_block:focus {
        background: red !important;
    }
    .active_block {
      border: 1px solid black !important;
      background: #fff;
  }
  .fa-solid.fa-table-list.listing.red_box.active_block {
    color: #000;
}
.fa-solid.fa-table-cells.grid_block.red_box.active_block {
    color: #000;
}
#list_view .vister > a {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    z-index: 0;
}
#list_view .like {
    position: relative;
    z-index: 1 !important;
}






@media screen and (min-width:577px ){
    .mob-vw,.slick-dots{
        display: none !important;
    }
}
@media screen and (max-width:576px ){
    .filter i {
        padding: 9px;
        font-size: 18px;
    }
    .filter select {
        font-size: 14px;
    }
    .desk-vw{
        display: none !important;
    }
    .slick-left-img {
        flex-shrink: 0;
        width: 100px;
        margin-right: 10px;
    }
    #list_view .vister-profile-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .user-img a {
        display: block;
        height: 150px;
        width: 100px;
    }
}

.btn.btn--action.searchResultsSaveBtn {
    background-color: red;
    color: #fff;
}
</style>

<div class="lw-page-content px-2">
    <!-- header advertisement -->
    <div class="lw-ad-block-h90"></div>
    <div class="card mb-3 ">
        <div class="card-header d-flex justify-content-between">
            <div class="d-flex"> 
                <button class="filter-search-mobile web-button">Filters</button>
            </div>
            <div class="col-md-3 col-sm-12 text-right intrest-input pr-0">
                <form action="<?= route('user.read.search') ?>">
                    <div class="dropdown-short">
                        <? 
                        $addClass1 = "fa-1";
                        $addClass2 = "fa-1";
                        $addClass3 = "fa-1";
                        if(Request::get('short_by') == 'newest'){
                            $AddClass1 ="active-short";
                        }
                        if(Request::get('short_by') == 'active'){
                            $AddClass2 ="active-short";
                        }
                        if(Request::get('short_by') == 'nearest'){
                            $AddClass3 ="active-short";
                        }
                        ?> 
                        <select name="short_by" id="selected-short" class="selected-by-short">
                            <option class="shot_opt @if(isset($addClass1)) {{ $addClass1 }} @endif" value="newest" @if(Request::get('short_by')) @if(Request::get('short_by') == 'newest') selected @endif @endif >Sort By: Newest</option>
                            <option class="shot_opt @if(isset($addClass2)) {{ $addClass2 }} @endif"  value="active" @if(Request::get('short_by')) @if(Request::get('short_by') == 'active') selected @endif @endif >Sort By: Recently Active</option>
                            <option class="shot_opt @if(isset($addClass3)) {{ $addClass3 }} @endif"  value="nearest" @if(Request::get('short_by')) @if(Request::get('short_by') == 'nearest') selected @endif @endif>Sort By: Nearest</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card mb-3 ">
        <div class="card-header d-flex justify-content-between align-items-center filter filter-page-search-area">
            <!--<h3 class="mb-0"><div class="css-r0xk3p" style="font-size: 0.875rem; color: rgb(126, 126, 126);">About <?= $totalCount ?> Results...</div></h3>-->
            <div class="filter-middle-search-area d-flex">
                <span class="list-item text-right" id="trigger_search">
                    <button type="submit" class="btn btn--action searchResultsSaveBtn">Save this search</button>
                </span>
                <span class="middle-dropdown">  
                    <div class="dropdown_search">
                        <div class="top-search"><button onclick="mySerach()" class="dropbtn_search">Saved Searches <i class="fa-solid fa-angle-down d-none"></i></button></div>
                        <div id="myDropdown_search" class="dropdown-content_search">
                           
                            <ul class="Filter-Edit-default">
                                <li>
                                    <ul>
                                        <li class="list-item" style="display: none;">
                                            <span class="editSearch">
                                                <span>Save Search</span>
                                            </span>
                                        </li>
                                        @if (isset($_GET['current-search-id']) && $_GET['current-search-id'])
                                        
                                        <li class="list-item delete-save-serach" style="display: block;" current-search-id="{{ $_GET['current-search-id'] }}"><span><span>Delete Search</span></span></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                            <hr>
                            <ul class="show-recent-serach">
                                <li class="main-title ">
                                    <span>Saved Searches</span>
                                </li>
                                @forelse($saveUserSerach as $key => $saveUserSerachVal)
                                <li class="list-item">
                                    <a href="{{ $saveUserSerachVal->url }}"> 
                                        <span>{{ $saveUserSerachVal->name }}</span>
                                    </a>
                                </li>
                                @empty
                                <li class="main-title" style="color: rgb(0, 0, 0); font-size: 16px;">
                                    <span>No saved searches</span>
                                </li>
                                @endforelse    
                            </ul>
                        </div>
                    </div>
                </span>
            </div>
            <div class="d-flex align-items-center"> 
                <div class="d-flex list_style_togle user_search">
                    <i class="fa-solid fa-table-cells grid_block red_box"></i>
                    <i class="fa-solid fa-table-list listing red_box"></i>
                </div>
                <div class="col-md-3 col-sm-12 intrest-input pr-0">
                    <form action="<?= route('user.read.search') ?>">
                        <select name="paginate" id="paginateCountForm">
                            <option value="30" @if(Request::get('paginate')) @if(Request::get('paginate') == 30) selected @endif @endif>30 per page</option>
                            <option value="60" @if(Request::get('paginate')) @if(Request::get('paginate') == 60) selected @endif @endif>60 per page</option>
                            <option value="100" @if(Request::get('paginate')) @if(Request::get('paginate') == 100) selected @endif @endif>100 per page</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="card mb-3 d-md-none event-filter">

        <div class="card-header">

         <ul class="mobile-filter">
            <li><a class="btn FormFooter-rightLink u-hide--tablet-up js-toggleSidebarBtn css-157uzvc" id="filterSidebarClose"><svg viewBox="0 0 24 24" fill="black" width="24px" height="24px"><g fill="#949494"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></g></svg></a></li>
            <li class="nav-item ">

             <select class="select-sidebar">

                 <option>Saved Searchs & Option</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

             <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

                 Load More

             </button><p>Reset All</p></span>

         </li>

         <!-- Heading -->

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>Location</p>

             <select class="select-sidebar">

                 <option>City, Postel Code</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

         </li>

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>Meet Type</p>

             <select class="select-sidebar">

                 <option>Any</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

         </li>

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>When</p>

             <select class="select-sidebar">

                 <option>Any</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

         </li>

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>Profile</p>

             <select class="select-sidebar">

                 <option>Jhone Deo, Honkin</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

             <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

                 Search

             </button><p>Reset All</p></span>

         </li>

     </ul>

 </div>

</div>

</div>

<div class="row grid_active" id="grid_block">

    @if(!__isEmpty($filterData))

    
    @foreach($filterData as $filter)

    <?php //echo "<pre>"; print_r($filter['userProfilePhotosSlider']); die;?>

    <div class="col-6 col-sm-6 col-md-4">
        <div class="serch-result-box">
            <div class="result-box-img">
                <div class="slick-carousel">
                 @foreach($filter['userPhottoLists'] as $imagesList)
                 <?php $userProfileLink = url('/member').'/'.$filter['user_uid']; ?>
                 @if($imagesList['type'] == 1)

                 <?php  $imageType = 'public';?>
                 @else
                 <?php $imageType = 'private';?>
                 @endif
                 <?php  

                 $mediaType = "default";
                 if(isset($imagesList['file'])){
                   if($imagesList['extantion_type'] == 'mp4' || $imagesList['extantion_type'] == 'MOV' || $imagesList['extantion_type'] == 'wmv' || $imagesList['extantion_type'] == 'WMV' || $imagesList['extantion_type'] == '3gp' || $imagesList['extantion_type'] == '3GP' || $imagesList['extantion_type'] == 'avi' || $imagesList['extantion_type'] == 'AVI' || $imagesList['extantion_type'] == 'f4v' || $imagesList['extantion_type'] == 'f4v' || $imagesList['extantion_type'] == 'MP4' || $imagesList['extantion_type'] == 'mov' || $imagesList['extantion_type'] == 'webm' || $imagesList['extantion_type'] == 'mkv' || $imagesList['extantion_type'] == 'flv' || $imagesList['extantion_type'] == 'svi' || $imagesList['extantion_type'] == 'mpg'|| $imagesList['extantion_type'] == 'mpeg'|| $imagesList['extantion_type'] == 'amv'){
                     $mediaType = "video";
                     $imgURL = url('/').'/media-storage/users/'.$filter['user_uid'].'/'.$imagesList['video_thumbnail'];
                 }else{
                     $mediaType = "image";
                     $imgURL = url('/').'/media-storage/users/'.$filter['user_uid'].'/'.$imagesList['file'];
                 }

                   //     if($imagesList['extantion_type'] == 'jpeg' || $imagesList['extantion_type'] == 'jpg' ){
                 

                   //  }else{
                   //     $imgURL = url('/').'/imgs/default-image.png';
                   // }
             }else{
                 $imgURL = url('/').'/imgs/default-image.png';
             }
             
   // $imgURL = imageOrNoImageAvailable($filter['profileImage']);
   // $videourl = url('/').'/media-storage/users/'.$filter['user_uid'].'/'.$imagesList['video_thumbnail'];
             ?>

             <!-- Create your own class for the containing div -->

             <!-- Inside the containing div, add one div for each slide -->

             @if($mediaType == 'default')
             <a href="{{ $userProfileLink }}">
              <div class="user-img mob-vw">                    
                  
                <img src="{{ url('/') }}/imgs/default-image.png'">
            </div>
        </a>
        @elseif($mediaType == 'video')
        <a href="{{ $userProfileLink }}">
            <div class="user-img mob-vw"> 
                <div id="trigger_vdo" class="span4 proj-div videoplay trigger_vdo" dataivideo="{{ $imgURL }}">

                    <img class="activity_uploaded_video_link" src="{{ $imgURL }}">

                    <!-- <i class="fa fa-play" aria-hidden="true"></i> -->

                </div>
            </div>
        </a>
        @else
        <a href="{{ $userProfileLink }}">
          <div class="user-img mob-vw">                    
              <img src="{{ $imgURL }}">
          </div>
      </a>
      @endif
      



      @endforeach
  </div>
  <!-- <a href="{{ $filter['profileImage'] }}" class="glightbox4 desk-vw"> -->
    <a href="{{ url('/member')}}/{{ $filter['user_uid'] }}"> 
     <img src="<?= imageOrNoImageAvailable($filter['profileImage']) ?>" width="100%">
 </a>
 
</div>

<?php if( in_array( $filter['user_id'] ,$LikeUserId ) )
{
   $hasLike = "like_true";
}else{
    $hasLike = "";
} 
?>
<div class="result-box-body">

  <div class="like lw-like-dislike-box">
   
   <a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $filter['user_uid'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
    <i class="fa-solid fa-heart {{ $hasLike }}"></i>
</a>

</div>

<a href="{{ url('/member')}}/{{ $filter['user_uid'] }}"> 

    <p class="font-bold live-status">  

     @if($filter['userOnlineStatus'])

     @if($filter['userOnlineStatus'] == 1)
     <span class="lw-dot lw-dot-success" title="Online"></span>
     @elseif($filter['userOnlineStatus'] == 2)
     <span class="lw-dot lw-dot-warning" title="Idle"></span>
     @elseif($filter['userOnlineStatus'] == 3)
     <span class="lw-dot lw-dot-danger" title="Offline"></span>
     @endif

     @endif
     
     <?= $filter['username'] ?>
 </p>

</a>

<P class="result-location text-gray-400">  @if($filter['countryName'])
    <?= $filter['userAge'] ?>  <?= $filter['countryName'] ?>
@endif</P>

<p class="adress"> <?= $filter['userAge'] ?> <?= $filter['city'] ?></p>

<a href="{{ url('/') }}"><p>{{ $filter['totalPhotto'] }} photos</p></a>
</div>
</div>
</div>



@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info">
    <?= __tr('There are no matches found.') ?>
</div>
<!-- / info message -->
@endif

</div>


<div class="row" id="list_view">
   @if(!__isEmpty($filterData))
   @foreach($filterData as $filter)
   <div class="col-md-12">
        <a href="{{ url('/member')}}/{{ $filter['user_uid'] }}">
       <div class="vister d-flex justify-content-between pb-3  align-items-center">
           <div class="img-about d-flex align-items-flex-start">
                <div class="slick-left-img"> 
                    <div class="slick-carousel"> 
                         @foreach($filter['userPhottoLists'] as $imagesList)
                             @if($imagesList['type'] == 1)
                                <?php  $imageType = 'public';?>
                             @else
                                <?php $imageType = 'private';?>
                             @endif
                             <?php  
                             
                                if(isset($imagesList['file'])){
                                     if($imagesList['extantion_type'] == 'jpeg' || $imagesList['extantion_type'] == 'jpg' ){
                                        $imgURL = url('/').'/media-storage/users/'.$filter['user_uid'].'/'.$imagesList['file'];
                
                                    }else{
                                         $imgURL = url('/').'/imgs/default-image.png';
                                     }
                                }else{
                                     $imgURL = url('/').'/imgs/default-image.png';
                                } ?>     
        
                            <div class="vister-image-icon mob-vw">
                                <div class="user-img ">
                                    <!--<a href="{{ url('/member')}}/{{ $filter['user_uid'] }}"> -->
                                        <img width="300px" class="vister-profile-image" src="{{ $imgURL }}">
                                        <!--</a>-->
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </div> 
                        @endforeach
                    </div> 
                </div>

                <div class="vister-image-icon desk-vw">
                    <!--<a href="{{ url('/member')}}/{{ $filter['user_uid'] }}">-->
                        <img width="300px" class="vister-profile-image" src="<?= imageOrNoImageAvailable($filter['profileImage']) ?>">
                    <!--</a>-->
                    <i class="fa-solid fa-camera"></i>
                </div>
    
                <div>            
                    @if($filter['userOnlineStatus'])

                    @if($filter['userOnlineStatus'] == 1)
                    <span class="lw-dot lw-dot-success" title="Online"></span>
                    @elseif($filter['userOnlineStatus'] == 2)
                    <span class="lw-dot lw-dot-warning" title="Idle"></span>
                    @elseif($filter['userOnlineStatus'] == 3)
                    <span class="lw-dot lw-dot-danger" title="Offline"></span>
                    @endif

                    @endif
                    <?= $filter['username'] ?>
                    <p class="location"><?= substr_replace($filter['heading'], "...", 50) ?></p>
                    <p class="adress"> <?= $filter['userAge'] ?> <?= $filter['city'] ?></p>
                    <p class="height"><b>Height : </b><?= $filter['height'] ?>cm</p>
                    <p class="body"><b>Body : </b><?= $filter['body_type_name'] ?></p>
                    <p class="photos"><?= $filter['totalPhotto'] ?> photos</p></a>
                </div>
            </div>
            <div class="about-vistor"> 
                <p class="ethnicty"><b>Ethncity : </b><?= $filter['ethnicity_name'] ?></p>
            </div>

            <div>
                <?php if( in_array( $filter['user_id'] ,$LikeUserId ) )
                {
                    $hasLike = "like_true";
                }else{
                $hasLike = "";
                } 
                ?>
                <?php if($filter['userOnlineStatus'] == 1) {?>
                    <p class="timing">Online</p>
                <?php }else{ ?>
                    <p class="timing"><?= $filter['userOnlineStatusAgo'] ?></p>
                <?php  } ?>
                <div class="like"> 
                     <a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $filter['user_uid'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
                        <i class="fa-solid fa-heart {{ $hasLike }}"></i>
                    </a>
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info">
    <?= __tr('There are no matches found.') ?>
</div>
<!-- / info message -->
@endif
</div>


<div class="col-md-12 pagination-section">
    {!! $filterDataCollectionMain->links() !!}
</div>

<!-- /User Specifications -->
@push('appScripts')
<script>
    function loadMoreUsers(responseData) {
        $(function() {
            applyLazyImages();
        });
        var requestData = responseData.data,
        appendData = responseData.response_action.content;
        $('#lwUserFilterContainer').append(appendData);
        $('#lwLoadMoreButton').data('action', requestData.nextPageUrl);
        if (!requestData.hasMorePages) {
            $('.lw-load-more-container').hide();
        }
    }
// Show advance filter
$('#lwShowAdvanceFilterLink').on('click', function(e) {
    e.preventDefault();
    $('.lw-advance-filter-container').addClass('lw-expand-filter');
    $('#lwShowAdvanceFilterLink').hide();
    $('#lwHideAdvanceFilterLink').show();
    // $('.lw-advance-filter-container').show();
});
// Hide advance filter
$('#lwHideAdvanceFilterLink').on('click', function(e) {
    e.preventDefault();
    $('.lw-advance-filter-container').removeClass('lw-expand-filter');
    $('#lwShowAdvanceFilterLink').show();
    $('#lwHideAdvanceFilterLink').hide();
    // $('.lw-advance-filter-container').hide();
});

</script>


<!-- /Logout Modal-->

<script type="text/javascript">

$(".grid_block").click(function(){
  $("#grid_block").addClass("grid_active");
  $("#list_view").removeClass("list_active");
});
$(".listing").click(function(){
     $("#list_view").addClass("list_active");
  $("#grid_block").removeClass("grid_active");
 
});

    $(document).ready(
        function(){
            $(".event-filter").hide();
            $(".event-filter-button").click(function () {
                $(".event-filter").show("slow");
            });
            $("#filterSidebarClose").click(function () {
                $(".event-filter").hide("slow");
            });
        });
    </script>
    <script>
        $(document).ready(function() {

           jQuery('#paginateCountForm').change(function() {
            this.form.submit();
        });

           jQuery('#selected-short').change(function() {


             $(this).find('option').css('background-color', 'red');
             $(this).find('option:selected').css('background-color', 'red');

             this.form.submit();
         });

           

          //toggle the component with class accordion_body
          $(".accordion_head").click(function() {
              $(this).toggleClass("active");
              if ($('.accordion_body').is(':visible')) {
                  $(".accordion_body").slideUp(300);
                  $(".plusminus").text('+');
              }
              if ($(this).next(".accordion_body").is(':visible')) {
                  $(this).next(".accordion_body").slideUp(300);
                  $(this).children(".plusminus").text('+');
              } else {
                  $(this).next(".accordion_body").slideDown(300);
                  $(this).children(".plusminus").text('-');
              }
          });
      });



        $(".lw-like-action-btn, .lw-dislike-action-btn").on('click', function() {
            $('.lw-like-dislike-box').addClass("lw-disable-anchor-tag");
        });


        $(".lw-like-action-btn i").on('click', function() {

            if ($(this).hasClass("like_true")) {
              
               $(this).removeClass("like_true");
           }else{
             $(this).addClass("like_true");
         }

     });





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

    $('#searchTextField').hide();
    $(document).ready(function(){
      $('body').on('click','.locationFilterMap',function(){
          $('#searchTextField').show();
      });

      $('body').on('click','.filter-search-mobile',function(){
          $('#accordionSidebar').addClass('mobile_sidebar');
      });

      $('body').on('click','.close_button_filter',function(){
          $('#accordionSidebar').removeClass('mobile_sidebar');
      });

      $('body').on('click','.locationFilterCity',function(){
          $('#searchTextField').hide();
      });
  });



    $(document).ready(function() {


        // Save Serach
        $("body").on("submit", "#save-serach-form", function(e) {

            e.preventDefault();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

            $.ajax({
              type:'POST',
              url:"{{ url('save-serach') }}",
              dataType : 'json',
              data :  $('#save-serach-form').serialize(),
              success:function(response){

                  $('#overlay_search').fadeOut(300);
                  $('.show-recent-serach').append('<li class="list-item"><a href="'+response.data.url+'"> <span>'+response.data.name+'</span></a></li>');
              }

          });

        });

        // Delete Serach
        $("body").on("click", ".delete-save-serach", function(e) {

            e.preventDefault();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

            var serachId =  $(this).attr('current-search-id');

            $.ajax({
              type:'POST',
              url:"{{ url('delete-save-serach') }}",
              dataType : 'json',
              data:{id:serachId},
              success:function(response){

                  $('li[current-search-id="' + saveDeletedId +'"]').remove();
              }

          });

        });
    });

</script>
<script type="text/javascript">
  $(".red_box").click(function(){
      $(".red_box").removeClass("active_block");
      $(this).addClass("active_block");
  }); 
</script>

@endpush

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

@stop



