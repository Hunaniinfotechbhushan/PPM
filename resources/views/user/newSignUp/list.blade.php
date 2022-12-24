@section('page-title', __tr("Manage Users"))
@section('head-title', __tr("Manage Users"))
@section('keywordName', strip_tags(__tr("Manage Users")))
@section('keyword', strip_tags(__tr("Manage Users")))
@section('description', strip_tags(__tr("Manage Users")))
@section('keywordDescription', strip_tags(__tr("Manage Users")))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<?php $userStatus = request()->status; ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<div class="row">
	<div class="col-xl-12">

		<div class="section-table-title">User Listing</div>
		<!-- card -->
		<div class="card mb-4">
			<!-- card body -->
			<div class="card-body">                            
           
                <div class="lw-nav-content">

					<table id="example" class="table table-hover">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Username</th>
								<th>Email</th>
								<th>Status</th>
								<th>Gender</th>
								<th>Location</th>
								<th>Sign up date</th>
								<th>Approval</th>
								<th><font color="red">Action</font></th>
							</tr>
						</thead>
						<tbody>
							@forelse($userData as $key=>$value)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $value->username }}</td>
								<td>{{ $value->email }}</td>
								<td>@if($value->user_account == 1) Standard @else Premium @endif</td>
								<td>@if($value->gender_selection == 1) Man @else Woman @endif </td>
								<td>{{ $value->city }}</td>
								<td>{{ $value->created_at }}</td>
								<td>@if($value->is_verified == 1) <span class="">Verified</span> @else <span class="">Not Verify</span> @endif</td>
					     		<td>
					     			<div class="btn-group">
									<button type="button" class="btn btn-black dropdown-toggle lw-datatable-action-dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<!-- Edit Button -->				
                                	<a class="dropdown-item" href="{{ url('/')}}/admin/manage/user/{{ $value->user_authority_id }}/edit"><i class="far fa-edit"></i> <?= __tr('Edit') ?></a>
										<!-- /Edit Button -->


										@if($value->is_verified != 1)
										<!-- Verify User -->

											<a class="dropdown-item" href="{{ url('/')}}/admin/manage/user/{{ $value->user_authority_id }}/verify-profile" data-method="post"><i class="fas fa-user-check"></i> <?= __tr('Verify') ?></a>

										<!-- /Verify User -->
										@endif
									
										<a class="dropdown-item" href="{{ url('/')}}/admin/manage/user/{{ $value->user_authority_id }}/process-permanent-delete"><i class="fas fa-trash-alt"></i> <?= __tr('Delete') ?></a>
									

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


	</div>
</div>
@push('appScripts')

<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>

	$(document).ready(function () {
		$('#example').DataTable();
	});
</script>
@endpush