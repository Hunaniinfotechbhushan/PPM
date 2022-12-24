<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-200"><?= __tr('Add New Team Member') ?></h1>
	<!-- back button -->
<a class="btn btn-light btn-sm" href="{{ url('admin/manage/team') }}">
		<i class="fa fa-arrow-left" aria-hidden="true"></i> <?= __tr('Back to Team') ?>
	</a>
	<!-- /back button -->
</div>
<!-- Page Heading -->

<!-- Start of Page Wrapper -->
 <div class="row">
	<div class="col-xl-12 mb-4">
        <!-- card -->
		<div class="card mb-4">
            <!-- card body -->
			<div class="card-body">
			  {!! Form::open(['action' => '\App\Exp\Components\Team\Controllers\TeamController@store','id' => 'form_validation','files'=>true]) !!}
             @include('team.manage.form', ['submitButtonText' => 'Submit'])
             {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>