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
                                Media
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
                                 <th class="nk-tb-col"><span>File</span></th>
                                <th class="nk-tb-col"><span>Type</span></th>
                                <th class="nk-tb-col"><span>Status</span></th>
                                 <th class="nk-tb-col"><span>Gender</span></th>                                  
                                 <th class="nk-tb-col"><span>Approval</span></th> 
                                 <th class="nk-tb-col"><span>Action</span></th>

                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                            @forelse($userPhotos as $key=>$value)
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
                                    <?php 
                                    if($value->image_name){
                                        $imgURL = url('/').'/media-storage/users/'.$value->_uid.'/'.$value->image_name;
                                    }else{
                                        $imgURL =  url('/imgs/default-image.png');
                                    }
                                    if($value->video_thumbnail){
                                        $videourl = url('/').'/media-storage/users/'.$value->_uid.'/'.$value->video_thumbnail;
                                    }else{
                                        $videourl =  url('/imgs/no_thumb_image.jpg');
                                    }
                                    ?> 
                                    @if($value->extantion_type == 'mp4' || $value->extantion_type == 'MOV' || $value->extantion_type == 'wmv' || $value->extantion_type == 'WMV' || $value->extantion_type == '3gp' || $value->extantion_type == '3GP' || $value->extantion_type == 'avi' || $value->extantion_type == 'AVI' || $value->extantion_type == 'f4v' || $value->extantion_type == 'f4v' || $value->extantion_type == 'MP4' || $value->extantion_type == 'mov' || $value->extantion_type == 'webm' || $value->extantion_type == 'mkv' || $value->extantion_type == 'flv' || $value->extantion_type == 'svi' || $value->extantion_type == 'mpg'|| $value->extantion_type == 'mpeg'|| $value->extantion_type == 'amv')

                                    <a href="{{ $imgURL }}" class="glightbox4">
                                        <img class="upload-images" src="{{ $videourl }}"  style="max-width: 39px;">
                                        <!-- <div class="videoplay">
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </div> -->

                                    </a>
                                    @else
                                    <a href="{{ $imgURL }}" class="glightbox4">
                                        <img class="upload-images" src="{{ (isset($imgURL)) ? $imgURL : '' }}" style="max-width: 39px;"></a>

                                        @endif
                                    </td>

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->extantion_type }}</span>
                                </td> 

                                 <td class="nk-tb-col">
                                        <span class="tb-sub">@if($value->user_account == 1) Premium @else Standard @endif</span>
                                    </td>   
                                    
                                <td class="nk-tb-col">
                                    <span class="tb-sub">@if($value->gender_selection == 1) Man @else Woman @endif</span>
                                </td>

                                <td class="nk-tb-col">
                                    <span class="tb-sub">   
                                        @if($value->is_verified == 1)
                                        <span class="tb-status text-success">Approved</span>  
                                       @elseif($value->is_verified == 2)
                                       <span class="tb-status text-warning">Pending</span>  
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
                                                     <li><a href="{{ url('/')}}/admin/approve/photto/{{ $value->media_id }}"><i class="fa fa-check"></i><span>Approve</span></a></li>

                                                     <li><a href="{{ url('/')}}/admin/reject/photto/{{ $value->media_id }}"><i class="fa fa-ban"></i><span>Reject</span></a></li>

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

<div id="DeleteModal" class="modal fade text-danger" role="dialog">
   <div class="modal-dialog ">
     <!-- Modal content-->
     <form action="" id="deleteForm" method="post">
       <div class="modal-content">
         <div class="modal-header bg-danger">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
       </div>
       <div class="modal-body">
           {{ csrf_field() }}
           {{ method_field('DELETE') }}
           <p class="text-center">Are You Sure Want To Delete ?</p>
       </div>
       <div class="modal-footer">
           <center>
             <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
             <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
         </center>
     </div>
 </div>
</form>
</div>
</div>
<script type="text/javascript">
   function deleteData(id)
   {
     var id = id;
     var url = '{{ route("new-signup.destroy", ":id") }}';
     url = url.replace(':id', id);
     $("#deleteForm").attr('action', url);
 }

 function formSubmit()
 {
     $("#deleteForm").submit();
 }
</script>

<script type="text/javascript">
    $(document).ready(function () {
       // $('#example').DataTable();
   });
</script>
@stop

