<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    
    <!-- Theme style -->
   
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="navbar-nav pl-2">
                <!-- <ol class="breadcrumb p-0 m-0 bg-white">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol> -->
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3 avatar p-1" data-toggle="dropdown" href="#">
                        <img src="{{ isset(auth()->user()->employee) && auth()->user()->employee->employee_image ? url('/uploads//' . auth()->user()->employee->employee_image) : asset('assests/image/default.png') }}"
                            class='img-circle elevation-2' width="40" height="40" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <h4 class="h4 mb-0"><strong> </strong></h4>
                        <div class="mb-3"> </div>
                        <div class="dropdown-divider"></div>
                        <div class="  text-gray-700">
                            <h6 class="text-uppercase font-weight-bold">{{ auth()->user()->name }}</h6><small
                                class="text-uppercase">{{ auth()->user()->role }}</small>
                        </div>


                        <div class="dropdown-divider" style="margin-top: 15px"></div>
                        <a href="{{ route('admin.logout') }}" class="text-danger" style="margin-top: 15px">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        @include('notify::components.notify')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('Admin.partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding: 20px">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">

            <strong>Copyright &copy; 2024 OnlineShop All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript">
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- JavaScript files-->
    <script src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <!-- Data Tables-->
    <script src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/simple-datatables/umd/simple-datatables.js">
    </script>
    <!-- Init Charts on Homepage-->
    <script src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/chart.js/Chart.min.js"></script>

    {{-- Font Awesome Kit --}}
    <script src="https://kit.fontawesome.com/5c95e5cc68.js" crossorigin="anonymous"></script>

    <!-- Main Theme JS File-->

    <!-- Prism for syntax highlighting-->
    <script src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/prismjs/prism.js"></script>
    <script
        src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js">
    </script>
    <script
        src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/prismjs/plugins/toolbar/prism-toolbar.min.js">
    </script>
    <script
        src="https://d19m59y37dris4.cloudfront.net/bubbly/1-3-2/vendor/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js">
    </script>


    @notifyJs

     // FontAwesome CSS - loading as last, so it doesn't block rendering
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    

    <script>
        $(function() {
            setTimeout(() => {
                $('.loader').fadeOut(30); // Set an extremely quick fade-out time (e.g., 10 milliseconds)
            }, 150); // Adjust the initial delay as needed
        });
    </script>

    @stack('yourJsCode')
   
    @yield('customJs')
</body>

</html>