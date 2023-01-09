<?php
namespace App\Http\Controllers\backend;
use Illuminate\Http\Request; 
use App\Exp\Components\User\Models\{
  User, UserAuthorityModel, UserProfile, CreditWalletTransaction
};
use Auth;
use App\Exp\Components\Event\Models\Event;
use App\Exp\Components\Event\Models\UpdateEvent;
use Carbon\Carbon;
use Session;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\URL;

class EventsController extends Controller
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
      'users.user_account',
      'users._uid as UID',
      'user_profiles.dob',
      'user_profiles.profile_picture',
      'events.*',
      'event_like_dislikes.event_id')
     ->leftJoin('users', 'users._id', '=', 'events.user_id')       
     ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
     ->leftJoin('event_like_dislikes', 'event_like_dislikes.event_id', '=', 'events._id')
     ->where('events.status','!=',2)
     ->orderBy('events.created_at','DESC')
     ->get();
     return view('backend.events.index',compact('events'));
   }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
      return view('backend.events.create');
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

      return view('backend.events.show',compact('events'));

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

     return view('backend.events.edit',compact('users'));

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
      
      $input = $request->all();

      $validation = Validator::make($input,
        [
          'title' => 'required',
        ]);

      if( $validation->fails() ) {
        return redirect('/admin/events/'.$id.'/edit')->withErrors($validation->errors());
      }
      else
      {
        $user->title =$input['title'];
        $user->event_date = $input['event_date'];
        $user->featured = $input['featured'];
        $user->meet_type = $input['meet_type'];
        $user->description = $input['description'];
        // $user->location=$input['location'];
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
          $event_status = "Your event is rejected.";

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
          $event_status = "";

          notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");
        }else{

        }
  if($input['status'] == 1 || $input['status'] == 2){
            $urlmain =    URL::to('/');
          $to = $getUserDetails->email;
          $info = array(
            'messagedata' => $message,
            'username' => $getUserDetails->username,
            'url' => $urlmain,                           
            'event_status' => $event_status                       
          );

          Mail::send('emails.event_reject', $info, function ($message) use($to) {
            $message->to($to, 'ppmarrangements')
            ->subject('Event Rejected');
            $message->from('webtest41@gmail.com', 'ppmarrangements');
          });

  }
        Session::flash('success','Update record successfully.');
        return redirect('admin/events');

      }

  }


  public function temporary_suspend($id){

   $getUserDetails = getUserDetails($id);
   
   $slug = 'account/temp-suspend';
   $message = 'Does something wrong on the website, your profile will temporary be taken down until I reinstate it.';
   
   $uid = $getUserDetails->_uid;   
   $status = 1; 
   $action = url('/').'/@'.$getUserDetails->username;
   $is_read = 0;
   $users__id = $id;

   notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");


   $user = User::findOrFail($id);
   $user->is_verified=4;
   $user->updated_at=Carbon::now();
   $user->save();

     // $user->delete();
     // UserProfile::where('users__id',$id)->delete();
   Session::flash('success','Successfully Suspend account.');
   return redirect('admin/users');
 }


 public function delete_user($id){
   $user = User::findOrFail($id);
   $user->is_verified=3;
   $user->updated_at=Carbon::now();
   $user->save();

     // $user->delete();
     // UserProfile::where('users__id',$id)->delete();
   Session::flash('success','Successfully deleted.');
   return redirect('admin/users');
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


    public function updateEvent()
    {
      $events = UpdateEvent::select('users._id as user_id',
      'users.username',
      'users.user_account',
      'users._uid as UID',
      'user_profiles.dob',
      'user_profiles.profile_picture',
      'event_update.*',
      'event_like_dislikes.event_id')
     ->leftJoin('users', 'users._id', '=', 'event_update.user_id')       
     ->leftJoin('user_profiles', 'user_profiles.users__id', '=', 'users._id')
     ->leftJoin('event_like_dislikes', 'event_like_dislikes.event_id', '=', 'event_update._id')
     ->where('event_update.status','!=',2)
     ->orderBy('event_update.created_at','DESC')
     ->get();
      return view('backend.events.eventupdate',compact('events'));

    }

    public function editUpdateEvent($id)
    {
      $events = UpdateEvent::find($id);
      return view('backend.events.eventUpdateEdit',compact('events'));
    }

    public function updateEventEditUpdate(Request $request, $id)
    {

        $event = Event::where('_id',$request->event_id)->first();
        $event->event_date = $request->event_date;
        $event->title = $request->title;
        $event->meet_type = $request->meet_type;
        $event->description = $request->description;
        $event->status = $request->status;
        $event->update();

        $eventDelete = UpdateEvent::where('_id',$request->_id)->first();
        $eventDelete->delete();
        
        Session::flash('success','Event Update Successfully.');
        return redirect('admin/events');
    }


  }

