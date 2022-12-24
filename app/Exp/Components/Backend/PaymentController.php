<?php

namespace App\Http\Controllers\backend;

use Request;
use App\Models\Payment;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


      $payment = Payment::all();

      return view('backend.payment.index',compact('payment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $payment = Payment::find($id);

      return view('backend.payment.show',compact('payment'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $payment = Payment::findOrFail($id);
      $payment->delete();
      Session::flash('success','Successfully deleted.');
      return redirect('admin/payment');
    }
  }
