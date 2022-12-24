@extends('public-master')
@section('content')
<style type="text/css">
    .event .vister-profile-image {
    height: 200px;
    width: 400px;
    margin-top: 30px;
}
.event p.event-title {
    position: absolute;
    top: 12px;
    font-size: 18px;
    font-weight: 500;
    left: 12px;
}
.event p.user-name {
    margin-top: 2.5rem;
    font-size: 18px;
}
.ppm-new-numm {
    color: #0000ffa3;
}
.visitor-post-low {
    border-bottom: 2px solid #8080802e;
    padding-bottom: 7px;
}
num.ppm-new-numm::after {
    content: '';
    position: absolute;
    width: 145px;
    height: 2px;
    bottom: 11%;
    left: 38%;
    background: #6e707e42;
}
.visitor-box-blue {
    background-color: #e7e7e7;
    padding: 2rem;
}
button.btn.btn-lg-box1 {
    background: white;
    padding: 10px 55px 10px 55px;
    font-size: 18px;
    border-radius: 0;
    font-weight: 500;
}

button.btn.btn-lg-box1:hover {
    background: red;
    color: #ffff;
}
button.btn.btn-lg-box2 {
    background: red;
    padding: 10px 65px 10px 65px;
    font-size: 18px;
    border-radius: 0;
    font-weight: 500;
    color: #ffff;
}

button.btn.btn-lg-box2:hover {
    background: #ffff;
    color: #858796;
}

