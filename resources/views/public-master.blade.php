<!-- include header -->
@include('includes.header')

<style type="text/css">
   .alert-warning-email-verfy {
    color: #111110;
    background-color: #e7e7e7;
    border-color: #e7e7e7;
}
.verify-email-text {
    color: #e74a3b;
}
.fa.fa-exclamation-triangle.verify-icon {
   color: #e74a3b;
}
</style>

   @if(str_contains(url()->current(), '/member/'))
  <?php $isMemberPage = "member-page";?>
  @else
    <?php $isMemberPage = "";?>
    @endif

<!-- /include header -->
<body id="page-top" class="lw-page-bg lw-public-master {{ $isMemberPage }}">

   <!-- Page Wrapper -->

   <div class="container-fluid px-3">

    <!-- Topbar -->
    @if(isLoggedIn())
    @include('includes.public-top-bar')
    @endif



      @if(Auth::user()->is_email_verified == 0)
<div class="Panel css-isesu">
<div class="alert alert-warning-email-verfy" role="alert">   
 <h4><i class="fa fa-exclamation-triangle verify-icon" aria-hidden="true"></i> Verify Your Email!</h4>
 <p>An email verification was sent to  <span class="verify-email-text">{{ Auth::user()->email }}</span>. Please check your inbox or junk to verify.</p>
 <p><span> If the email address is incorrect please <a href="{{ url('/settings') }}" class="verify-email-text">click here to edit.</a></span></p>
</div>
</div>
 @endif


     @if(Auth::user()->is_verified == 0)
<div class="Panel css-isesu">
<div class="alert alert-warning" role="alert">   
 Your account is under process and will be settled shortly. 
</div>
</div>
 @endif

 <?php $userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id',Auth::user()->_id)->first();
    $chatMessages = \App\Exp\Components\Messenger\Models\ChatModel::where('to_users__id',Auth::user()->_id)->where('is_read',0)->count();
    ?>

</div>

<div class="bottom-bar-mobile">

    <ul class="d-flex justify-content-between">

       <li @if(Request::is('/')) class="active" @endif><i class="fa-solid fa-house"></i><a href="{{url('/home') }}">Home</a></li>

       <li @if(Request::is('search')) class="active" @endif><i class="fa-solid fa-magnifying-glass"></i><a href="{{url('/search') }}">Search</a></li>

           <li @if(Request::is('updates')) class="active" @endif><i class="fa-solid fa-star"></i><a href="{{ url('updates') }}">Updates</a></li>

        <li @if(Request::is('events')) class="active" @endif><i class="fa-solid fa-photo-film"></i><a href="{{ url('events') }}">Meets</a></li>
        <li @if(Request::is('messenger')) class="active" @endif><i class="fa-solid fa-comment-dots"></i><span class="badge badge-danger badge-counter" >{{ isset($chatMessages) ? $chatMessages : '' }}</span><a href="{{ url('messenger') }}">  Message</a></li>


   </ul>

</div>

<div id="wrapper" class="container-fluid">
    <!-- include sidebar -->
 @if(isLoggedIn())
    
     @if(Request::is('settings'))
   
    @include('includes.setting-sidebar')
  
    @elseif(Request::is('@'.Auth::user()->username))
        @include('includes.public-sidebar')
    
     @elseif(str_contains(url()->current(), '/member/'))
     @include('includes.member-sidebar')
   
    @else
   
    @endif
  @endif

   @if(Request::is('search'))
<?php $pageId = "search"; ?>
  @else
  <?php $pageId = Route::current()->getName(); ?>
  @endif

    <!-- Content Wrapper -->

    <div id="content-wrapper" class="d-flex flex-column lw-page-bg ml-2 {{ $pageId }}-page">

        <div id="content">

            <!-- include top bar -->



      @yield('content')


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



            <!-- /.container-fluid -->

        </div>

    </div>

     @if(isLoggedIn())
    @if(Request::is('search'))
   
    @include('includes.search-sidebar')
    @endif
    @endif

    <!-- End of Content Wrapper -->

</div>

<!-- End of Page Wrapper -->

<!-- include footer -->

@if(Auth::user()->is_verified == 0)
    <script type="text/javascript"> 
    // alert();
</script>
@endif
@include('includes.footer')
<!-- /include footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- /Scroll to Top Button-->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?= __tr('Ready to Leave?') ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <?= __tr('Select "Logout" below if you are ready to end your current session.') ?>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?= __tr('Not now') ?></button>
            <a class="btn btn-primary" href="<?= route('user.logout') ?>"><?= __tr('Logout') ?></a>
        </div>
    </div>
</div>
</div>
<!-- /Logout Modal-->


<!-- Footer -->

<footer>

  <div class="container">

    <div class="row">

      <div class="col-lg-1 col-md-1 col-sm-12 upper-footer">

          <a class="sidebar-brand d-flex align-items-center" href="home">

            <div class="sidebar-brand-icon">

                <img class="lw-logo-img" src="{{ url('/') }}/media-storage/logo/logo.png" alt="PPM">

            </div>

            <img width="100%" src="<?= getStoreSettings('logo_image_url') ?>" alt="PPM-user">

            <img class="lw-logo-img d-sm-block d-md-none" src="{{ url('/') }}/media-storage/logo/logo.png" alt="PPM">

        </a>

    </div>

    <div class="col-lg-8 col-md-8 col-sm-12 middle-footer">

        <ul class="footer-menu">

            <li class="footer-item">

              <a class="footer-link" href="#">Company</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Career</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Press</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Contact</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Investors</a>

          </li>

      </ul>

  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 icon-group ">

    <a class="navbar-brand" href="#"><i class="fa-brands fa-facebook"></i></a>

    <a class="navbar-brand" href="#"><i class="fa-brands fa-instagram-square"></i></a>

    <a class="navbar-brand" href="#"><i class="fa-brands fa-twitter-square"></i></a>

</div>

</div>

</div> 

</footer>

<!-- End of Footer -->

</body>
</html>