<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('backend.admin.includes.header')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    @include('backend.admin.includes.navbar')
    @include('backend.admin.includes.sidebar',[])
    <div class="content-wrapper">
        @include('backend.admin.includes.breadcum')
        @yield('content')
    </div>
    @include('backend.admin.includes.footer')
</div>
@include('backend.admin.includes.scripts')
</body>
</html>
