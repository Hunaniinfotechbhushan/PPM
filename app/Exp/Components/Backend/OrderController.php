<?php

namespace App\Http\Controllers\backend;

use Request;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Upvote;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // $order = Order::orderBy('id','DESC')->get();

      $order = Order::select('order.*','post.QB_user_display_name')
      ->join('post', 'post.id', '=', 'order.post_id')
      ->orderBy('order.id','DESC')
      ->get();

// echo "<pre>";
// print_r($order);
// die;
      return view('backend.order.index',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('backend.order.create');
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
         'client_id' => 'required',
         'client_core' => 'required',
         'password' => 'required',
       ]);
      if( $validation->fails() ) {
       return redirect('admin/post/create')->withErrors($validation->errors());
     }
     else
     {
       $dataArray = array(
        "client_id"     =>  $input['client_id'],
        "client_core"     =>   $input['client_core'],
        "password"   =>      $input['password'],
        "status"   =>      $input['status']
      );


       Order::create($dataArray);
       Session::flash('success','Insert record successfully.');
       return redirect('admin/post');
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
      $order = Order::find($id);

      $order = Order::select('order.*','post.QB_user_display_name')
      ->join('post', 'post.id', '=', 'order.post_id')
      ->where('order.id', '=', $id)
      ->get();

      if(isset($order[0])){
        $order = $order[0];
        return view('backend.order.show',compact('order'));
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $order = Order::findOrFail($id);

      return view('backend.order.edit',compact('order'));
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
     $order = Order::findOrFail($id);
     $input = Request::all();

     $validation = Validator::make($input,
       [
         'title' => 'required',
         'body' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/clientaccount/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {


      $imageFiles = $input->file('image');

      if($imageFiles){
        $name=str_random(6).'_'.$imageFiles->getClientOriginalName();
        $imageFiles->move(public_path().'/backend/images/clientaccount/',$name);   

        $post->image=$name;
      }
      


      $post->title =$input['title'];
      $post->slug =str_slug($input['title']);
      $post->body=$input['body'];
      $post->updated_at=Carbon::now();
      $post->save();

      Session::flash('success','Update record successfully.');
      return redirect('admin/clientaccount');
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
      $order = Order::findOrFail($id);
      $order->delete();

      Session::flash('success','Deleted successfully.');
      return redirect('admin/order');
    }

    public function all_post_delete()
    {
      $order = Order::truncate();
      Comment::truncate();
      Upvote::truncate();

      Session::flash('success','Successfully deleted.');
      return redirect('admin/post');
    }


  }
