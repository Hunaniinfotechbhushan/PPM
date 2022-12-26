<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\User\Controllers;

use App\Exp\Base\BaseController;
use Illuminate\Http\Request;
use App\Exp\Components\User\Requests\{
    UserSignUpRequest, 
    UserLoginRequest, 
    UserUpdatePasswordRequest,
    UserForgotPasswordRequest,
    UserResetPasswordRequest,
    UserChangeEmailRequest,
    SendUserGiftRequest,
    ReportUserRequest,
    UserContactRequest
};
use App\Exp\Components\User\UserEngine;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\User\Models\SocialConnect;
use Illuminate\Support\Facades\Validator;

use App\Exp\Support\CommonUnsecuredPostRequest;
use Auth;
use Mail;
use Socialite;
use URL;
use GuzzleHttp\Client;
use Exception;
use App\Exp\Components\UserSetting\Models\UserSettingModel;
use Carbon\Carbon;
use DateTime;

class UserController extends BaseController
{
    /**
     * @var UserEngine - User Engine
     */
    protected $userEngine;

    /**
     * Constructor.
     *
     * @param UserEngine $userEngine - User Engine
     *-----------------------------------------------------------------------*/
    public function __construct(UserEngine $userEngine)
    {
        $this->userEngine = $userEngine;
    }

    public function sitemap()
    {

       $route = url('/');

       return response()->view('sitemap.index', [
        'routes' => $route,
    ])->header('Content-Type', 'text/xml');
   }

