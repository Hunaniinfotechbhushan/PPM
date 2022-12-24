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

                             Team
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
                                <th class="nk-tb-col"><span>First Name</span></th>
                                <th class="nk-tb-col"><span>Last Name</span></th>
                                <th class="nk-tb-col"><span>Email Login</span></th>
                                <th class="nk-tb-col"><span>Password Login</span></th>
                                <th class="nk-tb-col"><span>Status</span></th>
                                <th class="nk-tb-col"><span>Created At</span></th>
                                <th class="nk-tb-col"><span>Action</span></th>

                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                            @forelse($team as $key=>$value)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        {{ $key+1 }}
                                    </div>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->first_name }}</span>
                                </td> 

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->last_name }}</span>
                                </td> 

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->email }}</span>
                                </td> 

                                <td class="nk-tb-col">
                                    <span class="tb-sub">{{ $value->login_password }}</span>
                                </td> 


                                <td class="nk-tb-col">
                                    <span class="tb-sub">

                                      @if($value->status == 1)
                                      <span class="tb-status text-success">Activate</span>  
                                      @elseif($value->status == 0) 
                                      <span class="tb-status text-warning">Freeze</span>     
                                      @else
                                      <span class="tb-status text-danger">Deleted</span>                                          
                                      @endif
                                  </span>
                              </td> 


                              <td class="nk-tb-col">
                                <span class="tb-lead">{{ date('d M Y', strtotime($value->created_at)) }}</span>


                            </td> 

                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                               <ul class="link-list-opt no-bdr">
                                                   <!-- <li><a href="{{action('backend\TeamController@show', $value->_id)}}"><em class="icon ni ni-eye"></em><span>View</span></a></li> -->
                                                   <li><a href="{{action('backend\TeamController@edit', $value->_id)}}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>

                                                   <!-- @if($value->status != 1) -->
                                                   <li><a href="{{ url('/')}}/admin/team/activate/{{ $value->_id }}"><em class="icon ni ni-speed"></em><span>Activate</span></a></li>
                                                   <!-- @endif -->
                                                   <!-- @if($value->status != 0) -->
                                                 
                                                   <!-- @endif -->
                                                   <!-- @if($value->status != 2) -->
                                                   <li><a href="{{ url('/')}}/admin/team/freeze/{{ $value->_id }}"><em class="icon ni ni-speed"></em><span>Freeze</span></a></li>

                                                    <li><a href="{{ url('/')}}/admin/team/deleted/{{ $value->_id }}"><em class="icon ni ni-speed"></em><span>Deleted</span></a></li>
                                                   <!-- @endif -->

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

