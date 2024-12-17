<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-graduation-cap text-success"></i>
                </div>
                <div class="sidebar-brand-text text-success mx-3">BrainBoost</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route(Auth::user()->role == 'user' ? 'user#dashboard' : (Auth::user()->role == 'instructor' ? 'instructor#dashboard' : 'admin#dashboard')) }}">
                    <i class="fas fa-fw fa-table text-success"></i>
                    <span class="text-success">Dashboard</span>
                </a>
            </li>

            <small class="text-muted mt-3 text-capitalize mx-1">Course Manage</small>

            @if (Auth::user()->role == 'user')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user#mycourses') }}">
                        <i class="fa-solid fa-chalkboard text-success"></i>
                        <span class="text-success">My Courses</span>
                    </a>
                </li>
            @endif


            @if (Auth::user()->role == 'instructor' || Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ Auth::user()->role == 'instructor' ? route('instructor#courses') : route('course#list') }}">
                        <i class="fa-solid fa-chalkboard text-success"></i>
                        <span class="text-success">Course Manage</span>
                    </a>
                </li>
            @endif


            @if (Auth::user()->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category#list') }}"><i
                            class="fa-solid fa-plus text-success"></i>
                        <span class="text-success"> Add Category </span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('course#create') }}"><i
                            class="fa-solid fa-plus text-success"></i>
                        <span class="text-success"> Add Course </span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('instructor#add') }}"><i
                            class="fa-solid fa-plus text-success"></i> <span class="text-success"> Add
                            Instructor
                        </span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payment#list') }}"><i class="fa-solid fa-plus text-success"></i>
                        <span class="text-success"> Add Payment </span></a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ route('questions#list') }}"><i
                        class="fa-solid fa-circle-question text-success"></i> <span class="text-success"> All Question
                    </span></a>
            </li>

            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('instructor#list') }}"><i
                            class="fa-solid fa-person-chalkboard text-success"></i> <span class="text-success"> All
                            Instructor
                        </span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('enrol#list') }}"><i
                            class="fa-solid fa-list-check text-success"></i> <span class="text-success"> All
                            Enrolments </span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review#list') }}"><i
                            class="fa-solid fa-comments text-success"></i> <span class="text-success"> Reviews
                        </span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'user')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user#bookmarks') }}"><i
                            class="fa-solid fa-heart text-success"></i> <span class="text-success"> Bookmarks
                        </span></a>
                </li>
            @endif


            <li class="nav-item">
                <a class="nav-link" href="{{ route('account#changePassword') }}"><i
                        class="fa-solid fa-lock text-success"></i> <span class="text-success">Change Password
                    </span></a>
            </li>

            <li class="nav-item">
                <form action="" method="post">

                    <span class="nav-link">
                        <button type="submit" class="btn bg-success text-white"><i
                                class="fa-solid fa-right-from-bracket text-white"></i> Logout</button>
                    </span>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name ? Auth::user()->name : Auth::user()->nickname }}</span>
                                <img class="img-profile rounded-circle"
                                    src="
                                {{ asset(Auth::user()->profile ? 'profilePhoto/' . Auth::user()->profile : 'defaultProfile/profile.png') }}
                                ">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item"
                                    href="{{ Auth::user()->role == 'user' ? route('user#profile') : route('account#profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                @if (Auth::user()->role == 'superadmin')
                                    <a class="dropdown-item" href="{{ route('admin#new') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Add New Admin Account
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin#list') }}">
                                        <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Admin List
                                    </a>

                                    <a class="dropdown-item" href="{{ route('user#list') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        User List
                                    </a>
                                @endif


                                <a class="dropdown-item" href="{{ route('account#changePassword') }}">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-outline-success w-100" value="Logout">
                                    </form>
                                </span>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

    @include('sweetalert::alert')

    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function imageOnChange(event) {
            let image = document.getElementById('output');
            var reader = new FileReader();

            reader.onload = function() {
                image.src = reader.result
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>




</body>
@yield('js-script')

</html>
