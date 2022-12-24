<?php
namespace App\Http\Controllers\backend;
use Request;

use App\Exp\Components\User\Models\{
  User, UserAuthorityModel, UserProfile, CreditWalletTransaction
};

use Auth;

use Carbon\Carbon;

use Session;

use Mail;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;



class DeletedProfileController extends Controller

{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {
      $userData =  User::leftjoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
      ->leftjoin('user_authorities', 'users._id', '=', 'user_authorities.users__id')
      ->where('users.is_verified', 3)
      ->where('users.role', 2)
      ->select('users.*','users.updated_at as user_deleted_time','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
      ->orderBy('users.created_at','DESC')
      ->get();

      return view('backend.deletedProfiles.index',compact('userData'));
    }




    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.users.create');
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
      $input = Request::all();    

      $validation = Validator::make($input,
       [

         'name' => 'required',

         'email' => 'required',

       ]);

      if( $validation->fails() ) {

       return redirect('admin/users/create')->withErrors($validation->errors());

     }

     else

     {
       $dataArray = array(

        "name"     =>   $input['name'],

        "email"   =>      $input['email'],

        "role"   =>     'customer',

        'password' => Hash::make('12345678'),

        // "image"   =>      $imagedata

      );





       User::create($dataArray);

       Session::flash('success','Insert record successfully.');

       return redirect('admin/users');

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
     $users =  User::leftjoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
     ->leftjoin('user_authorities', 'users._id', '=', 'user_authorities.users__id')
     ->where('users._id', $id)
     ->select('users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
     ->first();

     return view('backend.users.edit',compact('users'));

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
     $input = Request::all();
     $validation = Validator::make($input,
       [
         'username' => 'required',
         'email' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/users/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {
       $user->username =$input['username'];
       $user->is_verified=$input['is_verified'];
      // $blog->image=$imagedata;
       $user->updated_at=Carbon::now();
       $user->save();

       Session::flash('success','Update record successfully.');
       return redirect('admin/users');

     }

   }

   public function reinstate($id){
     $user = User::findOrFail($id);
     $user->is_verified=1;
     $user->updated_at=Carbon::now();
     $user->save();

     Session::flash('success','Successfully reinstate user.');
     return redirect('admin/deleted-profiles');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function remove_from_system($id)
    {
      $user = User::findOrFail($id);
      $user->delete();

      UserProfile::where('users__id',$id)->delete();

      Session::flash('success','Successfully deleted.');

      return redirect('admin/deleted-profiles');

    }


  }

