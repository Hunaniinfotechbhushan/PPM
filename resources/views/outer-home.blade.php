<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PPM - Join Free | Originally at ppmarrangements.com</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

  <meta name="description" content="Log in to your PPM account and browse millions of attractive and established profiles. ppmarrangements.com">
  <link href="{{ asset('/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/frontend/css/ppm-custom.css') }}">
  <link rel="stylesheet" href="{{ asset('/frontend/js/bootstrap.min.js') }}">
  <link href="{{ asset('/frontend/style.css') }}" rel="stylesheet">
</head>

<body>

 <!-- desktop only -->


 <header id="header" class="Web-head">
   <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light justify-content-between ">
     <div class="d-flex align-items-center">
      <a class="navbar-brand" href="#"><img src="<?= getStoreSettings('logo_image_url') ?>" width="70px" alt="<?= getStoreSettings('name') ?>"></a>
      <a class="nav-link" href="#" style="color: #000;">How PPM Works<span class="sr-only">(current)</span></a>
    </div>

    <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">-->

      <!--  <span class="navbar-toggler-icon"></span>-->

      <!--</button>-->

      <div class=" align-items-center justify-content-between" id="navbarTogglerDemo01">



        <ul class="navbar-nav ">

          <li class="nav-item active">



          </li>

        </ul>

        <div class="button-group mobile-hide d-flex">
          @if(Auth::check())
          <a href="<?= url('search') ?>" class="web-btn login-btn"><?= __tr('My Account') ?></a>
          @else 
          <a href="<?= route('user.login') ?>" class="web-btn login-btn"><?= __tr('Login') ?></a>
          <a href="<?= route('user.sign_up') ?>" class="web-btn"><?= __tr('Join Free') ?></a>
          @endif 


        </div>

      </div>

    </nav>

  </div>

</header>

<!-- hero main banner -->
<section id="banner" class="banner ">
  <div class="container">
    <div class="row align-items-center">
     <div class=" col-lg-6 col-md-6 col-sm-12 ">
      <h1 class="banner-title">Find Your Perfect Pay <br>
      Per Meet Arrangements</h1>
      <p class="banner-dis mt-2">PPM dating creates a safer environment for attractive people who don’t want to get scammed by Salt Daddies and safer for Successful people who want straightforward, genuine, meeting arrangements</p>
      <p> <b>Signing up for PPM is safe, fast and free!</b></p>
      <a href="<?= route('user.sign_up') ?>">   <button class="web-btn"><?= __tr('Join Free') ?></button></a>
    </div>
    <div class=" col-lg-6 col-md-6 col-sm-12  text-center banner-right">
      <img src="{{url('/frontend/image/banner-image.png')}}" width="100%" class="banner-image">
    </div>
  </div>
</div>
</section>


<!-- S e c o n d -->

<section class="step">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 text-center">
        <img src="{{url('/frontend/image/join.png')}}" height="70px">
        <h4 class="box-title">Join</h4>
        <p>PPM is fast & easy to sign up.</p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 text-center">
        <img src="{{url('/frontend/image/compleat.png')}}" height="60px">
        <h4 class="box-title mt-4">Complete Your Profile</h4>
        <p>Add a photo and show what you have to  offer with your unique profile.</p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 text-center">
        <img src="{{url('/frontend/image/meet.png')}}" height="70px">
        <h4 class="box-title">Date</h4>
        <p>Enjoy a new arrangement with the partner you deserve.</p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->

<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 col-md-1 col-sm-12">
        <a class="navbar-brand" href="#"><img src="<?= getStoreSettings('logo_image_url') ?>" width="50px"></a>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
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
        <a class="navbar-brand" href="#"><img src="{{url('/frontend/image/fb.png')}}" width="20px"></a>
        <a class="navbar-brand" href="#"><img src="{{url('/frontend/image/insta.png')}}" width="20px"></a>
        <a class="navbar-brand" href="#"><img src="{{url('/frontend/image/twiter.png')}}" width="20px"></a>
      </div>
    </div>
  </div> 
</footer>

</body>

</html>