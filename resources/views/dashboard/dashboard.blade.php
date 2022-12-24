@section('page-title', __tr("Dashboard"))
@section('head-title', __tr("Dashboard"))
@section('keywordName', strip_tags(__tr("Dashboard")))
@section('keyword', strip_tags(__tr("Dashboard")))
@section('description', strip_tags(__tr("Dashboard")))
@section('keywordDescription', strip_tags(__tr("Dashboard")))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-200"><?= __tr("Dashboard") ?></h1>
</div>

<!-- Counts -->
<div class="row">

    <!-- Users Online -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= __tr("Users Online") ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboardData['online'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Users Online -->

    <!-- Active Users -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?= __tr("Active Users") ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboardData['active'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Active Users -->

    <!-- Inactive Users -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?= __tr("Inactive Users") ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboardData['inactive'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-times fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Inactive Users -->

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?= __tr("Blocked Users") ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboardData['blocked'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-slash fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@push('appScripts')

@endpush