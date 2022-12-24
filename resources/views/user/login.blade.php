@section('page-title', __tr('Login'))
@section('head-title', __tr('Login'))
@section('keywordName', strip_tags(__tr('Login')))
@section('keyword', strip_tags(__tr('Login')))
@section('description', strip_tags(__tr('Login')))
@section('keywordDescription', strip_tags(__tr('Login')))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.header')
<!-- /include header -->
<body class="lw-login-register-page" style="background:#E1E1E1;">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9" >
                <div class="card o-hidden border-0 shadow-lg my-5" style="background-color:#fff">
                    <div class="card-body p-5">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <a href="{{ url('/') }}">
                                         <img class="lw-logo-img" src="{{ url('/') }}/media-storage/logo/logo.png" alt="<?= getStoreSettings('name') ?>">
                                     </a>
                                     <hr class="mt-4 mb-4">
                                     <h4 class="text-dark mb-4">Login to your account</h4>
                                     @if(session('errorStatus'))
                                     <!--  success message when email sent  -->
                                     <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?= session('message') ?>
                                    </div>
                                    <!--  /success message when email sent  -->
                                    @endif
                                </div>

                                <!-- login form -->
                                <form class="user lw-form userLoginForm" method="post" action="<?= route('user.login.process') ?>">
                                    @csrf
                                    <!-- email input field -->
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="email_or_username" aria-describedby="emailHelp" placeholder="<?= __tr( 'Enter Email Address or Username ...' ) ?>" required>
                                    </div>
                                    <!-- / email input field -->
                                    <!-- password input field -->
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="<?= __tr( 'Password' ) ?>" required minlength="6">
                                    </div>
                                    <!-- password input field -->
                                    <div class="form-group">
                                      <div class="rechpcha">

                                          <!-- {!! Captcha::display() !!} -->
                                      </div>
                                  </div>


                                  <!-- remember me input field -->
                                  <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="rememberMeCheckbox" name="remember_me">
                                        <label class="custom-control-label text-gray-200" for="rememberMeCheckbox"><?=  __tr( 'Remember Me' )  ?></label>
                                    </div>
                                </div>
                                <!-- remember me input field -->

                                <!-- login button -->
                                <button type="submit" value="Login" class="btn btn-primary btn-user btn-block"><?=  __tr( 'Login' )  ?></button>

                            </form>

                            <!-- / login form -->

                            <!-- forgot password button -->

                            <div class="text-center mt-3">

                                <a class="small" href="<?= route('user.forgot_password') ?>"><?=  __tr( 'Forgot Password?' )  ?></a>

                            </div>

                            <!-- / forgot password button -->

                            <hr class="mt-4 mb-3">

                            <!-- create account button -->

                            <div class="text-center">


                             <p><?= __tr("Don't have a Account Create New Its Free!!") ?></p>
                             <a class="btn btn-success" href="<?= route('user.sign_up') ?>"><?=  __tr( 'Create an Account!' )  ?></a>

                         </div>

                         <!-- / create account button -->

                     </div>

                 </div>

             </div>

         </div>

     </div>

 </div>

</div>

</div>

</body>
@push('appScripts')
<script>
//on login success callback
function onLoginCallback(response) {
    //check reaction code is 1 and intended url is not empty
    if (response.reaction == 1 && !_.isEmpty(response.data.intendedUrl)) {
        //redirect to intendedUrl location
        _.defer(function() {
            window.location.href = response.data.intendedUrl;
        })
    }
}



$(document).ready(function() {


    $("body").on("submit", ".userLoginForm", function(e) {

        e.preventDefault();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

        $.ajax({
          type:'POST',
          url:"{{ url('user/login-process') }}",
          dataType : 'json',
          data :  $('.userLoginForm').serialize(),
          success:function(successResponse){

            if(successResponse.show_message == 1){
                showSuccessMessage(successResponse.message);
                window.location.reload();
            } else if (successResponse.reaction == 2) {
                showWarnMessage(successResponse.message);
            } else {
                showErrorMessage(successResponse.message);
            }
        },error: function(response) {
           var r = jQuery.parseJSON(response.responseText);
           var errorData = r.errors;
           if(errorData['h-captcha-response'][0] !== 'undefined'){
               showErrorMessage(errorData['h-captcha-response'][0]);
           }
       }

   });

        return false;
    });



});

</script>
@endpush
<!-- include footer -->
@include('includes.footer')
    <!-- /include footer -->