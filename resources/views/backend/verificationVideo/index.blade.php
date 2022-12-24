@extends('layouts.backend.master')
@section('content')

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Verification Videos
                            </h3>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">


                    <div class="card">
                     @include('backend.flash-message')
                     <div class="card-inner">
                       <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">

                                <th class="nk-tb-col"><span>S.No.</span></th>
                                <th class="nk-tb-col"><span>Username</span></th>
                                <th class="nk-tb-col"><span>Status</span></th>      
                                <th class="nk-tb-col"><span>Gender</span></th>                          
                                <th class="nk-tb-col"><span>Email</span></th>
                                <th class="nk-tb-col"><span>Verification Video</span></th>
                                <th class="nk-tb-col"><span>Approval</span></th>  
                                <th class="nk-tb-col"><span>Action</span></th>

                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                            @forelse($userData as $key=>$value)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        {{ $key+1 }}
                                    </div>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->username }}</span>
                                </td> 


                                <td class="nk-tb-col">
                                    <span class="tb-sub">@if($value->user_account == 1) Premium @else Standard @endif</span>
                                </td>   

                               
                                        <td class="nk-tb-col">
                                            <span class="tb-sub">@if($value->gender_selection == 1) Man @else Woman @endif</span>
                                        </td>

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->email }}</span> 
                                    @if($value->is_email_verified)
                                    <em class="icon text-success ni ni-check-circle"></em> @endif
                                </td> 




                                <td class="nk-tb-col">
                                    <span class="tb-sub">
                                        @if(isset($value->verification_video_file))
                                        <a href="{{ url('/') }}/backend/assets/verification/{{ $value->verification_video_file }}" class="glightbox4">
                                        <em class="icon ni ni-video-fill"></em>
                                    </a>
                                        @else
                                        no file available
                                        @endif

                                    </span>
                                </td>   


                                <td class="nk-tb-col">
                                    <span class="tb-sub">   
                                        @if($value->is_verified == 1)
                                        <span class="tb-status text-success">Verified</span>  
                                        @elseif($value->is_verified == 0) 
                                        <span class="tb-status text-warning">Not Verified</span>     
                                        @else
                                        <span class="tb-status text-danger">Rejected</span>                                              

                                    @endif</span>
                                </td>  


                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1 my-n1">
                                        <li class="me-n1">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ url('/')}}/admin/approve/verifications-video/{{ $value->user_id }}"><i class="fa fa-check"></i><span>Approve video</span></a></li>

                                                        <li class="Click-here" user-id="{{ $value->user_id }}"><a href="#"><i class="fa fa-ban"></i><span >Rejected video</span></a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr><!-- .nk-tb-item -->

                            @empty
                            <tr class="nk-tb-item"><td class="nk-tb-col" valign="top" colspan="7">No records found !</td></tr>

                            @endforelse

                        </tbody>
                    </table><!-- .nk-tb-list -->

                </div>
            </div>
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
             <form action="{{ url('/')}}/admin/reject/verifications-video" method="post">
                @csrf
                <input type="hidden" name="rejected_video_user_id" class="rejected_video_user_id">
              <div class="form-group">
                <label for="email">Why its rejected ?</label>
                <textarea class="form-control" name="video_verify_reject_msg"></textarea>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form> 
    </div>
</div>  
</div>  
<div class="bg-overlay"></div>
</div> 

<script type="text/javascript">
   

    $(".Click-here").on('click', function(e) {
        e.preventDefault();
        $('.rejected_video_user_id').val($(this).attr('user-id'));
      $(".custom-model-popup").addClass('model-open');
  }); 
    $(".close-btn, .bg-overlay").click(function(){
      $(".custom-model-popup").removeClass('model-open');
  });


</script>
@stop

