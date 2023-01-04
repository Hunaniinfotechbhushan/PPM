 <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ url('/admin') }}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ url('/media-storage/logo/logo.png') }}" srcset="{{ url('/media-storage/logo/logo.png') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ url('/media-storage/logo/logo.png') }}" srcset="{{ url('/media-storage/logo/logo.png') }}" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="{{ url('/media-storage/logo/logo.png') }}" srcset="{{ url('/media-storage/logo/logo.png') }}" alt="logo-small"> 
                           <!--  <h3><strong>PPM</strong></h3> -->
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>

                       
                            <ul class="nk-menu">

                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">DASHBOARDS</h6>
                                </li><!-- .nk-menu-heading -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('admin') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                                        <span class="nk-menu-text"><?= __tr( 'Dashboard' ) ?></span>
                                    </a>
                                </li><!-- .nk-menu-item -->


                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/new-signup') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('New Sign Ups') ?></span>
                                    </a>
                                </li>
                                       <li class="nk-menu-item">
                                    <a href="{{ url('admin/user-rejected-profile') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Rejected Profiles') ?></span>
                                    </a>
                                </li>

                                @if(Auth::user()->role == 0)

                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                        <span class="nk-menu-text">Team</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                            <a href="{{ route('team.create')}}" class="nk-menu-link"><span class="nk-menu-text">Team Add</span></a>
                                        </li> 
                                        <li class="nk-menu-item">
                                            <a href="{{ url('admin/team') }}" class="nk-menu-link"><span class="nk-menu-text">Team Listing</span></a>
                                        </li>
                                    </ul>
                                </li>

                                @endif


                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/users') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Users') ?></span>
                                    </a>
                                </li>
                                         <li class="nk-menu-item">
                                    <a href="{{ url('admin/deleted-profiles') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Deleted Profiles') ?></span>
                                    </a>
                                </li>     
                              
                                        <li class="nk-menu-item">
                                    <a href="{{ url('admin/temp-block-users') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Temporary Block') ?></span>
                                    </a>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/reports') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-view-row-wd"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Reports') ?></span>
                                    </a>
                                </li>
                                        <li class="nk-menu-item">
                                    <a href="{{ url('admin/warned-users') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Warned users') ?></span>
                                    </a>
                                </li>

                                            <li class="nk-menu-item">
                                    <a href="{{ url('admin/disable-profile') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Disabled profiles') ?></span>
                                    </a>
                                </li>

                                       <li class="nk-menu-item">
                                    <a href="{{ url('admin/description') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Description') ?></span>
                                    </a>
                                </li>


                                       <li class="nk-menu-item">
                                    <a href="{{ url('admin/media') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Media') ?></span>
                                    </a>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/events') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-send"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Events') ?></span>
                                    </a>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/update-events') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-send"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Update Events') ?></span>
                                    </a>
                                </li>
                                
                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/rejected-events') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-send"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Rejected Events') ?></span>
                                    </a>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="{{ url('admin/verifications-video') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-video-fill"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Verifications Video') ?></span>
                                    </a>
                                </li>

                                             <li class="nk-menu-item">
                                    <a href="{{ url('admin/verifications-social-media') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-video-fill"></em></span>
                                        <span class="nk-menu-text"><?= __tr('Verifications Social Media') ?></span>
                                    </a>
                                </li>




                                
                            </ul><!-- .nk-menu -->
                         
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