.event_icon {
    display: flex;
    justify-content: end;
    color: #fff;
    text-align: center;
}
.fa-magnifying-glass-plus:before, .fa-search-plus:before {
    content: "\f00e";
    background: gray;
    width: 35px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    margin-right: 10px;
}
.image_box_event a {
    text-decoration: none;
}
@media (max-width: 768px)
{
.fa-magnifying-glass-plus:before, .fa-search-plus:before {
    margin-top: 10px;
}
img.vister-profile-image1 {
    max-height: 335px;
}
}
@media (max-width: 375px)
{
#list_view .vister-profile-image {
height: 190px !important;
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



    <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

      @include('events.event-sidebar')

    <!-- Heading -->



  

 <!-- Heading -->
 <!-- <form action="" id="event-serach-form">
 <li class="nav-item justify-content-between text-left select-drop-down">
<input type="hidden" name="action" value ="filter">
     <p>Location</p>

     <div>
      <ul class="filter-ul" id="locationRd">
        <li class="locationFilterCity"> 
          <input type="radio" id ="" name ="" value="">
          <label for="city"> San Francisco, CA, USA</label>
        </li>
        <li class="locationFilterMap">
          <input type="radio" id="" name="" value="">
          <label for="city"> Other Locations</label><br> </li>        
        </ul>
        <input id="searchTextField" type="text" name="location" placeholder="Enter a location" autocomplete="on">
      </div>

 </li>


  

 <li class="nav-item justify-content-between text-left select-drop-down">

     <p>Meet Type</p>

     <select class="select-sidebar" name="meet_type">
        
        <option   value="Dinner/Lunch date">Dinner/Lunch date</option>
         <option value="Meet at your place">Meet at your place</option>
         <option value="Social meetup">Social meetup</option>
         <option value="Meet at my place">Meet at my place</option>
         <option value="Night out">Night out</option>
         <option value="Anything, anywhere">Anything, anywhere</option>
         <option value="Hotel meet">Hotel meet</option>
        <option value="Club meet">Club meet</option>

     </select>

 </li>

 <li class="nav-item justify-content-between text-left select-drop-down">

     <p>When</p>

      <select class="select-sidebar drop" name="created_at">

         <option value="">Any</option>

         

     </select>

 </li>

 <li class="nav-item justify-content-between text-left select-drop-down">
     <p>Profile</p>

     <select class="select-sidebar" name="title">

         <option>Jhone Deo, Honkin</option>

         <option value="Lumia Deni">Lumia Deni</option>

         <option value="">Lumia Deni</option>

     </select> -->
<!-- 
     <span class="d-flex justify-content-between align-items-center my-2"><button type="submit" class="web-button search-event-submit-btn">

         Search

     </button><p>Reset All</p></span>

 </li>
</form> -->

</ul>



<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column lw-page-bg">

    <div id="content">

        <!-- include top bar -->















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

                            Your credit balance is too low, please              <a href="user/credit-wallet">purchase credits</a>

                        </div>

                        <!-- / insufficient balance error message -->



                        <div class="text-center">



                            This will costs you             <span id="lwBoosterPrice">

                            0                </span>

                            credits for immediate               <span id="lwBoosterPeriod">

                            5               </span>

                        minutes         </div>

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
            <input type="text"  name="title" value='' / required>

        </div>
        <div class="form-group">
             <label class="event-label" for="display-name">Description </label>
           
            <textarea id="w3review" name="description" rows="4" cols="45">

            </textarea>

        </div>
        <div class="form-group">
             <label class="event-label" for="display-name">Location</label>
            <input type="text" name="location"   value='' / required>

        </div>
        <div class="form-group">
             <label class="event-label" for="display-name">Meet Type</label>
           <select class="select-sidebar" name="meet_type">
        
        <option   value="Dinner/Lunch date">Dinner/Lunch date</option>
         <option value="Meet at your place">Meet at your place</option>
         <option value="Social meetup">Social meetup</option>
         <option value="Meet at my place">Meet at my place</option>
         <option value="Night out">Night out</option>
         <option value="Anything, anywhere">Anything, anywhere</option>
         <option value="Hotel meet">Hotel meet</option>
        <option value="Club meet">Club meet</option>

     </select>

        </div>
                      
        <!-- <div class="form-group mt-3 file-uploader-main p-0">
            <input id='userUploadPublicPhottoButton' name="image" type='file' hidden/>
            <input type='file' id='userPublicUploadFileButtons' name="image" class="action-button w-100 " type='button' value='Add a public photo' />
            <p class="uploader-txt mb-0 d-flex align-items-center justify-content-center h-100">upload <i class="fas fa-upload ml-3"></i></p>
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

                            Are you sure you want to delete your account? All content including photos and other data will be permanently removed!                    <!-- /Delete Message -->

                            <hr/>

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

            <div class="card mb-3 ">

                <div class="card-header d-flex justify-content-between">

                   <h3><i class="fa-solid fa-photo-film"></i>Event</h3>

                   <div class="d-flex"> 

                    <button  data-toggle="modal" data-target="#addEventPopup" class="web-button">Add Event</button>

                 </div>

             </div>

         </div>

         <div class="mb-3 d-md-none">

            <div class="card-header d-flex justify-content-between">

               <h3><i class="fa-solid fa-filter"></i></h3>

               <div class="d-flex"> 

                   <button  id="show_filtermobile" class="web-button event-filter-button">

                     Filter

                 </button>

             </div>

         </div>

     </div>

      <div class="card mb-3 d-md-none event-filter" style="display: none;">

        <div class="card-header">

         <ul class="mobile-filter">
            <li><a class="btn FormFooter-rightLink u-hide--tablet-up js-toggleSidebarBtn css-157uzvc" id="filterSidebarClose"><svg viewBox="0 0 24 24" fill="black" width="24px" height="24px"><g fill="#949494"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></g></svg></a></li>
           <!--  <li class="nav-item ">

             <select class="select-sidebar">

                 <option>Saved Searchs & Option</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

             <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

                 Load More

             </button><p>Reset All</p></span>

         </li> -->

         <!-- Heading -->


  @include('events.event-sidebar')
     </ul>

 </div>

</div>

</div>

<?php 
$userAge='';
if(isset($event->dob)){
    $dob = $event->dob;
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        $userAge =  $age;
    }else{
        $userAge = 0;
    }
}
?>

<div class="event d-flex justify-content-between pb-3 py-2 p-main">
 <div class="w-100 img-about d-flex align-items-flex-start">

    <div class="w-100">
