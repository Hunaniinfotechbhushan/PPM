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



class NewSignUpController extends Controller
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
      ->where('users.role', 2)
      ->select('users._id as user_id','users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
      ->orderBy('users.is_verified','ASC')
      ->orderBy('users.updated_at','DESC')
      ->get();

      return view('backend.newSignUp.index',compact('userData'));
    }


    



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {
      return view('backend.newSignUp.create');
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

       return redirect('admin/new-signup/create')->withErrors($validation->errors());

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

       return redirect('admin/new-signup');

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
     ->select('users._id as user_id','users._uid as user_Uid','users.*','user_profiles.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
     ->first();


      return view('backend.newSignUp.show',compact('users'));

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
     ->select('users._id as user_id','users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
     ->first();

     return view('backend.newSignUp.edit',compact('users'));

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
    //  return $input; 
     $validation = Validator::make($input,
       [
         'username' => 'required',
         'email' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/new-signup/'.$id)->withErrors($validation->errors());
     }
     else
     {

      if($user){

        if($input['gender_selection']==0){

               $gender_selection=2;
        }else{
           $gender_selection=1;

        }


      $user->username =$input['username'];
       $user->email =$input['email'];
       $user->gender_selection = $gender_selection;
       $user->is_verified=$input['is_verified'];
      // $blog->image=$imagedata;
       $user->updated_at=Carbon::now();
       $user->save();

       UserProfile::where('users__id',$id)->update(array('city'=>$input['city'],
        // 'heading'=> $input['heading'],
        // 'about_me'=> $input['about_me'],
        // 'what_are_you_seeking'=>$input['what_are_you_seeking'],
        // 'dob'=>$input['dob']
      ));

       $getUserDetails = getUserDetails($id);

       // echo "<pre>";
       // print_r($getUserDetails); die();
       if($input['is_verified'] == 1){
        $uid = $getUserDetails->_uid;
        $slug = 'profile-approve';
        $status = 1;
        $message = 'Your Profile has been approved!';
        $is_read = 0;
        $action = url('/').'/@'.$getUserDetails->username;
        return $action;
        $users__id = $getUserDetails->_id;
        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

        userActivity($uid,$users__id,'new-user-added','Joined',1,"");
      }

      if($input['is_verified'] == 2){
        
        $uid = $getUserDetails->_uid;
        $slug = 'profile-reject';
        $status = 1;
        $message = 'Your profile has been rejected';
        $is_read = 0;
        $action = url('/').'/@'.$getUserDetails->username;
        $users__id = $getUserDetails->_id;
        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");
      }

    }


    Session::flash('success','Update record successfully.');
    return redirect('admin/new-signup');

  }

}

public function delete_user($id){
 $user = User::findOrFail($id);

 $user->delete();

 Session::flash('success','Successfully deleted.');

 return redirect('admin/new-signup');
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

      return redirect('admin/new-signup');

    }


  }

