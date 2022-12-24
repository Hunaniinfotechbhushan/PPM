@section('page-title', __tr("Manage Users"))
@section('head-title', __tr("Manage Users"))
@section('keywordName', strip_tags(__tr("Manage Users")))
@section('keyword', strip_tags(__tr("Manage Users")))
@section('description', strip_tags(__tr("Manage Users")))
@section('keywordDescription', strip_tags(__tr("Manage Users")))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<div class="row">
	<div class="col-xl-12">

		<div class="section-table-title">Team Listing</div>
		<!-- card -->
		<div class="card mb-4">
			<!-- card body -->
			<div class="card-body">                            
				
				<!-- table start -->
				<div class="lw-nav-content">
		
					<table id="example" class="table table-hover">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Image</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Created Date</th>
								<th><font color="red">Action</font></th>
							</tr>
						</thead>
						<tbody>
							@forelse($userData as $key=>$value)
							<tr>
								<td>{{ $key+1 }}</td>
								<td> <img src="{{ asset('media-storage/admin/profile/') }}/{{ $value->profile_picture }}" alt="{{ $value->first_name }}" style="max-width: 39px;"> </td>
								<td>{{ $value->first_name }}</td>
								<td>{{ $value->last_name }}</td>
								<td>{{ $value->email }}</td>
								<td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-black dropdown-toggle lw-datatable-action-dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<!-- Edit Button -->				
											<a class="dropdown-item" href="{{ url('/')}}/admin/manage/user/{{ $value->user_authority_id }}/edit"><i class="far fa-edit"></i> <?= __tr('Edit') ?></a>
											<!-- /Edit Button -->
												<a class="" href="javascript:;" data-toggle="modal" onclick="deleteData({{$value->_id}})" data-target="#DeleteModal"><i class="fas fa-trash-alt"></i> <?= __tr('Delete') ?></a>

													

												</div>
											</div></td>
										</tr>
										@empty
										<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No records found !</td></tr>

										@endforelse
										
									</tfoot>
								</table>
								<div>
									<!-- table end -->
								</div>
								<!-- /card body -->
							</div>
							<!-- /card -->        
						</div>
					</div>
					<!-- User Soft delete Container -->

					<!-- User Permanent delete Container -->

					<!-- Pages Action Column -->

					<!-- Pages Action Column -->

					<!-- user transaction Modal-->
					
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

			@push('appScripts')

			<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
			<script>

				$(document).ready(function () {
					$('#example').DataTable();
				});

				function deleteData(id)
				{
					var id = id;
					var url = '{{ route("team.destroy", ":_id") }}';
					url = url.replace(':_id', id);
					$("#deleteForm").attr('action', url);
				}

				function formSubmit()
				{
					$("#deleteForm").submit();
				}
			</script>
			@endpush