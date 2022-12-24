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
use App\Exp\Components\AbuseReport\Models\AbuseReportModel;


class ReportsController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {

      $reports =  AbuseReportModel::leftjoin('users', 'abuse_reports.for_users__id', '=', 'users._id')
      ->where('abuse_reports.status',0)
      ->select(
        __nestedKeyValues([
          'abuse_reports.*',
          'users._id as userId',
          'users.username'
        ])
      )
      ->groupBy('abuse_reports.for_users__id')
      ->get();

              // echo "<pre>";
              // print_r($reports);
              // die;

      return view('backend.reports.index',compact('reports'));
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
      ->select('users._id as user_id','users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
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

       if($input['gender_selection']==0){

         $gender_selection=2;
       }else{
         $gender_selection=1;

       }

       $user->email =$input['email'];
       $user->gender_selection = $gender_selection;
       $user->is_verified=$input['is_verified'];
      // $blog->image=$imagedata;
       $user->updated_at=Carbon::now();
       $user->save();

       UserProfile::where('users__id',$id)->update(array('city'=>$input['city'],
        'heading'=>$input['heading'],
        'about_me'=>$input['about_me'],
        'dob'=>$input['dob']
      ));
       Session::flash('success','Update record successfully.');
       return redirect('admin/users');

     }

   }



   public function user_warn_request(Request $request)
   {

     $input = $request->all();

     if($input['warn_user_id']){

       $user = User::findOrFail($input['warn_user_id']);
       $user->warn=1;
       $user->warn_msg= $input['user_warn_msg'];  
       $user->updated_at=Carbon::now();
       $user->save();

       $getUserDetails = getUserDetails($input['warn_user_id']);     

       $slug = 'warn/user';
       $message = $input['user_warn_msg'];      
       $uid = $getUserDetails->_uid;   
       $status = 1; 
       $action = url('/').'/@'.$getUserDetails->username;
       $is_read = 0;
       $users__id = $input['warn_user_id'];
       notificationUserLog($uid,$slug,$status,$message,$action,$is_read,$users__id,"");

       Session::flash('success','Successfully warn to user.');
       return redirect('admin/reports');

     }
   }

   public function delete_user($id){
     $user = User::findOrFail($id);
     $user->is_verified=3;
     $user->updated_at=Carbon::now();
     $user->save();

     // $user->delete();
     // UserProfile::where('users__id',$id)->delete();
     Session::flash('success','Successfully deleted.');
     return redirect('admin/reports');
   }


   public function no_action($id){
     $user = AbuseReportModel::findOrFail($id);
     $user->status=1;
     $user->updated_at=Carbon::now();
     $user->save();

     // $user->delete();
     // UserProfile::where('users__id',$id)->delete();
     Session::flash('success','Successfully performed action.');
     return redirect('admin/reports');
   }

   public function delete_action($id){
     $user = AbuseReportModel::findOrFail($id);
     $user->delete();

     // $user->delete();
     // UserProfile::where('users__id',$id)->delete();
     Session::flash('success','Successfully deleted.');
     return redirect('admin/reports');
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

