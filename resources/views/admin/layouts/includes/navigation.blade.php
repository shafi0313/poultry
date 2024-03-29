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

                <li class="nav-item{{ activeNav(['admin.employee-cat.*', 'admin.expense-cat.*']) }} ">
                    <a data-toggle="collapse" href="#category">
                        <i class="fa-solid fa-list-ul"></i>
                        <p>Category</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.employee-cat.*', 'admin.expense-cat.*']) }}" id="category">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.employee-cat.index')}}">
                                <a href="{{ route('admin.employee-cat.index') }}">
                                    <span class="sub-item">Employee Category</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.expense-cat.index')}}">
                                <a href="{{ route('admin.expense-cat.index') }}">
                                    <span class="sub-item">Expense Category</span>
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

                <li class="nav-item{{ activeNav(['admin.supplier.*', 'admin.customer.*']) }} ">
                    <a data-toggle="collapse" href="#people">
                        <i class="fas fa-users-cog"></i>
                        <p>People</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.supplier.*', 'admin.customer.*']) }}" id="people">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.supplier.index')}}">
                                <a href="{{ route('admin.supplier.index') }}">
                                    <span class="sub-item">Supplier</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.customer.index')}}">
                                <a href="{{ route('admin.customer.index') }}">
                                    <span class="sub-item">Customer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ activeNav(['admin.purchase.*']) }} ">
                    <a data-toggle="collapse" href="#purchase">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Purchase</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.purchase.*']) }}" id="purchase">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.purchase.create')}}">
                                <a href="{{ route('admin.purchase.create') }}">
                                    <span class="sub-item">Add Purchase</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item{{ activeNav(['admin.sales.*']) }} ">
                    <a data-toggle="collapse" href="#sales">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Sales</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.sales.*']) }}" id="sales">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.sales.create')}}">
                                <a href="{{ route('admin.sales.create') }}">
                                    <span class="sub-item">Add Sales</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-item{{ activeNav(['admin.sales.*','admin.personal-sales.*']) }} ">
                    <a data-toggle="collapse" href="#sales">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Chicken Sales</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.sales.*','admin.personal-sales.*']) }}" id="sales">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.sales.create')}}">
                                <a href="{{ route('admin.sales.create') }}">
                                    <span class="sub-item">Add Sales</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.personal-sales.create')}}">
                                <a href="{{ route('admin.personal-sales.create') }}">
                                    <span class="sub-item">Add personal-sales</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ activeNav(['admin.daily-entry.*','admin.daily-entry-multi.*','admin.daily-entry.*']) }} ">
                    <a data-toggle="collapse" href="#dailyEntry">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <p>Daily Entry</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.daily-entry.*','admin.daily-entry-multi.*','admin.daily-entry.*']) }}" id="dailyEntry">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.daily-entry.index')}}">
                                <a href="{{ route('admin.daily-entry.index') }}">
                                    <span class="sub-item">Entry List</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.daily-entry.create')}}">
                                <a href="{{ route('admin.daily-entry.create') }}">
                                    <span class="sub-item">Entry</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.daily-entry-multi.create')}}">
                                <a href="{{ route('admin.daily-entry-multi.create') }}">
                                    <span class="sub-item">Entry All</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ activeNav(['admin.expense.*']) }} ">
                    <a data-toggle="collapse" href="#expense">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Expense</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.expense.*']) }}" id="expense">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.expense.index')}}">
                                <a href="{{ route('admin.expense.index') }}">
                                    <span class="sub-item">Expense List</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.expense.create')}}">
                                <a href="{{ route('admin.expense.create') }}">
                                    <span class="sub-item">Add Expense</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ activeNav(['admin.daily-entry.*', 'admin.report.deadFeed.*','admin.report.sales.*','admin.report.personalSales.*']) }} ">
                    <a data-toggle="collapse" href="#report">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <p>Report</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['admin.report.dailyEntry.*', 'admin.report.deadFeed.*','admin.report.sales.*','admin.report.personalSales.*']) }}" id="report">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('admin.report.dailyEntry.*')}}">
                                <a href="{{ route('admin.report.dailyEntry.select') }}">
                                    <span class="sub-item">Daily Report</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.report.deadFeed.*')}}">
                                <a href="{{ route('admin.report.deadFeed.select') }}">
                                    <span class="sub-item">Monthly Report</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.report.sales.*')}}">
                                <a href="{{ route('admin.report.sales.select') }}">
                                    <span class="sub-item">Chicken Sales</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('admin.report.personalSales.*')}}">
                                <a href="{{ route('admin.report.personalSales.select') }}">
                                    <span class="sub-item">Personal Sales</span>
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
                            {{-- @canany('role-manage','permission-manage')
                            <li class="{{ activeSubNav('admin.role.*','admin.permission.*')}}">
                                <a href="{{ route('admin.role.index') }}">
                                    <span class="sub-item">@lang('nav.role-permission')</span>
                                </a>
                            </li>
                            @endcanany --}}
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
