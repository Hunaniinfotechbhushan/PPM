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



class MediaController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {
     $userPhotos =  User::leftjoin('user_photos', 'users._id', '=', 'user_photos.users__id')
     ->where('user_photos.is_verified',2)
     ->whereNotNull('user_photos._uid')
     ->select(
       __nestedKeyValues([
        'users' => [
         '_id as user_id',
         '_uid',
         'first_name',
         'last_name',
         'username',
         'gender_selection',
         DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name")
       ],
       'user_photos' => [
        '_id as media_id',
        '_uid as user_photo_id',
        'file as image_name',
        'video_thumbnail',
        'extantion_type',
        'is_verified',
        'created_at',
        'updated_at'
      ],
    ])
     )
     ->orderBy('user_photos._id','DESC')
     ->get();


// echo "<pre>";
// print_r($userPhotos);
// die;
     return view('backend.media.index',compact('userPhotos'));
   }


   public function photto_approve_request($id)
   {
    DB::table('user_photos')
        ->where('_id', $id)
        ->update(array('is_verified' => 1));

    $getUserData = DB::table('user_photos')->where('_id',$id)->first();  
    $getUserDetails = getUserDetails($getUserData->users__id);

    userActivity($getUserData->_uid,$getUserData->users__id,'user-media-upload',$id,1,"");

      // Notofication 
    $uid = $getUserData->_uid;
    $slug = 'photo/media-approve';
    $status = 1;
    $message = 'Your photo/video has been approved';
    $action = url('/').'/@'.$getUserDetails->username;
    $is_read = 0;
    $users__id = $getUserData->users__id;
    notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,$id);
    Session::flash('success','You have successfully approved the media.');

    return redirect('admin/media');

  }

  public function photto_reject_request($id)
  {
    DB::table('user_photos')
        ->where('_id', $id)
        ->update(array('is_verified' => 0));

        $getUserData = DB::table('user_photos')->where('_id',$id)->first(); 
        $getUserDetails = getUserDetails($getUserData->users__id);
         // Notofication 
        $uid = $getUserData->_uid;
        $slug = 'photo/media-reject';
        $status = 1;
        $message = 'This photo/video has been rejected. Please no nudity, text, low-quality photos or images without you';
        $is_read = 0;
        $action = url('/').'/@'.$getUserDetails->username;
        $users__id = $getUserData->users__id;
        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,$id);
        Session::flash('success','You have successfully rejected the media.');
        return redirect('admin/media');

      }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.media.create');
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

       return redirect('admin/media/create')->withErrors($validation->errors());

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

       return redirect('admin/media');

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
      $media =  User::leftjoin('user_profiles', 'media._id', '=', 'user_profiles.media__id')
      ->leftjoin('user_authorities', 'media._id', '=', 'user_authorities.media__id')
      ->where('media._id', $id)
      ->select('media.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
      ->first();

      return view('backend.media.show',compact('media'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
     $media =  User::leftjoin('user_profiles', 'media._id', '=', 'user_profiles.media__id')
     ->leftjoin('user_authorities', 'media._id', '=', 'user_authorities.media__id')
     ->where('media._id', $id)
     ->select('media.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
     ->first();

     return view('backend.media.edit',compact('media'));

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
       return redirect('/admin/media/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {
       $user->username =$input['username'];
       $user->is_verified=$input['is_verified'];
      // $blog->image=$imagedata;
       $user->updated_at=Carbon::now();
       $user->save();

       Session::flash('success','Update record successfully.');
       return redirect('admin/media');

     }

   }

   public function delete_user($id){
     $user = User::findOrFail($id);
     $user->delete();
     UserProfile::where('media__id',$id)->delete();
     Session::flash('success','Successfully deleted.');
     return redirect('admin/media');
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

      return redirect('admin/media');

    }


  }

