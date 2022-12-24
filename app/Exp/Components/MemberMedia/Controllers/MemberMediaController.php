<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\MemberMedia\Controllers;

use App\Exp\Base\BaseController;
use Request;

use App\Exp\Components\User\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Exp\Support\CommonUnsecuredPostRequest;
use Auth;
use DB;
use Mail;
use Socialite;
use GuzzleHttp\Client;
use Exception;
use App\Exp\Components\UserSetting\Models\UserSettingModel;
use Illuminate\Support\Facades\Input;
use App\Exp\Components\MemberMedia\MemberMediaEngine;
use App\Exp\Components\Team\Models\Team;
use App\Exp\Components\User\Repositories\{UserRepository};
use App\Exp\Components\User\Models\{
    User as UserModel,
    UserProfile
};

class MemberMediaController extends BaseController
{
        /**
     * @param \App\Http\Requests\Backend\Pages\ManagePageRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
        protected $memberMediaEngine;
        protected $userRepository;

        public function __construct(MemberMediaEngine $memberMediaEngine,UserRepository $userRepository)
        {
            $this->memberMediaEngine = $memberMediaEngine;
            $this->userRepository  = $userRepository;
        }


        public function index()
        {
          $userData = $this->memberMediaEngine->getAllMedia();

          return $this->loadManageView('member-media.manage.list', compact('userData'));
      }

      public function create()
      {
       return $this->loadManageView('team.manage.add');
   }


   public function store(Request $request)
   {

      $inputData = Request::all();
      $validation = Validator::make($inputData,
       [
         'first_name' => 'required',
     ]);
      if( $validation->fails() ) {
       return redirect('admin/team/create')->withErrors($validation->errors());
   }
   else
   {

      $userData = $this->teamEngine->processSaveTeam($inputData);

      if($userData){
       return redirect('admin/team');
   }


}
}


public function destroy($id)
{
    $user = $this->userRepository->fetchByID($id);    
    if ($this->userRepository->deleteUser($user)) {
      return redirect('admin/team');
  }
}


public function photto_approve_request($id)
{
   $userData = $this->memberMediaEngine->photto_verify_request($id,1);
   $getUserData = DB::table('user_photos')->where('_id',$id)->first();
  
   userActivity($getUserData->_uid,$getUserData->users__id,'user-media-upload',$id,1,"");

   return redirect('admin/member-media');

}

public function photto_reject_request($id)
{
   $userData = $this->memberMediaEngine->photto_verify_request($id,0);

   return redirect('admin/member-media');

}


}