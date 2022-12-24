<?php

namespace App\Http\Controllers\backend;

use Request;
use App\Models\Package;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $package = Package::orderBy('id','DESC')->get();

      return view('backend.package.index',compact('package'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('backend.package.create');
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
       'price' => 'required',
       ]);
      if( $validation->fails() ) {
       return redirect('admin/package/create')->withErrors($validation->errors());
     }
     else
     {
       $dataArray = array(
        "name"     =>  $input['name'],
        "price"     =>   $input['price'],
        "no_of_view"     =>   $input['no_of_view'],
         "status"   =>      1
        );


       Package::create($dataArray);
       Session::flash('success','Insert record successfully.');
       return redirect('admin/package');
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
      $package = Package::find($id);

      return view('backend.package.show',compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $package = Package::findOrFail($id);

      return view('backend.package.edit',compact('package'));
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
     $package = Package::findOrFail($id);
     $input = Request::all();

     $validation = Validator::make($input,
       [
       'name' => 'required',
       'price' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/package/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {



      $package->name =$input['name'];
      $package->price=$input['price'];
      $package->no_of_view=$input['no_of_view'];
      $package->updated_at=Carbon::now();
      $package->save();

      Session::flash('success','Update record successfully.');
      return redirect('admin/package');
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
      $package = Package::findOrFail($id);
      $package->delete();

      Session::flash('success','Deleted successfully.');
      return redirect('admin/package');
    }
  }
