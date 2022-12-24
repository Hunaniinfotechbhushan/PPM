@extends('layouts.backend.master')
@section('content')
 <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Users / <strong class="text-primary small">{{ $users->username }}</strong></h3>
                                            <div class="nk-block-des text-soft">
                                                <ul class="list-inline">
                                                    <li>User ID: <span class="text-base">UD - {{ $users->user_id }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <a href="{{ url('admin/users') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                            <a href="html/user-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                             {!! Form::model($users, ['method' => 'PATCH', 'action' => ['backend\UserRejectedProfileController@update',$users->user_id],'files'=>true]) !!}

                <div class="nk-block">
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-content">                                              
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Rejected Profiles</h5>
                                            <!-- <p>Basic info, like your name and email.</p> -->
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                                       <!--      <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Title</span>
                                                                    <span class="profile-ud-value">Mr.</span>
                                                                </div>
                                                            </div> -->
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Username</span>
                                                                    <span class="profile-ud-value"> {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'readonly' => 'true']) !!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Email</span>
                                                                    <span class="profile-ud-value">{!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly' => 'true']) !!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Gender</span>
                                                                    <span class="profile-ud-value">{!! Form::select('gender_selection',['Female','Male'], null,  ['class' => 'form-control']) !!}</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Location</span>
                                                                    <span class="profile-ud-value">{!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) !!}

                                                                    </div>
                                                                </div>

                                                                     <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Heading</span>
                                                                        <span class="profile-ud-value">{!! Form::text('heading', null, ['class' => 'form-control', 'id' => 'heading']) !!}</span>
                                                                    </div>
                                                                </div>


                                                                       <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">DOB</span>
                                                                        <span class="profile-ud-value">{!! Form::text('dob', null, ['class' => 'form-control', 'id' => 'dob']) !!}</span>
                                                                    </div>
                                                                </div>
                                                                  <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Seeking For</span>
                                                                        <span class="profile-ud-value">{!! Form::textarea('what_are_you_seeking', null, ['class' => 'form-control', 'id' => 'what_are_you_seeking']) !!}</span>
                                                                    </div>
                                                                </div>


                                                                       <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">About Me</span>
                                                                        <span class="profile-ud-value">{!! Form::textarea('about_me', null, ['class' => 'form-control', 'id' => 'about_me']) !!}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Sign up date</span>
                                                                        <span class="profile-ud-value">{{ $users->created_at }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Approval</span>
                                                                        <span class="profile-ud-value">                 {!! Form::select('is_verified',['Awaiting Approval','Approved','Rejected','Delete'], null,  ['class' => 'form-control']) !!}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                     <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label"></span>
                                                                        <span class="profile-ud-value text-center">       {!! Form::submit('Submit', ['class' => 'btn btn-primary waves-effect','id'=>'pagesubmit']) !!}
                                                                        </span>
                                                                    </div>
                                                                </div>


                                                            </div><!-- .profile-ud-list -->
                                                        </div><!-- .nk-block -->


                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-content -->

                                            </div><!-- .card-aside-wrap -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                    {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
@stop

