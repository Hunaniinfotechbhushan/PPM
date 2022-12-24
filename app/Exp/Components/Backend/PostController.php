<?php

namespace App\Http\Controllers\backend;

use Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Upvote;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $post = Post::orderBy('id','DESC')->get();

      return view('backend.post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('backend.post.create');
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


       Post::create($dataArray);
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
      $post = Post::find($id);

      return view('backend.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);

      return view('backend.post.edit',compact('post'));
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
     $post = Post::findOrFail($id);
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
      $post = Post::findOrFail($id);
      $post->delete();
      Comment::where('post_id',$id)->delete();
      Upvote::where('post_id',$id)->delete();


      Session::flash('success','Deleted successfully.');
      return redirect('admin/post');
    }

    public function all_post_delete()
    {
      $order = Post::truncate();
      Comment::truncate();
      Upvote::truncate();

      Session::flash('success','Successfully deleted.');
      return redirect('admin/post');
    }


  }
