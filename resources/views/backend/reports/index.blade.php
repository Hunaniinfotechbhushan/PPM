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
                                Reports
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
                                <th class="nk-tb-col"><span>Reporter</span></th>
                                <th class="nk-tb-col"><span>Reported</span></th>
                                <th class="nk-tb-col"><span>Reason</span></th>
                                <th class="nk-tb-col"><span>Action</span></th>

                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                            <?php //echo "<pre>"; print_r($reports); die;?>
                            @forelse($reports as $key=>$value)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        {{ $key+1 }}
                                    </div>
                                </td>
                                <td class="nk-tb-col">
                                    <?php $userInfo = getUserDetails($value->by_users__id);?>
                                    <span class="tb-sub">{{ $userInfo->username }}</span>
                                </td> 

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->username }}</span> 
                                </td> 

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->reason }}</span> 
                                </td> 


                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1 my-n1">
                                        <li class="me-n1">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                 <ul class="link-list-opt no-bdr">
                                                  

                                                        <li class="Click-here" user-id="{{ $value->userId }}"><a href="#"><i class="icon ni ni-star"></i><span >Warn User</span></a></li>



                                                     
                                                     <li>  <a href="{{url('admin/report/delete')}}/{{ $value->userId }}" onclick="return confirm('Are you want to permanently delete this user ?')"><em class="icon ni ni-trash"></em><span>Delete User</span></a></li>

                                                    <li><a href="{{url('admin/report/no-action')}}/{{ $value->_id }}"><em class="icon ni ni-speed"></em><span>No action </span></a></li>

                                                     <li><a href="{{url('admin/report/delete-action')}}/{{ $value->_id }}"><em class="icon ni ni-speed"></em><span>Delete action</span></a></li>
                                                     
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
             <form action="{{ url('/')}}/admin/report/warn-user" method="post">
                @csrf
                <input type="hidden" name="warn_user_id" class="warn_user_id">
              <div class="form-group">
                <label for="email">Why its warn ?</label>
                <textarea class="form-control" name="user_warn_msg"></textarea>
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
        $('.warn_user_id').val($(this).attr('user-id'));
      $(".custom-model-popup").addClass('model-open');
  }); 
    $(".close-btn, .bg-overlay").click(function(){
      $(".custom-model-popup").removeClass('model-open');
  });


</script>

@stop

