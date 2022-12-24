<!-- Sidebar -->
<style type="text/css">



</style>
<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>">
        <div class="sidebar-brand-icon">
            <img src="{{ url('/') }}/media-storage/logo/logo.png" alt="<?= getStoreSettings('name') ?>">
        </div>
        <img class="lw-logo-img" src="{{ url('/') }}/media-storage/logo/logo.png" alt="<?= getStoreSettings('name') ?>">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= makeLinkActive('manage.dashboard') ?> mt-2">
        <a class="nav-link" href="<?= route('manage.dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?= __tr( 'Dashboard' ) ?></span>
        </a>
    </li>

       <li class="nav-item <?= makeLinkActive('manage.user.newSignUpList') ?>">
        <a class="nav-link" href="<?= route('manage.user.newSignUpList', ['status' => 1]) ?>">
            <i class="fas fa-users"></i>
            <span><?= __tr('New Sign Ups') ?></span>
        </a>
    </li> 
    
    <li class="nav-item <?= makeLinkActive('manage.user.view_list') ?>">
        <a class="nav-link" href="<?= route('manage.user.view_list', ['status' => 1]) ?>">
            <i class="fas fa-users"></i>
            <span><?= __tr('Users') ?></span>
        </a>
    </li> 



    <li data-toggle="collapse" data-target="#team-section" class="nav-item mt-2">
        <a class="nav-link" href="#">
            <i class="fas fa-users"></i>
            <span><?= __tr('Team') ?></span>
        </a>
    </li>

    <ul class="sub-menu collapse" id="team-section">
        <li class="nav-item mt-2">
            <a class="nav-link" href="{{ url('admin/team') }}">
                <i class="fas fa-users"></i>
                <span><?= __tr('Team Listing') ?></span>
            </a>
        </li>

        <li class="nav-item mt-2">
            <a class="nav-link" href="{{ url('admin/team/create') }}">
                <i class="fas fa-users"></i>
                <span><?= __tr('Team Add') ?></span>
            </a>
        </li>
    </ul>


     <li class="nav-item <?= makeLinkActive('manage.user.view_list') ?>">
        <a class="nav-link" href="{{ url('admin/member-media') }}">
            <i class="fas fa-users"></i>
            <span><?= __tr('Member Media') ?></span>
        </a>
    </li> 


    <li class="nav-item">
        <a class="nav-link" title="<?= __tr("If you have made changes which doesn't reflecting this link may help to clear all the cache.") ?>" href="<?= route('manage.configuration.clear_cache', []).'?redirectTo='.base64_encode(Request::fullUrl()); ?>">
            <i class="fas fa-broom"></i>
            <span><?= __tr('Clear System Cache') ?></span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->