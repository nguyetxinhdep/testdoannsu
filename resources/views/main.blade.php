
<!DOCTYPE html>
<html lang="en">
<head>
  @include('head')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->


            <!-- Messages Dropdown Menu -->
        
            <!-- Notifications Dropdown Menu -->
        
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                @auth
                    <a class="nav-link"  href="/admin/logout" role="button">
                        Đăng xuất
                    </a>
                @endauth
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('alert')
                <div class="row">
                <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>
                            {{-- Nội dung --}}
                            <div id="responseMessage" style="display: none;"></div>
                            @yield('content')
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        {{-- thông báo tin nhắn mới --}}
        <div id="messagealertsend">
            {{-- <div class="alert alert-dark" role="alert">
                A simple dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
            </div> --}}
        </div>
    </div>


    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>


    <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

@include('footer')
@stack('scripts')
</body>
</html>
