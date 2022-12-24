<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Team\Controllers;

use App\Exp\Base\BaseController;
use Request;

use App\Exp\Components\User\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Exp\Support\CommonUnsecuredPostRequest;
use Auth;
use Mail;
use Socialite;
use GuzzleHttp\Client;
use Exception;
use App\Exp\Components\UserSetting\Models\UserSettingModel;
use Illuminate\Support\Facades\Input;
use App\Exp\Components\Team\TeamEngine;
use App\Exp\Components\Team\Models\Team;
use App\Exp\Components\User\Repositories\{UserRepository};
use App\Exp\Components\User\Models\{
    User as UserModel,
    UserProfile
};

class TeamController extends BaseController
{
        /**
     * @param \App\Http\Requests\Backend\Pages\ManagePageRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
         protected $teamEngine;
         protected $userRepository;

             public function __construct(TeamEngine $teamEngine,UserRepository $userRepository)
    {
        $this->teamEngine = $teamEngine;
        $this->userRepository  = $userRepository;
    }


    public function index()
    {
           $userData = $this->teamEngine->teamAllData();
       return $this->loadManageView('team.manage.list', compact('userData'));
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
      // Session::flash('success','Successfully deleted.');
      
    }

}