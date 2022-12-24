<?php
/*
* UserSettingController.php - Controller file
*
* This file is part of the UserSetting component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\UserSetting\Controllers;

use \Illuminate\Support\Facades\URL;
use App\Exp\Base\BaseController; 
use App\Exp\Components\UserSetting\Requests\{
    UserBasicSettingAddRequest, 
    UserProfileSettingAddRequest,
    UserSettingRequest,
    UserProfileWizardRequest
};
use App\Exp\Support\CommonUnsecuredPostRequest;
use App\Exp\Components\User\Models\User;
use App\Exp\Components\UserSetting\UserSettingEngine;
use Auth;
use Mail;


class UserSettingController extends BaseController 
{    
    /**
     * @var  UserSettingEngine $userSettingEngine - UserSetting Engine
     */
    protected $userSettingEngine;

    /**
      * Constructor
      *
      * @param  UserSettingEngine $userSettingEngine - UserSetting Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(UserSettingEngine $userSettingEngine)
    {
        $this->userSettingEngine = $userSettingEngine;
    }

    /**
     * Show user setting view.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getUserSettingView($pageType)
    {    
      $processReaction = $this->userSettingEngine->prepareUserSettings($pageType);

      return $this->loadPublicView('user.settings.settings', $processReaction['data']);
  }

     /**
     * Get UserSetting Data.
     *
     * @param string $pageType
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function processStoreUserSetting(UserSettingRequest $request, $pageType) 
    {   
        $processReaction = $this->userSettingEngine
        ->processUserSettingStore($pageType, $request->all());

        return $this->responseAction(
           $this->processResponse($processReaction, [], [], true)
       );
    }

    /**
     * Process store user basic settings.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processUserBasicSetting(UserBasicSettingAddRequest $request)
    {


        if(isset($request->username)){

            $usernameCheck = User::where('username',$request->username)->where('_id','!=',Auth::user()->_id)->first();

            if(__isEmpty($usernameCheck)){
               $user = User::findOrFail(Auth::user()->_id);
               $user->username = $request->username;
               $user->save();
               $processReaction = $this->userSettingEngine->processStoreUserBasicSettings($request->all());
               return $this->responseAction(
                $this->processResponse($processReaction, [], [], true)
                 );
            }else{

                $data  = array('data' => array('status' => false,'message'=>'Username already exits. Please use another username'));
                return json_encode($data);
            }
        }else{
         $processReaction = $this->userSettingEngine->processStoreUserBasicSettings($request->all());
         return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );

     }

 }


   /**
     * Process store user basic settings.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function userEmailUpdateRequest(UserBasicSettingAddRequest $request)
    {


        if(isset($request->email)){

            $usernameCheck = User::where('email',$request->email)->get();

            if(__isEmpty($usernameCheck)){
               $user = User::findOrFail(Auth::user()->_id);
               $user->email = $request->email;
               $user->save();

               // email
               $Token = sha1(time());

                        $UserIDTokan = User::find(Auth::user()->_id);
                        $UserIDTokan->verify_token = $Token;
                        $UserIDTokan->save(); 
                        $url =    URL::to('/account-verify?token='.$Token);
                        $urlmain =    URL::to('/');
                        $to = $request->email;
                        $info = array(
                            'Token' => $Token,
                            'url' => $url,
                            'urlmain' => $urlmain
                        );
                        Mail::send('emails.newRegistration', $info, function ($message) use($to) {
                            $message->to($to, 'ppmarrangements')
                            ->subject('Verify mail');
                            $message->from('webtest41@gmail.com', 'ppmarrangements');
                        });
                return json_encode(array('status'=> 'success','email' =>$request->email));
               
            }else{

               return json_encode(array('status'=> 'not'));
            }
        }

 }








    /**
     * Process profile Update Wizard.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function profileUpdateWizard(UserProfileWizardRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreProfileWizard($request->all());

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

    /**
     * Process store user basic settings.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processLocationData(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreLocationData($request->all());

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

    /**
     * Process upload profile image.
     *
     * @param object CommonUnsecuredPostRequest $request
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function uploadProfileImage(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadProfileImage($request->all(), 'profile');

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Process upload cover image.
     *
     * @param object CommonUnsecuredPostRequest $request
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function uploadCoverImage(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadCoverImage($request->all(), 'cover_image');

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Process user profile settings
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processUserProfileSetting(UserProfileSettingAddRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreUserProfileSetting($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Show user photos view.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getUserPhotosSetting()
    {
        $processReaction = $this->userSettingEngine->prepareUserPhotosSettings();
        
        return $this->loadPublicView('user.settings.photos', $processReaction['data']);
    }

       /**
     * Show user photos view.
     *
     * @return json object
     *---------------------------------------------------------------- */
       public function userSetting()
       {
        $processReaction = $this->userSettingEngine->prepareUserPhotosSettings();
        
        return $this->loadPublicView('user.settings.settings', $processReaction['data']);
    }

    /**
     * Upload multiple photos
     *
     * @param object CommonUnsecuredPostRequest $request
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function uploadPhotos(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadPhotos($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    public function uploadUserPhoto(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadUserPhotos($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }
    public function deletePhotos(CommonUnsecuredPostRequest $request)
    {

        $processReaction = $this->userSettingEngine->processDeletePhotos($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }
    public function movePhotos(CommonUnsecuredPostRequest $request)
    {


        $processReaction = $this->userSettingEngine->processMovePhotos($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    public function movePhotosPublic(CommonUnsecuredPostRequest $request)
    {


        $processReaction = $this->userSettingEngine->processMovePhotosPublic($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    public function updateProfilePoto(CommonUnsecuredPostRequest $request)
    {


        $processReaction = $this->userSettingEngine->processUpdateProfile($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    

}