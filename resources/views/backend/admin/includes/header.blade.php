<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecommerce |@yield('header_title') </title>
  <link rel="icon" type="image/x-icon" href="{{ asset('/admin_resources/image/dummy_logo.jpg') }}">
  <!-- Google Font: Source Sans Pro -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('admin_resources/plugins/fontawesome-free/css/all.min.css') }}">
<!-- OverlayScrollbars -->
<link rel="stylesheet" href="{{ asset('admin_resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin_resources/dist/css/adminlte.min.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

    <style>
        *{
         font-family: Roboto,sans-serif;
        }
        .datatable{
            box-shadow: 0 20px 40px rgba(8, 112, 184, 0.7);
        }
        #dt-search-0{
            max-width: 160px;
        }
        p{
            font-size: 15px;
        }
    </style>
</head>
