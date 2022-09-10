<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <title>AdminLTE 2 | Blank Page</title> --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{--<!-- Bootstrap 3.3.7 -->--}}
    @include('admin.layouts.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    @include('admin.layouts.main-header')

    @include('admin.layouts.main-sidebar')
    
    @yield('content')

    @include('admin.partials._session')

    @include('admin.layouts.footer')

</div><!-- end of wrapper -->
@include('admin.layouts.footer-scripts')
</body>
</html>
