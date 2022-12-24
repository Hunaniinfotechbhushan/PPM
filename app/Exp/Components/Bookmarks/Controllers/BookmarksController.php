<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Bookmarks\Controllers;

use App\Exp\Base\BaseController;
use Illuminate\Http\Request;
use App\Exp\Components\Bookmarks\Requests\{
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
use App\Exp\Components\Bookmarks\UserEngine;
use App\Exp\Components\Bookmarks\Models\User;
use App\Exp\Components\Bookmarks\Models\BookMarks;

use App\Exp\Components\Bookmarks\Models\SocialConnect;
use Illuminate\Support\Facades\Validator;

use App\Exp\Support\CommonUnsecuredPostRequest;
use Auth;

use Mail;
use Socialite;
use GuzzleHttp\Client;
use Exception;
use App\Exp\Components\UserSetting\Models\UserSettingModel;

class BookmarksController extends BaseController
{




public function book_marks(Request $request)
{ 

       if($request->ajax()){
      
        BookMarks::insert(

        ['user_id' => $request->bookmark_user_id, 'status' => 1]

    );
       
       
    return  ['success' => 1 ,'Your account created successfully.'];

}
}
}