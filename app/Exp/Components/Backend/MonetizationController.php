<?php
namespace App\Http\Controllers\backend;
use Request;
use App\Models\User;
use App\Models\Monetization;
use Auth;
use Carbon\Carbon;
use Session;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MonetizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $monetization = Monetization::where('status','=',1)->get();
      return view('backend.monetization.index',compact('monetization'));
    }


public function monetization_on($id){
   $monetization = Monetization::findOrFail($id);
    $monetization->status = 2;
      $monetization->save();
      $user = User::findOrFail($monetization->user_id);
        $user->audio_monetization_status = 'ON';
      $user->save();

     Session::flash('success','Successfully updated the status .');

      return redirect('admin/monetization');
}

public function monetization_off($id){
   $monetization = Monetization::findOrFail($id);
    $monetization->status = 0;
      $monetization->save();
      $user = User::findOrFail($monetization->user_id);
        $user->audio_monetization_status = 'OFF';
      $user->save();

     Session::flash('success','Successfully updated the status .');

      return redirect('admin/monetization');
}

}

