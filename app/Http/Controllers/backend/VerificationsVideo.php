<?php
namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;

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



class VerificationsVideo extends Controller

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
      ->where('users.video_verify', 2)
      ->where('users.role', 2)
      ->select('users._id as user_id','users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
      ->orderBy('users.updated_at','DESC')
      ->get();

      return view('backend.verificationVideo.index',compact('userData'));
    }




    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.verificationVideo.create');
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
      $users =  User::leftjoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
      ->leftjoin('user_authorities', 'users._id', '=', 'user_authorities.users__id')
      ->where('users._id', $id)
      ->select('users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
      ->first();

      return view('backend.verificationVideo.show',compact('users'));

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

     return view('backend.verificationVideo.edit',compact('users'));

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

   public function video_approve_request($id){
     $user = User::findOrFail($id);
     $user->video_verify=1;
     $user->updated_at=Carbon::now();
     $user->save();

     $getUserDetails = getUserDetails($id);     

     $slug = 'verification-video/approve';
     $message = "Your verification video is approved.";      
     $uid = $getUserDetails->_uid;   
     $status = 1; 
     $action = url('/').'/@'.$getUserDetails->username;
     $is_read = 0;
     $users__id = $id;
     notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");


     // $user->delete();
     // UserProfile::where('users__id',$id)->delete();
     Session::flash('success','Successfully approved the video verification.');
     return redirect('admin/verifications-video');
   }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function video_reject_request(Request $request)
    {

     $input = $request->all();

     if($input['rejected_video_user_id']){

       $user = User::findOrFail($input['rejected_video_user_id']);
       $user->video_verify=0;
       $user->video_verify_reject_msg=$input['video_verify_reject_msg'];
       $user->updated_at=Carbon::now();
       $user->save();

       $getUserDetails = getUserDetails($input['rejected_video_user_id']);     

       $slug = 'verification-video/reject';
       $message = $input['video_verify_reject_msg'];      
       $uid = $getUserDetails->_uid;   
       $status = 1; 
       $action = url('/').'/@'.$getUserDetails->username;
       $is_read = 0;
       $users__id = $input['rejected_video_user_id'];
       notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");


       Session::flash('success','Successfully rejected the video verification.');

       return redirect('admin/verifications-video');

     }
   }

   public function user_verifications_video_upload(Request $request)
   {
     $imageFiles = $request->file('verify_video_upload');

     if($imageFiles){

      $mime = $imageFiles->getMimeType();
      if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") 
      {
        $mediaName= rand().'-'.$imageFiles->getClientOriginalName();
        $imageFiles->move(public_path().'/backend/assets/verification/',$mediaName);

        $user = User::findOrFail(Auth::user()->_id);
        $user->verification_video_file=$mediaName;
        $user->updated_at=Carbon::now();
        $user->save();
        echo json_encode(array('status'=> 'success','msg'=>"Verification video successfully uploaded"));

      }else{
        echo json_encode(array('status'=> 'error','msg'=>"Please upload only video file"));
      }

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

