<?php
namespace App\Http\Controllers\backend;
use Request;

use App\Exp\Components\User\Models\{
  User, UserAuthorityModel, CreditWalletTransaction
};
use App\Models\Team;
use App\Models\UserProfile;
use Auth;
use Carbon\Carbon;
use Session;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $team = Team::where('users.role', 1)
      ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
      ->where('users.role',1)
      ->select(
        \__nestedKeyValues([
          'users' => [
            '_id',
            'username',
            'email',
            'first_name',
            'last_name',
            'status',
            'login_password',
            'designation',
            'mobile_number',
            'created_at'
          ],
          'user_profiles' => [
            '_id AS user_profile_id',
            'users__id',
            'countries__id',
            'profile_picture',
            'gender',
            'dob',
            'city',
            'about_me',
            'location_latitude',
            'location_longitude',
            'preferred_language',
            'relationship_status',
            'work_status',
            'education',
            'cover_picture'
          ]
        ])
      )
      ->orderBy('users._id','DESC')
      ->get();

      return view('backend.team.index',compact('team'));
    }




    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.team.create');
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
      $inputData = Request::all();    

      $validation = Validator::make($inputData,
       [

         'username' => 'required',
         'email' => 'required',

       ]);

      if( $validation->fails() ) {

       return redirect('admin/team/create')->withErrors($validation->errors());

     }
     else
     {

       $dataArray = array(
        "_uid"     =>  rand(),
        "first_name"     =>  $inputData['first_name'],
        "last_name"     =>  $inputData['last_name'],
        "email"     =>  $inputData['email'],
        "username"     =>  $inputData['username'],
        'gender_selection'        => 1,
        "password"     =>  bcrypt($inputData['login_password']),
        "login_password"     => $inputData['login_password'],
        "status"     =>  1,
        "role"     =>  1,
      );


      $user = Team::create($dataArray);

    $keyValues = [
        'users__id'     => $user->id,
        'gender'        => 1,
        'profile_picture' => 'default.jpg',
        'dob'           => date("Y-m-d",strtotime('10-10-1995')),
        'status'        => 0,
      ];

      $user = UserProfile::create($keyValues);
   
        $UserAuthorityModel = new UserAuthorityModel;
        $UserAuthorityModel->users__id =  $user->users__id;
        $UserAuthorityModel->_uid = $user->_uid;
        $UserAuthorityModel->user_roles__id = 1;
        $UserAuthorityModel->status = 1;
        $UserAuthorityModel->save();

      Session::flash('success','Insert record successfully.');

      return redirect('admin/team');

    }

  }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)
    {
      $users =  User::leftjoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
      ->leftjoin('user_authorities', 'users._id', '=', 'user_authorities.users__id')
      ->where('users._id', $id)
      ->select('users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
      ->first();

      return view('backend.users.show',compact('users'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
    $team =  User::leftjoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
     ->leftjoin('user_authorities', 'users._id', '=', 'user_authorities.users__id')
     ->where('users._id', $id)
     ->select('users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
     ->first();
     return view('backend.team.edit',compact('team'));

   }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)
    {

     $user = User::findOrFail($id);
     $inputData = Request::all();
     $validation = Validator::make($inputData,
       [
         'username' => 'required',
         'email' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/team/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {


       $user->first_name =$inputData['first_name'];
       $user->last_name =$inputData['last_name'];
       $user->email =$inputData['email'];
       $user->username =$inputData['username'];
       $user->login_password =$inputData['login_password'];
       $user->password =bcrypt($inputData['login_password']);
          $user->status =$inputData['status'];
      // $user->is_verified=$input['is_verified'];
      // $blog->image=$imagedata;
       $user->updated_at=Carbon::now();
       $user->save();

       Session::flash('success','Update record successfully.');
       return redirect('admin/team');

     }

   }

   public function delete_user($id){

     $user = User::findOrFail($id);
     $user->delete();
     UserProfile::where('users__id',$id)->delete();
     Session::flash('success','Successfully deleted.');
     return redirect('admin/team');
   }


      public function team_activate($id){
       $user = User::findOrFail($id);
       $user->status=1;
       $user->updated_at=Carbon::now();
       $user->save();

     Session::flash('success','Successfully activated.');
     return redirect('admin/team');
   }

        public function team_freeze($id){
       $user = User::findOrFail($id);
       $user->status=0;
       $user->updated_at=Carbon::now();
       $user->save();

     Session::flash('success','Successfully freezed.');
     return redirect('admin/team');
   }

           public function team_deleted($id){


       $user = User::findOrFail($id);
       $user->delete();

     Session::flash('success','Successfully deleted.');
     return redirect('admin/team');
   }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

      $user = User::findOrFail($id);

      $user->delete();

      Session::flash('success','Successfully deleted.');

      return redirect('admin/users');

    }


  }

