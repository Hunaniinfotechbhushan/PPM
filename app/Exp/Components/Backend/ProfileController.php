<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $profile = User::findOrFail(Auth::user()->id);

      return view('backend.profile.profile',compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.domain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function changePassword(Request $request){

      $request_data = $request->all();

      $validation = Validator::make($request_data,
       [
        'password' => 'min:6|required_with:c_password|same:c_password',
        'c_password' => 'min:6'
      ]);

      if( $validation->fails() ) {
       return redirect('/admin/profile/')->withErrors($validation->errors());
     }
     else
     {
      if(!empty($request_data['password'])){
        $user_id = Auth::User()->id;                       
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($request_data['password']);;
        $obj_user->save(); 
        return redirect()->back()->with('success', 'Successfully change password.'); 
      }
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
        //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
     $input = $request->all();

     

     $validation = Validator::make($request->all(),
       [
        'firstname' => 'required',
      ]);

     if( $validation->fails() ) {
       return redirect('/admin/profile/')->withErrors($validation->errors());
     }
     else
     {
      $imageFiles = $request->file('image');

      if($imageFiles){
        $name=$imageFiles->getClientOriginalName();
        $imageFiles->move(public_path().'/backend/images/profile/',$name);   

        $user->image=$name;
      }

      $user->firstname=$input['firstname'];
      $user->updated_at=Carbon::now();
      $user->save();

      Session::flash('success','Update record successfully.');
      return redirect('admin/profile');
    }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $domain = User::findOrFail($id);
     $domain->delete();
     Session::flash('success','Successfully deleted.');
     return redirect('admin/domain');
   }
 }
