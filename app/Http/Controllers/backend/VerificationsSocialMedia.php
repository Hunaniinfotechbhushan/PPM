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



class VerificationsSocialMedia extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {
      $userData =  DB::table('socail_login')
      ->leftjoin('users', 'users._id', '=', 'socail_login.user_id')
      ->leftjoin('user_profiles', 'user_profiles.users__id', '=', 'socail_login.user_id')
      ->leftjoin('user_authorities', 'socail_login.user_id', '=', 'user_authorities.users__id')
      ->where('users.video_verify', 2)
      ->where('users.role', 2)
      ->select('socail_login.name as social_name',
        'socail_login.email as social_email',
        'socail_login.social_type as social_type',
        'socail_login.social_id as social_id',
        'socail_login.created_at as social_created_at',
        'users._id as user_id',
        'users.*',
        'user_profiles.*',
        'user_authorities._id AS user_authority_id',
        'user_authorities.user_roles__id')
      ->orderBy('users.created_at','DESC')
      ->get();

      return view('backend.verificationSocialMedia.index',compact('userData'));
    }




    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.verificationSocialMedia.create');
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

       return redirect('admin/verifications-video');

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

      $users =  DB::table('socail_login')
      ->leftjoin('users', 'users._id', '=', 'socail_login.user_id')
      ->leftjoin('user_profiles', 'user_profiles.users__id', '=', 'socail_login.user_id')
      ->leftjoin('user_authorities', 'socail_login.user_id', '=', 'user_authorities.users__id')
      ->where('users._id', $id)
      ->where('users.role', 2)
      ->select('socail_login.name as social_name',
        'socail_login.email as social_email',
        'socail_login.social_type as social_type',
        'socail_login.social_id as social_id',
        'socail_login.created_at as social_created_at',
        'users._id as user_id',
        'users.*',
        'user_profiles.*',
        'user_authorities._id AS user_authority_id',
        'user_authorities.user_roles__id')
      ->first();

      return view('backend.verificationSocialMedia.show',compact('users'));

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

     return view('backend.verificationSocialMedia.edit',compact('users'));

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
       return redirect('/admin/verifications-video/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {
       $user->username =$input['username'];
       $user->is_verified=$input['is_verified'];
      // $blog->image=$imagedata;
       $user->updated_at=Carbon::now();
       $user->save();

       Session::flash('success','Update record successfully.');
       return redirect('admin/verifications-video');

     }

   }

   public function facebook_approve_request($id){

     $user = User::findOrFail($id);
     $user->facebook_verify=1;
     $user->updated_at=Carbon::now();
     $user->save();

     $getUserDetails = getUserDetails($id);     
     $slug = 'social/approve';
     $message ="Your facebook verification is approved.";      
     $uid = $getUserDetails->_uid;   
     $status = 1; 
     $action = url('/').'/@'.$getUserDetails->username;
     $is_read = 0;
     $users__id = $id;
     notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");


     Session::flash('success','Successfully approved the facebook verification.');
     return redirect('admin/verifications-social-media');
   }

   public function linkedin_approve_request($id){

     $user = User::findOrFail($id);
     $user->linkedin_verify=1;
     $user->updated_at=Carbon::now();
     $user->save();

     $getUserDetails = getUserDetails($id);     
     $slug = 'social/approve';
     $message ="Your linkedin verification is approved.";      
     $uid = $getUserDetails->_uid;   
     $status = 1; 
     $action = url('/').'/@'.$getUserDetails->username;
     $is_read = 0;
     $users__id = $id;
     notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

     Session::flash('success','Successfully approved the linkedin verification.');
     return redirect('admin/verifications-social-media');
   }

   public function instagram_approve_request($id){

     $user = User::findOrFail($id);
     $user->instagram_verify=1;
     $user->updated_at=Carbon::now();
     $user->save();

     $getUserDetails = getUserDetails($id);     
     $slug = 'social/approve';
     $message = "Your instagram verification is approved.";      
     $uid = $getUserDetails->_uid;   
     $status = 1; 
     $action = url('/').'/@'.$getUserDetails->username;
     $is_read = 0;
     $users__id = $id;
     notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

     Session::flash('success','Successfully approved the instagram verification.');
     return redirect('admin/verifications-social-media');
   }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function social_reject_request(Request $request)
    {
      $input = Request::all();
      
     if($input['rejected_verify_user_id']){

       $user = User::findOrFail($input['rejected_verify_user_id']);
       if($input['rejected_media_type'] == "linkedin"){
         $user->linkedin_verify=2;
       }elseif ($input['rejected_media_type']="facebook") {
         $user->facebook_verify=2;
       }elseif ($input['rejected_media_type']="instagram") {
         $user->instagram_verify=2;
       }else{
       }
       $user->social_verify_reject_msg=$input['social_verify_reject_msg'];
       $user->updated_at=Carbon::now();
       $user->save();

       $getUserDetails = getUserDetails($input['rejected_verify_user_id']);     

       $slug = 'social/reject';
       $message = $input['social_verify_reject_msg'];      
       $uid = $getUserDetails->_uid;   
       $status = 1; 
       $action = url('/').'/@'.$getUserDetails->username;
       $is_read = 0;
       $users__id = $input['rejected_verify_user_id'];
       notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

       Session::flash('success','Successfully rejected the video verification for '.$input['rejected_media_type']);
       return redirect('admin/verifications-social-media');

     }
   }

   public function destroy($id)

   {

    $user = User::findOrFail($id);

    $user->delete();

    Session::flash('success','Successfully deleted.');

    return redirect('admin/verifications-video');

  }


}

