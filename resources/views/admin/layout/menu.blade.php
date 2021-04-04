<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{url('/')}}/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('/')}}/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('admin.dashboard')
                        </p>
                    </a>
                </li>
                @if(auth()->user()->hasPermission('read_users'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                @lang('admin.users')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.users')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.users.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.add')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_categories'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                @lang('admin.categories')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.categories.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.categories')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.categories.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.add')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_products'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                @lang('admin.products')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.products.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.products')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.products.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.add')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if(auth()->user()->hasPermission('read_clients'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                @lang('admin.clients')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.clients.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.clients')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.clients.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.add')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_orders'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                @lang('admin.orders')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.orders')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.orders.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('admin.add')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
