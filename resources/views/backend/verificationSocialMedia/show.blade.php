@extends('layouts.backend.master')
@section('content')

<?php //echo "<pre>"; print_r($users); die;?>
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
                                    <li>User ID: <span class="text-base">UD - {{ $users->user_id }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ url('admin/verifications-social-media') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
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
                                            <h5 class="title">Social Information</h5>
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
                                                                    <span class="profile-ud-label">Media Type</span>
                                                                    <span class="profile-ud-value">{{ $users->social_type }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Social Name</span>
                                                                    <span class="profile-ud-value">{{ $users->social_name }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Social Email</span>
                                                                    <span class="profile-ud-value">{{ $users->social_email }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label">Social ID</span>
                                                                    <span class="profile-ud-value">{{ $users->social_id }}</span>
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
                                                                    <span class="profile-ud-label">Verification </span>
                                                                    <span class="profile-ud-value">

                                                                        @if($users->social_type == 'linkedin')
                                                                        <span class="tb-sub">   
                                                                            @if($users->linkedin_verify == 1)
                                                                            <span class="tb-status text-success">Verified</span>  
                                                                            @elseif($users->linkedin_verify == 0) 
                                                                            <span class="tb-status text-warning">Not Verified</span>     
                                                                            @else
                                                                            <span class="tb-status text-danger">Rejected</span>                                              

                                                                        @endif</span>

                                                                        @elseif($users->social_type == 'facebook')

                                                                        <span class="tb-sub"> 
                                                                            @if($users->facebook_verify == 1)
                                                                            <span class="tb-status text-success">Verified</span>  
                                                                            @elseif($users->facebook_verify == 0) 
                                                                            <span class="tb-status text-warning">Not Verified</span>     
                                                                            @else
                                                                            <span class="tb-status text-danger">Rejected</span>                                              

                                                                        @endif</span>
                                                                        @elseif($users->instagram_verify == 'instagram')

                                                                        <span class="tb-sub">   
                                                                            @if($users->instagram_verify == 1)
                                                                            <span class="tb-status text-success">Verified</span>  
                                                                            @elseif($users->instagram_verify == 0) 
                                                                            <span class="tb-status text-warning">Not Verified</span>     
                                                                            @else
                                                                            <span class="tb-status text-danger">Rejected</span>                                              

                                                                        @endif</span>
                                                                        @else
                                                                        @endif

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
                                                                    <span class="profile-ud-label">Created Date</span>
                                                                    <span class="profile-ud-value">{{ $users->created_at }}</span>
                                                                </div>
                                                            </div>


                                                            @if($users->social_type == 'linkedin')
                                                            <?php 
                                                            $socialMediaType= "linkedin"; 
                                                            $socialApproveLink= url('/')."/admin/approve/verifications-linkedin/".$users->user_id; 
                                                            ?>
                                                            @elseif($users->social_type == 'facebook')
                                                            <?php 
                                                            $socialMediaType= "facebook";  
                                                            $socialApproveLink= url('/')."/admin/approve/verifications-facebook/".$users->user_id; 
                                                            ?>
                                                            @elseif($users->social_type == 'instagram')
                                                            <?php 
                                                            $socialMediaType="instagram"; 
                                                            $socialApproveLink= url('/')."/admin/approve/verifications-instagram/".$users->user_id; 
                                                            ?>

                                                            @else
                                                            @endif
                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider reject_social_verification_popup" media_type="{{ $socialMediaType }}" userID="{{ $users->user_id }}">
                                                                    <span class="profile-ud-label"></span>
                                                                    <span class="profile-ud-value"><a href="" class=""><button type="button" class="btn btn-danger">Reject</button></a></span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-ud-item">
                                                                <div class="profile-ud wider">
                                                                    <span class="profile-ud-label text-success"><a href="{{ $socialApproveLink }}" class=""><button type="button" class="btn btn-success">Approve</button></a></span>
                                                                    <span class="profile-ud-value"></span>
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

                <div class="custom-model-popup">
    <div class="custom-model-inner">        
        <div class="close-btn">×</div>
        <div class="custom-model-wrap">
            <div class="pop-up-content-wrap">
             <form action="{{ url('/')}}/admin/reject/verifications-social" method="post">
                @csrf
                <input type="hidden" name="rejected_verify_user_id" class="rejected_verify_user_id">
                <input type="hidden" name="rejected_media_type" class="rejected_media_type">
              <div class="form-group">
                <label for="email">Why its rejected ?</label>
                <textarea class="form-control" name="social_verify_reject_msg"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form> 
    </div>
</div>  
</div>  
<div class="bg-overlay"></div>
</div> 



                <script type="text/javascript">

    $(".reject_social_verification_popup").on('click', function(e) {
        e.preventDefault();
        $('.rejected_verify_user_id').val($(this).attr('userID'));
        $('.rejected_media_type').val($(this).attr('media_type'));
      $(".custom-model-popup").addClass('model-open');
  }); 
    $(".close-btn, .bg-overlay").click(function(){
      $(".custom-model-popup").removeClass('model-open');
  });


</script>

                @stop

