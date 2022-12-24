@extends('public-master')
@section('content')

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
    .event p.user-name {
        margin-top: 2.5rem;
        font-size: 18px;
    }

    .filter-ul li {
        list-style: none;
    }
    @media (max-width: 767px)
    {
      .time text-right
      {
        width:21%;
    }
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

<div class="form-group file-uploader-main mt-3">
    <input id='userUploadPublicPhottoButton' name="image" type='file' hidden/>
    <input type='file' id='userPublicUploadFileButtons' name="image" class="action-button" type='button' value='Add a public photo' />
    <p class="uploader-txt mb-0 d-flex align-items-center justify-content-center h-100 ">upload <i class="fas fa-upload"></i></p>
     <div class="uploaded-img">
         <img id="blah" src="" >
     </div>


</div>




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



   <ul class="mobile-filter">
    <li><a class="btn FormFooter-rightLink u-hide--tablet-up js-toggleSidebarBtn css-157uzvc" id="filterSidebarClose">
        <svg viewBox="0 0 24 24" fill="black" width="24px" height="24px"><g fill="#949494"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></g></svg></a></li>
          


   @include('events.event-sidebar')




</ul>

</div>

</div>





@if(!__isEmpty($events))

<?php //echo "<pre>"; print_r($events); die();?>
@foreach($events as $event)

<?php  $imgURL = url('/').'/media-storage/events/'.$event->image; ?>


<div class="event d-flex justify-content-between pb-3 py-2">
   <p class="event-title">{{ isset($event->title) ? $event->title : '' }}</p>


   <div class="img-about d-flex align-items-flex-start">
    <div class="vister-image-icon">

        <img class="vister-profile-image" src="{{$imgURL}}" class="lw-user-thumbnail lw-lazy-img">

    </div>

    <div>



       <p class="user-name">{{$event->meet_type }}</p>

       <p class=" adress text-gray-600">{{ isset($event->location) ? $event->location : '' }}</p>
       <?php $description = substr($event->description, 0, 150) . '...'; ?>
       <p>{{$description }} </p>
       <?php $date = date( 'D, M d', strtotime( $event->created_at) );;?>
       <p class=" adress text-gray-600">{{$event->location}}, {{$date}}</p>

       <p class="text-right"><a href="<?= route('user.view.events') ?>/?id={{$event->_id}}" class="send">View More</a></p>

   </div>

</div>

<div class="time text-right" style="width:20%;">

   <!-- <p>10 mint Ago</p> -->



</div>

</div>
@endforeach
@else

<div class="col-sm-12 alert alert-info">
    <?= __tr('There are no matches found.') ?>
</div>

@endif









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
  $(document).ready(function(){


    
    $("#filterSidebarClose").click(function(){

      $('.event-filter').hide();
      
      
  });

    $("#show_filtermobile").click(function(){

      $('.event-filter').show();
      
      
  });
    
    $("#locationRd li").click(function(){
       
       
      $('.serarh_location').show();
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


@stop
