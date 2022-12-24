<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exp\Components\Event\Models\Event;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Upvote;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('asdsajvbdhjbs');
        $dtSub1Minute = Carbon::now()->subMinutes(1)->toDateTimeString();
        $userOnline = DB::table('user_authorities')
        ->join('users','user_authorities.users__id','=','users._id')
        ->where('users.role',2)
        ->where('user_authorities.updated_at','>',$dtSub1Minute)
        ->count();
        $user = User::where('role','2')->where('role','2')->count();
        $event = Event::count();
        $newReport = DB::table('abuse_reports')->where('status','0')->count();
        $userDeleted = User::where('role','2')->where('is_verified','3')->count();
       return view('backend.index',compact('userOnline','user','event','userDeleted','newReport'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
