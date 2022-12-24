<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= getStoreSettings('name') ?></title>

      <link rel="shortcut icon" href="<?= __yesset('public/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= __yesset('public/favicon.ico') ?>" type="image/x-icon">

        <?= __yesset([
            'public/frontend/css/bootstrap.min.css',
            'public/frontend/style.css',
            'public/frontend/css/ppm-custom.css',
      'public/frontend/js/bootstrap.min.js'
    ], true) ?>
 </head>

<body>

 <!-- desktop only -->


   <header id="header" class="Web-head">

     <div class="container">

      <nav class="navbar navbar-expand-lg navbar-light justify-content-between ">

       <div class="d-flex align-items-center">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="<?= getStoreSettings('logo_image_url') ?>" width="70px" alt="<?= getStoreSettings('name') ?>"></a>
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

            <a href="<?= route('user.login') ?>" class="web-btn login-btn"><?= __tr('Login') ?></a>
             <a href="<?= route('user.sign_up') ?>" class="web-btn"><?= __tr('Join Free') ?></a>

         </div>

        </div>

      </nav>

     </div>

  </header>
<!-- hero main banner -->
<div class="textt">
<section class="red_bg"></section>
<section class="p-0" id="contact_ppm">
    <div class="container">
        <div class="position-relative">
        <div class="custom-bg">
            <div class="row">
                <div class="col-md-12">
                   <h1 class="banner-title">Terms of Use</h1>
                   <p class="banner-dis mt-2">Effective Date: October 12, 2021

                            By accessing the Seeking.com website (the “Website” or “Seeking”), including through a mobile application, you (the “User”, “Member”, or “You”) agree to be bound by this Terms of Use agreement (the “Agreement”) and the Privacy Policy, which is available here. You agree that you are bound by this Agreement and the Privacy Policy, whether or not You register as a Member of the Website. The Website is operated by Reflex Media, Inc. (“Reflex,” “Reflex Media” or the “Company”) and its affiliated companies (as defined immediately below). If You wish to visit the Website or to become a Member and make use of the Seeking service (the “Service”), please read this Agreement. You are required to accept this Agreement to access and use the Website. This Agreement is in English. You should not rely on any non-English translation of this Agreement. Refer to this Agreement in English in the event of any discrepancies or inconsistencies. The summaries of the Agreement’s provisions contained herein are solely for informational purposes, and these summaries are not formally part of the Agreement and do not having biding legal effect.

Summary: This Agreement is between You and Reflex Media and is required before You can use the site and the Service. English is the official language of this Agreement. This summary, and the other summaries, are to help you understand the Agreement and aren’t part of the Agreement itself. <a href="#">FAQ</a> first.
                    <br>Can’t find your answer?<br> Contact support here.
                    Or email us at<a href="#"> Support@ppm.com</a></p>
                </div>
               
            </div>
           
          
        </div>
    </div>
    </div>
</section>
</div>
<!-- Footer -->



<!--<footer>-->

<!--  <div class="container">-->

<!--    <div class="row">-->

<!--      <div class="col-lg-1 col-md-1 col-sm-12">-->

<!--        <a class="navbar-brand" href="#"><img src="./image/logo.png" width="50px"></a>-->

<!--      </div>-->

<!--      <div class="col-lg-8 col-md-8 col-sm-12">-->

<!--        <ul class="footer-menu">-->

<!--            <li class="footer-item">-->

<!--              <a class="footer-link" href="#">Company</a>-->

<!--            </li>-->

<!--             <li class="footer-item">-->

<!--              <a class="footer-link" href="#">Career</a>-->

<!--            </li>-->

<!--             <li class="footer-item">-->

<!--              <a class="footer-link" href="#">Press</a>-->

<!--            </li>-->

<!--             <li class="footer-item">-->

<!--              <a class="footer-link" href="#">Contact</a>-->

<!--            </li>-->

<!--             <li class="footer-item">-->

<!--              <a class="footer-link" href="#">Investors</a>-->

<!--            </li>-->

<!--          </ul>-->

<!--      </div>-->

<!--      <div class="col-lg-3 col-md-3 col-sm-12 icon-group ">-->

<!--        <a class="navbar-brand" href="#"><img src="./image/fb.png" width="20px"></a>-->

<!--        <a class="navbar-brand" href="#"><img src="./image/insta.png" width="20px"></a>-->

<!--        <a class="navbar-brand" href="#"><img src="./image/twiter.png" width="20px"></a>-->

<!--      </div>-->

<!--    </div>-->

<!--  </div> -->

<!--</footer>-->

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
        <a class="navbar-brand" href="#"><img src="<?= asset('public/frontend/image/fb.png') ?>" width="20px"></a>
        <a class="navbar-brand" href="#"><img src="<?= asset('public/frontend/image/insta.png') ?>" width="20px"></a>
        <a class="navbar-brand" href="#"><img src="<?= asset('public/frontend/image/twiter.png') ?>" width="20px"></a>
      </div>
    </div>
  </div> 
</footer>

</body>

</html>