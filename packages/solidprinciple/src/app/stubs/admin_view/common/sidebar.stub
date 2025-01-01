@php($is_dashboard=request()->getRequestUri() =='/admin/dashboard'?true:false)
@php($open_menu=$is_dashboard?'menu-open':'menu-close')
@php($active=$is_dashboard?'active':'')
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
                <li class="nav-item {{$open_menu}}">
                    <a href="#" class="nav-link {{$active}}">
                        <i class="fa-solid fa-house"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/admin/dashboard" class="nav-link {{$active}}">
                                <i class="fa-solid fa-star ml-3"></i>
                                <p>Main</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @foreach( config('sidebar') as $key => $main_link)
                    @if(isset($main_link['visibility']) && $main_link['visibility'] && isset($main_link['permission']) && $main_link['permission'])
                    @php(collect($main_link))
                    <li class="nav-item {{$main_link['active']?'menu-open':'menu-close'}}">
                        <a href="#" class="nav-link" data-model="{{$main_link['title']}}">
                            <i class="{{$main_link['icon']}}"></i>
                            <p>
                                {{$main_link['title']}}
                                <i class="fas fa-angle-left right"></i>
                                @php($modelClassName = "\App\Models\\" . $main_link['title'])
                                @php($count = $modelClassName::all()->count())
                                <span class="badge badge-info right">{{$count}} </span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                @if(count($main_link['sub_link'])>0)
                                    @foreach( $main_link['sub_link'] as $key_sub_link => $sub_link)
                                    @if($sub_link['visibility'] && $sub_link['permission'])
                                    <li class="nav-item ml-3" data-model="{{$sub_link['title']}}">
                                        <a href="{{$sub_link['route']}}" class="nav-link {{$sub_link['active']?'active':''}}">
                                            <i class="{{$sub_link['icon']}} mr-2"></i>
                                            <p style="font-size: 15px">{{$sub_link['title']}}</p>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                @endif
                        </ul>
                    </li>
                    @endif
                @endforeach
                 <li class="nav-header">SETTINGS</li>
                   <li class="nav-item">
                    <a href="#" class="nav-link" >
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                       <li class="nav-item ml-3" >
                        <a href="/admin/users/" class="nav-link">
                            <i class="nav-icon fa-solid fa-user  mr-2"></i>
                         <p>Users</p>
                         </a>
                      </li>
                        <li class="nav-item ml-3" >
                            <a href="/admin/roles/" class="nav-link">
                                <i class="nav-icon fa-solid fa-user  mr-2"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" >
                        <i class="nav-icon fa-solid fa-gear"></i>
                        <p>
                            Application Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3" >
                            <a href="/" class="nav-link">
                                <i class="fa-solid fa-f mr-2"></i>
                                <p>Frontend</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3" >
                            <a href="/" class="nav-link">
                                <i class="fa-solid fa-a mr-2"></i>
                                <p>Admin Panel</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
