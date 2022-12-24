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
                   <h1 class="banner-title">Privacy Policy</h1>
                   <p class="banner-dis mt-2">Seeking.com (“Seeking”), which is operated by Reflex Media, Inc. (“Reflex”) and W8 Tech Cyprus (“W8 Cyprus”), respects your privacy. W8 Cyprus operates the Website in the European Union, the European Economic Area and the United Kingdom. Reflex operates the Website in all other applicable areas. We are committed to protecting the privacy of our users and we want to provide a safe and secure user experience. We will use our best efforts to ensure that the information you submit to us remains private and is used only for the purposes set forth herein. This policy details how data about you is collected, used, and shared when you access our websites and services or interact with us (collectively, the “Services”).</p>
                    <p>When you use the Services, you may be asked for certain personal information, including your name, email address, zip code, phone numbers, credit card information, occupation, hobbies and interests. Our website also automatically receives and records information on our server logs from your browser, including your IP address, browser type and Seeking Cookie (defined below) information. As previously stated, we are committed to providing you a safe and secure user environment. Therefore, before permitting you to use the Services, we may require additional information from you that we can use to verify your identity, address or other information or to manage risk and compliance throughout our relationship. We may also obtain information about you from third parties such as identity verification, fraud prevention, and similar services. Reflex and/or W8 Cyprus, collect data to operate effectively and provide better quality experiences. If you do not agree to our collection of the information, you may be limited or restricted in the Services available to you.</p>
                    <p>
                      When you utilize the Services, we—along with certain business partners and vendors—may use cookies and other tracking technologies (collectively, “Cookies”). We use Cookies as outlined in the “How Your Information Is Used Section.”   Certain aspects and features of the Services are only available through the use of Cookies, so if you choose to disable or decline Cookies, your use of the Services may be limited or not possible.
                    </p>


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