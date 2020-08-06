<!DOCTYPE html>
<html>

<head>
    @include('layouts.admin._header')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.admin._navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.admin._sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('layouts.admin._footer')
</body>

</html>