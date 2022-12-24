<?php
namespace App\Http\Controllers\backend;
use Request;
use App\Exp\Components\User\Models\{
  User, UserAuthorityModel, UserProfile, CreditWalletTransaction
};
use Auth;
use App\Exp\Components\Event\Models\Event;
use Carbon\Carbon;
use Session;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RejectedEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

     $events = Event::select('users._id as user_id',
      'users.username',
      'users._uid as UID',
      'user_profiles.dob',
      'user_profiles.profile_picture',
      'events.*',
      'event_like_dislikes.event_id')
     ->leftJoin('users', 'users._id', '=', 'events.user_id')       
     ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
     ->leftJoin('event_like_dislikes', 'event_like_dislikes.event_id', '=', 'events._id')
     ->where('events.status',2)
     ->orderBy('events.created_at','DESC')
     ->get();

     return view('backend.rejectEvents.index',compact('events'));
   }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.rejectEvents.create');
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
      $events = Event::select('users._id as user_id',
        'users.username',
        'users._uid as UID',
        'user_profiles.dob',
        'user_profiles.profile_picture',
        'events.*',
        'event_like_dislikes.event_id')
      ->leftJoin('users', 'users._id', '=', 'events.user_id')       
      ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
      ->leftJoin('event_like_dislikes', 'event_like_dislikes.event_id', '=', 'events._id')
      ->where('events._id', $id)
      ->first();

      return view('backend.rejectEvents.show',compact('events'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)
    {
     $users =  User::leftjoin('user_profiles', 'events._id', '=', 'user_profiles.users__id')
     ->leftjoin('user_authorities', 'events._id', '=', 'user_authorities.users__id')
     ->where('events._id', $id)
     ->select('events.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
     ->first();

     return view('backend.rejectEvents.edit',compact('users'));

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
     $user = Event::findOrFail($id);
     $input = Request::all();


     $validation = Validator::make($input,
       [
         'username' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/events/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {



      $user->title =$input['title'];
      $user->event_date = $input['event_date'];
      $user->location=$input['location'];
      $user->status=$input['status'];
      $user->updated_at=Carbon::now();
      $user->save();


      if($input['status'] == 2){

        $getUserDetails = getUserDetails($user->user_id);
        $slug = 'event/reject';
        $message = 'Your Event ad has been rejected. Please do not use explicit or violent language in your ad. Contact details are also not allowed on your ad.';   
        $uid = $getUserDetails->_uid;   
        $status = 2; 
        $action = url('/').'/@'.$getUserDetails->username;
        $is_read = 0;
        $users__id =$user->user_id;

        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

      }elseif($input['status'] == 1){

        $getUserDetails = getUserDetails($user->user_id);
        $slug = 'event/approve';
        $message = 'Your event '.$input['title'].' is approved.';   
        $uid = $getUserDetails->_uid;   
        $status = 1; 
        $action = url('/').'/@'.$getUserDetails->username;
        $is_read = 0;
        $users__id = $user->user_id;

        notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");
        }else{

      }

      Session::flash('success','Update record successfully.');
      return redirect('admin/events');

    }

  }

   public function reinstate($id){
     $user = Event::findOrFail($id);
     $user->status=1;
     $user->updated_at=Carbon::now();
     $user->save();

     Session::flash('success','Successfully reinstate user.');
     return redirect('admin/events');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function remove_from_system($id)
    {
      $user = Event::findOrFail($id);
      $user->delete();

      Session::flash('success','Successfully deleted.');
      return redirect('admin/rejected-events');

    }

  }

