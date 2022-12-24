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
                             <form method="POST" id="login_form" action="{{ route('login') }}">
                        @csrf

                            <div class="col-lg-12">

                                <div class="p-5">

                                    <div class="text-center">

                                        <a href="{{ url('/') }}">

                                         <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
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
                                       

                                         <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" aria-describedby="emailHelp" placeholder="<?= __tr( 'Enter Email Address or Username ...' ) ?>" required>
                                    </div>
                                    <!-- / email input field -->

                                    <!-- password input field -->
                                    <div class="form-group">
                                         <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="<?= __tr( 'Password' ) ?>" required minlength="6">
                                    </div>
                                    <!-- password input field -->
                                    <div class="form-group">
                                      <div class="rechpcha">

                                          {!! Captcha::display() !!}
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
                    </form>

             </div>

         </div>

     </div>

 </div>

</div>

</div>

</body>
@push('appScripts')
<script>
 $("#login_form").submit(function(e){
         e.preventDefault();

        var all = $(this).serialize();

        $.ajax({
            url:  $(this).attr('action'),
            type: "POST",
            data: all,
            beforeSend:function(){
                $(document).find('error.error-text').text('');
            },
            //validate form with ajax. This will be communicating 
           
            success: function(data){
                if (data.status==0) {
                    $.each(data.error, function(prefix, val){
                        $('error.'+prefix+'_error').text(val[0]);
                    });
                }
               // redirect the user to [another page] if the 
                 
                if(data == 1){
                    window.location.replace(
                     
                    );
                }else if(data == 2){
                
                    $("#show_error").hide().html("Invalid login details");
                }

            }
            })

        });

</script>
@endpush
<!-- include footer -->
@include('includes.footer')
    <!-- /include footer -->