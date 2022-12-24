<?php

namespace App\Http\Controllers\backend;

use Request;
use App\Models\Comment;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $comment = Comment::all();

      return view('backend.comment.index',compact('comment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('backend.comment.create');
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
       return redirect('admin/comment/create')->withErrors($validation->errors());
     }
     else
     {
       $dataArray = array(
        "client_id"     =>  $input['client_id'],
        "client_core"     =>   $input['client_core'],
        "password"   =>      $input['password'],
         "status"   =>      $input['status']
        );


       Comment::create($dataArray);
       Session::flash('success','Insert record successfully.');
       return redirect('admin/comment');
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
      $comment = Comment::find($id);

      return view('backend.comment.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comment = Comment::findOrFail($id);

      return view('backend.comment.edit',compact('comment'));
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
     $comment = Comment::findOrFail($id);
     $input = Request::all();

     $validation = Validator::make($input,
       [
       'title' => 'required',
       'body' => 'required',
       ]);

     if( $validation->fails() ) {
       return redirect('/admin/comment/'.$id.'/edit')->withErrors($validation->errors());
     }
     else
     {

      
          $imageFiles = $input->file('image');

      if($imageFiles){
        $name=str_random(6).'_'.$imageFiles->getClientOriginalName();
        $imageFiles->move(public_path().'/backend/images/comment/',$name);   

        $comment->image=$name;
      }
      


      $comment->title =$input['title'];
      $comment->slug =str_slug($input['title']);
      $comment->body=$input['body'];
      $comment->updated_at=Carbon::now();
      $comment->save();

      Session::flash('success','Update record successfully.');
      return redirect('admin/comment');
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
      $comment = Comment::findOrFail($id);
      $comment->delete();

      Session::flash('success','Deleted successfully.');
      return redirect('admin/comment');
    }
  }
