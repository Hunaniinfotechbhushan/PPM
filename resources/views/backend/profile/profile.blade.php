@extends('layouts.backend.master')
@section('content')
<div class="nk-content">
  <div class="container-fluid">
    <div class="nk-content-inner">
      <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
            <div class="nk-block-head-content">
              <h3 class="nk-block-title page-title">User Profile</h3>

              
            </div><!-- .nk-block-head-content -->

          </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">


          <div class="card">
            @include('backend.flash-message')
            <div class="card-inner">
              <div class="nk-block">
                <div class="card">
                  <div class="card-aside-wrap">
                    <div class="card-inner card-inner-lg profile-setting-section">
                      <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                          <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Profile Setting</h4>
                            <div class="nk-block-des">
                              <p>Basic info, like your name and eamil, that you use on Nio Platform.</p>
                            </div>
                          </div>
                          <div class="nk-block-head-content align-self-start d-lg-none">
                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                          </div>
                        </div>
                      </div><!-- .nk-block-head -->
                      <div class="nk-block">
                        <div class="nk-data data-list">
                          <div class="data-head">
                            <h6 class="overline-title">Basics</h6>
                          </div>
                          <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                            <div class="data-col">
                              <span class="data-label">Name</span>
                              <span class="data-value">{{ Auth::user()->firstname }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                          </div><!-- data-item -->

                          <div class="data-item">
                            <div class="data-col">
                              <span class="data-label">Email</span>
                              <span class="data-value">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                          </div><!-- data-item -->

                          <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                            <div class="data-col">
                              <span class="data-label">Image</span>
                              <span class="tb-product">
                               @if(isset(Auth::user()->image))
                               <img src="{{ asset('public/backend/images/profile/') }}/{{ Auth::user()->image }}" class="thumb" alt="User Image">
                               @else
                               <img src="{{ asset('public/backend/images/profile/default.jpg') }}" class="thumb"alt="User Image">

                               @endif
                             </span>

                           </div>
                           <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                         </div><!-- data-item -->


                         <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                          <div class="data-col">
                            <span class="data-label">Created At</span>
                            <span class="data-value">{{ date('d M Y', strtotime(Auth::user()->name)) }}</span>
                          </div>
                          <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->

                      </div><!-- data-list -->
                      
                    </div><!-- .nk-block -->
                  </div>
                  <div class="card-inner card-inner-lg password-setting-section">
                    <div class="nk-block-head nk-block-head-lg">
                      <div class="nk-block-between">
                        <div class="nk-block-head-content">
                          <h4 class="nk-block-title">Password Setting</h4>
                          <div class="nk-block-des">
                            <p>Change your admin panel password.</p>
                          </div>
                        </div>
                        <div class="nk-block-head-content align-self-start d-lg-none">
                          <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                        </div>
                      </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                      <div class="nk-data data-list">

                       {!! Form::open(['url'=>'admin/change-password','method' => 'post']) !!}

                       <div class="data-head">
                        <h6 class="overline-title">Password</h6>
                      </div>
                      <div class="data-item">
                        <div class="data-col">
                          <span class="data-label">New Password</span>
                          <input type="password" class="form-control" id="NewPassword" name="password"  placeholder="New Password" required>

                        </div>
                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                      </div><!-- data-item -->

                      <div class="data-item">
                        <div class="data-col">
                          <span class="data-label">New Password (Confirm)</span>
                          <input type="password" class="form-control" id="NewPasswordConfirm" name="c_password" placeholder="New Password (Confirm)" required>

                        </div>
                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                      </div><!-- data-item -->


                      <div class="data-item">
                        <div class="data-col">
                          <span class="data-label"></span>
                          <button type="submit" class="btn btn-lg btn-primary">Update Password</button>

                        </div>
                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                      </div><!-- data-item -->


                      {!! Form::close() !!}
                    </div><!-- data-list -->
                    
                  </div><!-- .nk-block -->
                </div>
                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                  <div class="card-inner-group" data-simplebar>
                    <div class="card-inner">
                      <div class="user-card">
                        <div class="user-avatar bg-primary">
                         @if(isset(Auth::user()->image))
                         <img src="{{ asset('public/backend/images/profile/') }}/{{ Auth::user()->image }}" class="thumb" alt="User Image">
                         @else
                         <img src="{{ asset('public/backend/images/profile/default.jpg') }}" class="thumb"alt="User Image">

                         @endif
                         
                         <!-- <span>AB</span> -->
                       </div>
                       <div class="user-info">
                        <span class="lead-text">{{ Auth::user()->firstname }}</span>
                        <span class="sub-text">{{ Auth::user()->email }}</span>
                      </div>
                      <div class="user-action">
                        <div class="dropdown">
                          <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <ul class="link-list-opt no-bdr">
                              <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                              <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div><!-- .user-card -->
                  </div><!-- .card-inner -->

                  <div class="card-inner p-0">
                    <ul class="link-list-menu">
                      <li class="active profile-setting-tab"><a href=""><em class="icon ni ni-user-fill-c"></em><span>Profile Setting</span></a></li>
                      <li class="password-setting-tab"><a href=""><em class="icon ni ni-lock-alt-fill"></em><span>Password Setting</span></a></li>

                    </ul>


                  </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
              </div><!-- card-aside -->
            </div><!-- .card-aside-wrap -->
          </div><!-- .card -->
        </div><!-- .nk-block -->
      </div>
    </div>
  </div><!-- .nk-block -->
</div>
</div>
</div>
</div>



<script type="text/javascript">
  $(document).ready(function(){
    $('.password-setting-section').hide();

    $('.profile-setting-tab').click(function(e){
      e.preventDefault();
      $('.password-setting-section').hide();
      $('.profile-setting-section').show();
    });    
    $('.password-setting-tab').click(function(e){

      e.preventDefault();
      $('.profile-setting-section').hide();
      $('.password-setting-section').show();
    });      

  });   
</script>
@stop

