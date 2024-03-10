<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('/admin_resources/image/dummy_logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="height: 33px;width: 33px;opacity: 1">
        <span class="brand-text font-weight-light">Daraaz</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fa-solid fa-house"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/admin/dashboard" class="nav-link active">
                                <i class="fa-solid fa-star ml-3"></i>
                                <p>Main</p>
                            </a>
                        </li>
                    </ul>
                </li>
{{--                model 1 starts--}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-brands fa-product-hunt"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="/" class="nav-link">
                                <i class="fa-solid fa-plus mr-2"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a href="" class="nav-link">
                                <i class="fa-solid fa-list mr-2"></i>
                                <p>Lists Products</p>
                            </a>
                        </li>
                    </ul>
                </li>
{{--                model 2 ends--}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-brands fa-product-hunt"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="/" class="nav-link">
                                <i class="fa-solid fa-plus mr-2"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a href="" class="nav-link">
                                <i class="fa-solid fa-list mr-2"></i>
                                <p>Lists Products</p>
                            </a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-header">Settings</li>
{{--                <li class="nav-item">--}}
{{--                    <a href="pages/calendar.html" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-calendar-alt"></i>--}}
{{--                        <p>--}}
{{--                            User Roles--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
