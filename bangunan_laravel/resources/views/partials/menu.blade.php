<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('cruds.userManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('barang_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-tasks">

                            </i>
                            <p>
                                <span>{{ trans('cruds.barangManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('barang_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.barangs.index") }}" class="nav-link {{ request()->is('admin/barangs') || request()->is('admin/barangs/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-water">
            
                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.barang.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('satuan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.satuans.index") }}" class="nav-link {{ request()->is('admin/satuans') || request()->is('admin/satuans/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-fire">
            
                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.satuan.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('jenis_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.jenises.index") }}" class="nav-link {{ request()->is('admin/jenises') || request()->is('admin/jenises/*') ? 'active' : '' }}">
                                        <i class="fa-fw fab  fa-accusoft">
            
                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.jenis.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('barang_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.barangm.index") }}" class="nav-link {{ request()->is('admin/barangm') || request()->is('admin/barangm/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-download">

                            </i>
                            <p>
                                <span> Barang Masuk </span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('barang_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.barangk.index") }}" class="nav-link {{ request()->is('admin/barangk') || request()->is('admin/barangk/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-upload">

                            </i>
                            <p>
                                <span> Barang Keluar </span>
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>