   function doLogin(Request $request)
   {

    $validator = Validator::make($request->all(), [
            'email_or_username' => 'required|email',   // required and email format validation
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {


          echo json_encode(array("show_message"=>3,"message"=>$validator->errors()));

      } else {

       $processReaction = $this->userEngine->processLogin($request->all());

       $loginCredentials = [
        'email'         => $request->email_or_username,
        'password'      => $request->password,
    ];


            //validations are passed try login using laravel auth attemp
    if (\Auth::attempt($loginCredentials)){
        return response()->json(array("show_message"=>1,"message"=>'Welcome, you are logged in successfully'));

    } else {
        return response()->json([["Invalid credentials"]],422);

    }
}
}

public function mail()
{

    $data = [
      'subject' => "test",
      'email' => 'webtest41@gmail.conm',
      'content' => "test"
  ];

  Mail::send('email-template', $data, function($message) use ($data) {
      $message->to($data['email'])
      ->subject($data['subject']);
  });
  die('done');
       // return back()->with(['message' => 'Email successfully sent!']);
}

public function redirectToInstagramProvider()
{
    $appId = config('services.instagram.client_id');
    $redirectUri = urlencode(config('services.instagram.redirect'));
    return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
}
// instagram

public function instagramProviderCallback(Request $request)
{
    $code = $request->code;
    if (empty($code)) return redirect()->route('home')->with('error', 'Failed to login with Instagram.');

    $appId = config('services.instagram.client_id');
    $secret = config('services.instagram.client_secret');
    $redirectUri = config('services.instagram.redirect');

    $client = new Client();

    // Get access token
    $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
        'form_params' => [
            'app_id' => $appId,
            'app_secret' => $secret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectUri,
            'code' => $code,
        ]
    ]);

    if ($response->getStatusCode() != 200) {
        return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
    }

    $content = $response->getBody()->getContents();
    $content = json_decode($content);

    $accessToken = $content->access_token;
    $userId = $content->user_id;

    // Get user info
    $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");

    $content = $response->getBody()->getContents();
    $oAuth = json_decode($content);

    $finduser = SocialConnect::where('user_id', Auth::id())->where('social_type', 'instagram')->first();
    $id = Auth::id();

    if($finduser){          

        return redirect('/settings?verifications=social');

    }else{
        $newUser = SocialConnect::create([
            'name' => $oAuth->username,
            'email' => '',
            'social_id'=> $oAuth->id,
            'user_id'=> $id,
            '_uid'   => '',
            'social_type'=> 'instagram',
            'status' => '1'

        ]);


        return redirect('/settings?verifications=social');
    }

}

public function redirectToLinkedin()
{
    return Socialite::driver('linkedin')->redirect();
}


public function handleCallback()
{
    try {

        $user = Socialite::driver('linkedin')->user();
        $finduser = SocialConnect::where('user_id', Auth::id())->where('social_type', 'linkedin')->first();
        $id = Auth::id();

        if($finduser){          

            return redirect('/settings?verifications=social');

        }else{
            $newUser = SocialConnect::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id'=> $user->id,
                'user_id'=> $id,
                '_uid'   => '',
                'social_type'=> 'linkedin',
                'status' => '1'

            ]);


            return redirect('/settings?verifications=social');
        }

    } catch (Exception $e) {
        dd($e->getMessage());
    }
}

    /**
     * Show login view.
     *---------------------------------------------------------------- */
    public function login()
    {
        return $this->loadView('user.login');
    }
    
    /**
     * Authenticate user based on post form data.
     *
     * @param object UserLoginRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function loginProcess(UserLoginRequest $request)
    {

        $processReaction = $this->userEngine->processLogin($request->all());

        // check reaction code equal to 1
        if ($processReaction['data']['show_message'] == 1 && $processReaction['reaction_code'] == 1) {
          // echo json_encode(array("show_message"=>1,"message"=>$processReaction['message']));
          return response()->json(array("show_message"=>1,"message"=>$processReaction['message']));

      }elseif ($processReaction['data']['show_message'] == 1 && $processReaction['reaction_code'] == 2) {
          return response()->json(array("show_message"=>2,"message"=>$processReaction['message']));
          // echo json_encode(array("show_message"=>2,"message"=>$processReaction['message']));
      } else {
          return response()->json(array("show_message"=>3,"message"=>$processReaction['message']));
        // echo json_encode(array("show_message"=>3,"message"=>$processReaction['message']));
      }
  }

    /**
     * Perform user logout action.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function logout()
    {
        $processReaction = $this->userEngine->processLogout();

        return redirect()->route('user.login');
    }

    /**
     * Show Sign Up View.
     *
     *-----------------------------------------------------------------------*/
    public function signUp()
    {
        return $this->loadView('user.sign-up', [
        	'genders' => configItem('user_settings.gender')
        ]);
    }
    
    /**
     * User Sign Process.
     *
     * @param object UserSignUpRequest $request
     * 
     *-----------------------------------------------------------------------*/

    public function calcutateAge($dob)
    {

        $dob = date("Y-m-d", strtotime($dob));

        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();

        $diff = $dobObject->diff($nowObject);

        return $diff->y;

    }

    public function signUpProcess(UserSignUpRequest $request)
    {

        if(isset($request->email) && isset($request->dob)){

            if (Carbon::parse($request->dob)->age < 18) {
              return response()->json(array("show_message"=>3,"message"=>'You are under 18+'));
        }


            $checkEmailExits = User::where('email',$request->email)->first();
            if (!__isEmpty($checkEmailExits)) {
                return response()->json(array("show_message"=>3,"message"=>'Email already exists'));
            }
        $processReaction = $this->userEngine->userSignUpProcess($request->all());
        if ($processReaction['data']['show_message'] == 1 && $processReaction['reaction_code'] == 1) {

        return response()->json(array("show_message"=>1,"message"=>$processReaction['message']));

          }elseif ($processReaction['data']['show_message'] == 1 && $processReaction['reaction_code'] == 2) {
              return response()->json(array("show_message"=>2,"message"=>$processReaction['message']));
          // echo json_encode(array("show_message"=>2,"message"=>$processReaction['message']));
          } else {
              return response()->json(array("show_message"=>3,"message"=>$processReaction['message']));
        // echo json_encode(array("show_message"=>3,"message"=>$processReaction['message']));
          }
      }else{
          return response()->json(array("show_message"=>3,"message"=>'All Input filed is reqired'));

       // echo json_encode(array("show_message"=>3,"message"=>'All Input filed is reqired'));
      }

		//check reaction code is 1 then redirect to login page
       //  if ($processReaction['reaction_code'] === 1) {
       //     return $this->responseAction(
       //      $this->processResponse($processReaction, [], [], true),
       //      $this->redirectTo('user.login')
       //  );
       // } else {
       //     return $this->responseAction(
       //      $this->processResponse($processReaction, [], [], true)
       //  );
       // }
  }

    /**
     * Show Change Password View.
     *
     *-----------------------------------------------------------------------*/
    public function changePasswordView()
    {
      $user = Auth::user();
      $data = [];
      if ($user->password == 'NO_PASSWORD') {
       $data = [
        'userPassword' => $user->password
    ];
}
return $this->loadPublicView('user.change-password', $data);
}

    /**
     * Handle change password request.
     *
     * @param object UserUpdatePasswordRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processChangePassword(UserUpdatePasswordRequest $request)
    {
        $processReaction = $this->userEngine
        ->processUpdatePassword(
            $request->only(
                'new_password',
                'current_password'
            )
        );
        
        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

    /**
     * Show Change Email View.
     *
     *-----------------------------------------------------------------------*/
    public function changeEmailView()
    {
        $user = Auth::user();
        $data = [
            'userEmail' => $user->email
        ];
        return $this->loadPublicView('user.change-email', $data);
    }

    /**
     * Handle change email request.
     *
     * @param object UserChangeEmailRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processChangeEmail(UserChangeEmailRequest $request)
    {
        $processReaction = $this->userEngine
        ->processChangeEmail(
            $request->only(
                'new_email',
                'current_password'
            )
        );

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }
    
    /**
     * Show Forgot Password View.
     *
     *-----------------------------------------------------------------------*/
    public function forgotPasswordView()
    {
        return $this->loadView('user.forgot-password');
    }

     /**
     * Handle user forgot password request.
     *
     * @param object UserForgotPasswordRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */
     public function processForgotPassword(UserForgotPasswordRequest $request)
     {
        $processReaction = $this->userEngine
        ->sendPasswordReminder(
            $request->input('email')
        );

        //check reaction code equal to 1
        if ($processReaction['reaction_code'] === 1) {
            return $this->responseAction(
                $this->processResponse($processReaction, [], [], true),
                $this->replaceView('user.forgot-password-success', [], '.lw-success-message')
            );
        } else {
            return $this->responseAction(
                $this->processResponse($processReaction, [], [], true)
            );
        }
    }

    /**
     * User Sign Process.
     *
     *-----------------------------------------------------------------------*/
    public function accountActivation($userUid)
    {
        
        
       
        $processReaction = $this->userEngine->processAccountActivation($userUid);
        
        // Check if account activation process succeed
        if ($processReaction['reaction_code'] === 1) {
            return redirect()->route('user.login')
            ->with([
                'success' => 'true',
                'message' => __tr('Your account has been activated successfully. Login with your email ID and password.'),
            ]);
        }

        // if activation process failed then
        return redirect()->route('user.login')
        ->with([
            'error' => 'true',
            'message' => __tr('Account Activation link invalid.'),
        ]);
    }
    /**
     * 
     * Verify Account
     * 
     * --------------------------------------------*/


    


     public function verify_account(Request $request)
    {
     

    if($request->token){
        
        $TokenData = User::where('verify_token',$request->token)->where('is_email_verified',0)->first();
            if($TokenData){
                $statusUpdate = User::find($TokenData['_id']);
                $statusUpdate->is_email_verified = 1;


                $statusUpdate->save(); 
              
                return redirect()->route('user.login')
            ->with([
                'success' => 'true',
                'message' => __tr('Your account has been activated successfully. Login with your email ID and password.'),
            ]);
        
            }

             return redirect()->route('user.login')
            ->with([
                'success' => 'true',
                'message' => __tr('Your account has been already activated  Login with your email ID and password.'),
            ]);
        }
    }

	/**
     * User Sign Process.
     *
     *-----------------------------------------------------------------------*/
    public function newEmailActivation(Request $request, $userUid, $newEmail)
    {  
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $processReaction = $this->userEngine->processNewEmailActivation($userUid, $newEmail);
        
        // Check if account activation process succeed
        if ($processReaction['reaction_code'] === 1) {
           return redirect()->route('user.new_email.read.success')->with([
            'success' => true,
            'message' => __tr('Your new email activated successfully.'),
        ]);
       }
        // if activation process failed then
       return redirect()->route('user.new_email.read.success')->with([
        'success' => false,
        'message' => __tr('Email not updated.'),
    ]);
   }

	/**
     * User Sign Process.
     *
     *-----------------------------------------------------------------------*/
    public function updateEmailSuccessView()
    { 
      return $this->loadPublicView('user.change-email-success');
  }

    /**
     * Show Reset Password View.
     *
     *-----------------------------------------------------------------------*/
    public function restPasswordView()
    {
        return $this->loadManageView('user.reset-password');
    }

     /**
     * Handle reset password request.
     *
     * @param object UserResetPasswordRequest $request
     * @param string                          $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
     public function processRestPassword(UserResetPasswordRequest $request,
        $reminderToken)
     {
        $processReaction = $this->userEngine
        ->processResetPassword(
            $request->all(),
            $reminderToken
        );

        //check reaction code equal to 1
        if ($processReaction['reaction_code'] === 1) {
            return $this->responseAction(
                $this->processResponse($processReaction, [], [], true),
                $this->redirectTo('user.login')
            );
        } else {
            return $this->responseAction(
                $this->processResponse($processReaction, [], [], true)
            );
        }
    }

    /**
     * Get User profile view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function userProfileSkip()
    {
      $dataForStoreOrUpdate[] = [
         'key_name'      => 'skip_profile',
         'value'        => 1,
         'data_type'    => 1,
         'users__id'    => getUserID()
     ];

     UserSettingModel::bunchInsertUpdate($dataForStoreOrUpdate, '_id');

     return redirect()->route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]);
 }

 public function getUserProfile($userName)
 {
    $processReaction = $this->userEngine->prepareUserProfile($userName);
    // return $processReaction;
        // check if record does not exists
    if ($processReaction['reaction_code'] == 18) {
        return redirect()->route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]);
    }
    $processReaction['data']['is_profile_page'] = true;

    return $this->loadPublicView('user.profile', $processReaction['data']);
}

    /**
     * Get User profile view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getUserProfileData($userName)
    {
        $processReaction = $this->userEngine->prepareUserProfile($userName);
        
        return $this->processResponse($processReaction, [], [], true);
    }

	/**
     * Handle user like dislike request.
     *
     * @param object UserResetPasswordRequest $request
     * @param string                          $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function userLikeDislike($toUserUid, $like)
    {
        $processReaction = $this->userEngine->processUserLikeDislike($toUserUid, $like);

        //check reaction code equal to 1
        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * Get User my like view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getMyLikeView()
    {
    	//get page requested
    	$page = request()->input('page');
		//get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareUserLikeDislikedData(1);

        //check if page is not null and not equal to first page
        if (!is_null($page) and ($page != 1)) {

        	$processReaction['data'] = view('user.partial-templates.my-liked-users', $processReaction['data'])
         ->render();

         return $processReaction;
     }

    	//load default view
     return $this->loadPublicView('user.my-liked', $processReaction['data']);
 }

	/**
     * Get User my Disliked view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getMyDislikedView()
    {
		//get page requested
    	$page = request()->input('page');
		//get liked people data by parameter like '1'   
        $processReaction = $this->userEngine->prepareUserLikeDislikedData(0);

        //check if page is not null and not equal to first page
        if (!is_null($page) and ($page != 1)) {

        	$processReaction['data'] = view('user.partial-templates.my-liked-users', $processReaction['data'])
         ->render();

         return $processReaction;
     }

    	//load default view
     return $this->loadPublicView('user.my-disliked', $processReaction['data']);
 }

	/**
     * Get User my Disliked view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getWhoLikedMeView()
    {
        //get page requested
    	$page = request()->input('page');
		//get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareUserLikeMeData();

        //check if page is not null and not equal to first page
        if (!is_null($page) and ($page != 1)) {

        	$processReaction['data'] = view('user.partial-templates.my-liked-users', $processReaction['data'])
         ->render();

         return $processReaction;
     }

    	//load default view
     return $this->loadPublicView('user.who-liked-me', $processReaction['data']);
 }

	/**
     * Get mutual like view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getMutualLikeView()
    {
    	//get page requested
    	$page = request()->input('page');
		//get mutual like data
        $processReaction = $this->userEngine->prepareMutualLikeData();

        //check if page is not null and not equal to first page
        if (!is_null($page) and ($page != 1)) {

        	$processReaction['data'] = view('user.partial-templates.my-liked-users', $processReaction['data'])
         ->render();

         return $processReaction;
     }

    	//load default view
     return $this->loadPublicView('user.mutual-like', $processReaction['data']);
 }

	/**
     * Get profile visitors view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getProfileVisitorView()
    {
        //get page requested
    	$page = request()->input('page');
		//get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareProfileVisitorsData();

        //check if page is not null and not equal to first page
        if (!is_null($page) and ($page != 1)) {

        	$processReaction['data'] = view('user.partial-templates.my-liked-users', $processReaction['data'])
         ->render();

         return $processReaction;
     }

    	//load default view
     return $this->loadPublicView('user.profile-visitor', $processReaction['data']);
 }

	/**
     * Handle send user gift request.
     *
     * @param object SendUserGiftRequest $request
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function userSendGift(SendUserGiftRequest $request, $sendUserUId)
    {
        $processReaction = $this->userEngine->processUserSendGift($request->all(), $sendUserUId);

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * Handle report user request.
     *
     * @param object ReportUserRequest $request
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function reportUser(ReportUserRequest $request, $sendUserUId)
    {
        $processReaction = $this->userEngine->processReportUser($request->all(), $sendUserUId);

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * Handle report user request.
     *
     * @param object blockUser $request
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function blockUser(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userEngine->processBlockUser($request->all());

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * Get block user view and user list.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function blockUserList()
    {
		//get page requested
    	$page = request()->input('page');
		//get profile visitors data
    	$processReaction = $this->userEngine->prepareBlockUserData();

        //check if page is not null and not equal to first page
        if (!is_null($page) and ($page != 1)) {

        	$processReaction['data'] = view('user.partial-templates.blocked-users', $processReaction['data'])
         ->render();

         return $processReaction;
     }

     return $this->loadPublicView('user.block-user.list', $processReaction['data']);
 }

	/**
     * Handle report user request.
     *
     * @param object blockUser $userUid
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processUnblockUser($userUid)
    {	
        $processReaction = $this->userEngine->processUnblockUser($userUid);

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * process Boost Profile.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processBoostProfile()
    {
        $processReaction = $this->userEngine->processBoostProfile();

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * process Boost Profile.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function loadProfileUpdateWizard()
    {

        $processReaction = $this->userEngine->checkProfileStatus();


        return $this->loadView('user.profile.update-wizard', $processReaction['data']);
    }

	/**
     * process Boost Profile.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function checkProfileUpdateWizard()
    {
        $processReaction = $this->userEngine->checkProfileStatus();

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

	/**
     * process Boost Profile.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function finishWizard(Request $request)
    {

        $processReaction = $this->userEngine->finishWizard($request->all());        
        if($processReaction){
            return redirect('@'.Auth::user()->username)->with([
                'success' => true,
                'message' => __tr('Profile updated.'),
            ]);

        }
    }

	/**
     * User Contact View.
     *
     *-----------------------------------------------------------------------*/
    public function getContactView()
    {
      $user = Auth::user();
      $contactData = [];
		//check is not empty
      if ($user) {
       $contactData = [
        'userFullName' => $user->first_name.' '.$user->last_name,
        'contactEmail' => $user->email
    ];
}
return $this->loadView('user.contact', $contactData);
}

	/**
     * Handle process contact request.
     *
     * @param object UserContactRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function contactProcess(UserContactRequest $request)
    {	
      $processReaction = $this->userEngine->processContact($request->all());
      return $this->responseAction(
       $this->processResponse($processReaction, [], [], true)
   );
  }

    /**
     * get booster price and period
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getBoosterInfo()
    {	
      $processReaction = $this->userEngine->getBoosterInfo();
      return $this->responseAction(
       $this->processResponse($processReaction, [], [], true)
   );
  }


    /**
     * get booster price and period
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function username_suggest()
    {   

      $username_get = $this->check_username_exists();
      $usernameExits = User::where('username',$username_get)->first();
      if(!__isEmpty($usernameExits)){
       $username_get = $this->check_username_exists();
   }
   echo json_encode(array('username'=>$username_get));
}

public function check_username_exists()
{   

    $userEmailString = explode("@", Auth::user()->email);
    return $autoUsername = $userEmailString[0] . mt_rand(0, 10000);

}

        /**
     * get booster price and period
     *
     * @return json object
     *---------------------------------------------------------------- */
        public function username_exists(Request $request)
        {   

            if($request->username){

                $usernameExits = User::where('username',$request->username)->first();

                if(isset($usernameExits->username)){
                 echo json_encode(array('avaliable'=>false));
             }else{
                 echo json_encode(array('avaliable'=>true));
             }
         }

     }

    /**
     * Handle process contact request.
     *
     * @param object CommonUnsecuredPostRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */

    public function term()
    {
        return $this->loadView('user.term');
    }
    public function policy()
    {
        return $this->loadView('user.policy');
    }


    public function deleteAccount(CommonUnsecuredPostRequest $request)
    {	
      $processReaction = $this->userEngine->processDeleteAccount($request->all());

      if ($processReaction['reaction_code'] == 1) {
        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true),
            $this->redirectTo('user.login')
        );
    }

    return $this->processResponse($processReaction, [], [], true);
}
}