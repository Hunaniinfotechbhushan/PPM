<?php
namespace App\Exp\Components\Backend;
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



class UserController extends Controller

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
    ->where('users.is_verified', 0)
    ->select('users.*','user_profiles.*','user_authorities._id AS user_authority_id','user_authorities.user_roles__id')
    ->orderBy('users.is_verified','ASC')
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



       // $imageFiles = Input::file('image');



       // if(isset($imageFiles))

       // {

       //   $name=str_random(6).'_'.$imageFiles->getClientOriginalName();

       //   $imageFiles->move(public_path().'/backend/images/blog/',$name);  

       //   $imagedata = $name;  



       // }

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



     $users = User::findOrFail($id);

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

      die('hgfhg');

      $users = User::findOrFail($id);

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

       'name' => 'required',

       'email' => 'required',

       ]);



     if( $validation->fails() ) {

       return redirect('/admin/users/'.$id.'/edit')->withErrors($validation->errors());

     }

     else

     {



       $user->name =$input['name'];

       $user->email=$input['email'];

      // $blog->image=$imagedata;

       $user->updated_at=Carbon::now();

       $user->save();



       Session::flash('success','Update record successfully.');

       return redirect('admin/users');

     }

   }

public function delete_user($id){
   $user = User::findOrFail($id);

      $user->delete();

      Session::flash('success','Successfully deleted.');

      return redirect('admin/users');
}


public function processUpdateUser($userUid,Request $request){

   $userDetails =  User::where('_id', $userId)->first();

        // check if user details exists
        if (__isEmpty($userDetails)) {
            return $this->engineReaction(18, ['show_message' => true], __tr('User does not exists.'));
        }

        // Prepare Update User data
        $updateData = [
            'first_name'        => $inputData['first_name'],
            'last_name'         => $inputData['last_name'],
            'email'             => $inputData['email'],
            'username'          => $inputData['username'],
            'designation'       => array_get($inputData, 'designation'),
            'mobile_number'     => $inputData['mobile_number'],
            'status'            => array_get($inputData, 'status', 2)
        ];
        
        // check if user updated 
        if ($this->manageUserRepository->updateUser($userDetails, $updateData)) {
            // Adding activity log for update user
            activityLog($userDetails->first_name.' '.$userDetails->last_name.' user info updated.');
            return $this->engineReaction(1, ['show_message' => true], __tr('User updated successfully.'));
        }

        return $this->engineReaction(14, ['show_message' => true], __tr('Nothing updated.'));
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