<?php


 if($event->profile_picture){
    $imgURL = url('/').'/media-storage/users/'.$event->UID.'/'.$event->profile_picture;

 }else{
  
      $imgURL = url('/').'/imgs/default-image.png';
 } 
       ?> 

       
      <div class="image_box_event">  




             <a href="{{ $imgURL }}" class="glightbox4">
             <img class="vister-profile-image1" src="{{$imgURL }}" class="lw-user-thumbnail lw-lazy-img">
           <i class="fa-solid fa-magnifying-glass-plus event_icon"></i></div>

             </a>

             

     <p class="adress text-dark user-age bg-light"><b>{{$event->title}}</b> - <b class="border rounded user-age">{{ $userAge }}</b></p>
     <?php $date = date( 'D, M d', strtotime( $event->created_at) );?>
    <p class="text-dark d-flex justify-content-end visitor-post-low"><b>Posted</b>:&nbsp;&nbsp;<span class="text-gray-500">{{$date}}</span></p>
     <p class="pt-3 pb-3">{{ $event->description }}</p>
     <div class="year_age d-flex">
        <p class="text_num">
            <span class="text-pop position-relative">{{ $event->city }}</span>
            <span class="text_age me-auto">Age {{ $userAge }} Years</span></p>

         
     </div>
    
  <!--    <div class="age-para">
         <num class="ppm-new-numm mt-5"></num> 
        <p class="numm">024358299190 <span class="d-flex justify-content-end pb-5">Age 27 years</span></p>
     </div> -->
    
      <div class="visitor-box-blue d-flex justify-content-center mt-3">
        <!-- <button type="button" class="btn btn-lg-box1">Contact</button> -->
        <button type="button" data-id-ins="{{ $event->_id }}" class="btn btn-lg-box2 intersted_user">I’m interested</button>
    </div>

       <div class="visitor-box-blue d-flex bg-white px-3">
        <!-- <button type="button" class="btn btn-lg-box1">Contact</button> -->
       <span>Advertiser :</span> <strong class="ml-2">{{ $event->username }}</strong>
    </div>

    </div>
    <div>
 </div>
</div>
<div class="time text-right" style="width:20%;">
 <!-- <p>10 mint Ago</p> -->
</div>

</div>













<!-- /User Specifications -->



</div>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>
<script type="text/javascript">
    
     $(document).ready(function() {


         $("#filterSidebarClose").click(function(){

          $('.event-filter').hide();
     
    
    });

     $("#show_filtermobile").click(function(){

          $('.event-filter').show();
     
    
    });
    

    $('.search-event-submit-btn').click(function() {


      $('#event-serach-form').submit()
    });

    $('#searchTextField').hide();
    $('body').on('click','.locationFilterMap',function(){
  $('#searchTextField').show();
  });
  });


  function initialize() {
   var input = document.getElementById('searchTextField');
   var autocomplete = new google.maps.places.Autocomplete(input);
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
      type:'POST',
      url:"{{ url('event-add') }}",
      dataType : 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success:function(response){
    //showSuccessMessage("Updated Successfully");
        if(response.status== 'success'){
             showSuccessMessage("Updated Successfully");

             setInterval(function () {
       window.location.href = "{{ url('events') }}";
    },1000);
            
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


// $("body").on("submit", ".userPhottoFormEvent", function(e) {

    $( ".intersted_user" ).click(function(e) {
        

           var event_id =  $(this).attr('data-id-ins');
   

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $.ajax({
      type:'POST',
      url:"{{ url('interested-user') }}",
      dataType : 'json',
      data: {event_id:event_id},
     
      success:function(response){
    //showSuccessMessage("Updated Successfully");
        if(response.status== 'success'){
             showSuccessMessage("Thanks for interested.");

    //          setInterval(function () {
    //    window.location.href = "{{ url('events') }}";
    // },1000);
            
        }
         //
    // console.log(response.data.stored_photo.image_url);
   

}

});

    return false;
});

</script>

@stop
