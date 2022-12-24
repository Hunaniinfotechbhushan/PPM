@extends('layouts.backend.master')
@section('content')
 <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">User / <strong class="text-primary small">{{ $users->username }}</strong></h3>
                                            <div class="nk-block-des text-soft">
                                                <ul class="list-inline">
                                                    <li>User ID: <span class="text-base">UD - {{ $users->_id }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <a href="{{ url('admin/users') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                            <a href="html/user-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card">
                                        <div class="card-aside-wrap">
                                            <div class="card-content">
                                              
                                                <div class="card-inner">
                                                    <div class="nk-block">
                                                        <div class="nk-block-head">
                                                            <h5 class="title">User Information</h5>
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
                                                                    <span class="profile-ud-value">{{ $users->username }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Email</span>
                                                                    <span class="profile-ud-value">{{ $users->email }}</span>
                                                                </div>
                                                            </div>

                                                                <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Status</span>
                                                                    <span class="profile-ud-value">@if($users->user_account == 1) Premium @else Standard @endif</span>
                                                                </div>
                                                            </div>

                                                                    <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Verification</span>
                                                                    <span class="profile-ud-value">
                                                                          <span class="tb-sub">   
                                        @if($users->is_verified == 1)
                                         <span class="tb-status text-success">Verified</span>  
                                         @elseif($users->is_verified == 0) 
                                         <span class="tb-status text-warning">Not Verified</span>     
                                         @else
                                         <span class="tb-status text-danger">Rejected</span>                                              

                                     @endif</span>
                                                                    </span>
                                                                </div>
                                                            </div>


                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Gender</span>
                                                                    <span class="profile-ud-value">@if($users->gender_selection == 1) Man @else Woman @endif</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Location</span>
                                                                    <span class="profile-ud-value">{{ $users->city }}</span>
                                                                </div>
                                                            </div>
                                                                                                                
                                                               <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Created Date</span>
                                                                    <span class="profile-ud-value">{{ $users->created_at }}</span>
                                                                </div>
                                                            </div>

                                                        </div><!-- .profile-ud-list -->
                                                    </div><!-- .nk-block -->
                                           
                                                
                                                </div><!-- .card-inner -->
                                            </div><!-- .card-content -->
                                        
                                        </div><!-- .card-aside-wrap -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
@stop

