<div class="sidebar"  data-background-color="white">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ activeNav('admin.dashboard') }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item{{ activeNav(['admin.user.*','admin.employee.*']) }} ">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-users-cog"></i>
                        <p>Admin</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.user.*','admin.employee.*']) }}" id="base">
                        <ul class="nav nav-collapse">
                            @can('user-manage')
                            <li class="{{ activeSubNav('admin.user.*')}}">
                                <a href="{{ route('admin.user.index') }}">
                                    <span class="sub-item">User</span>
                                </a>
                            </li>
                            @endcan
                            @can('employee-manage')
                            <li class="{{ activeSubNav('admin.employee.*')}}">
                                <a href="{{ route('admin.employee.index') }}">
                                    <span class="sub-item">Employee</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ activeNav(['admin.employee-cat.*']) }} ">
                    <a data-toggle="collapse" href="#category">
                        <i class="fas fa-users-cog"></i>
                        <p>Category</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.employee-cat.*']) }}" id="category">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.employee-cat.*')}}">
                                <a href="{{ route('admin.employee-cat.index') }}">
                                    <span class="sub-item">Employee Category</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item {{ activeNav('admin.farm.*') }}">
                    <a href="{{ route('admin.farm.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Farm</p>
                    </a>
                </li>

                <li class="nav-item{{ activeNav(['admin.employee-cat.*']) }} ">
                    <a data-toggle="collapse" href="#people">
                        <i class="fas fa-users-cog"></i>
                        <p>People</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.supplier.*']) }}" id="people">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.supplier.*')}}">
                                <a href="{{ route('admin.supplier.index') }}">
                                    <span class="sub-item">Supplier</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ activeNav(['admin.employee-cat.*']) }} ">
                    <a data-toggle="collapse" href="#purchase">
                        <i class="fas fa-users-cog"></i>
                        <p>Purchase</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.purchase.*']) }}" id="purchase">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.purchase.*')}}">
                                <a href="{{ route('admin.purchase.create') }}">
                                    <span class="sub-item">Add Purchase</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>









                <li class="nav-item {{ activeNav(['admin.role.*','admin.backup.*','admin.visitorInfo.*','admin.permission.*']) }}">
                    <a data-toggle="collapse" href="#settings">
                        <i class="fa-solid fa-gears"></i>
                        <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{openNav(['admin.role.*','admin.backup.*','admin.visitorInfo.*','admin.permission.*'])}}" id="settings">
                        <ul class="nav nav-collapse">
                            @canany('role-manage','permission-manage')
                            <li class="{{ activeSubNav('admin.role.*','admin.permission.*')}}">
                                <a href="{{ route('admin.role.index') }}">
                                    <span class="sub-item">@lang('nav.role-permission')</span>
                                </a>
                            </li>
                            @endcanany
                            @canany('backup-manage')
                            <li class="{{ activeSubNav('admin.backup.*')}}">
                                <a href="{{ route('admin.backup.password') }}">
                                    <span class="sub-item">App Backup</span>
                                </a>
                            </li>
                            @endcanany
                            @canany('visitor-manage')
                            <li class="{{ activeSubNav('admin.visitorInfo.*')}}">
                                <a href="{{ route('admin.visitorInfo.index') }}">
                                    <span class="sub-item">Visitor Info</span>
                                </a>
                            </li>
                            @endcanany
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>


{{--
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li> --}}


                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
