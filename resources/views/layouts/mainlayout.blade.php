<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>4BookRent | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset ('assets/css/style.css') }}" rel="stylesheet">

    
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-secondary position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar">
                <a href="#" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa-solid fa-book fa-fw me-2"></i>4BookRent</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <i class="fa-solid fa-circle-user fa-2xl"></i>
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-dark">
                            @if (Auth::user())
                                {{(Auth::user()->username)}}</h6>
                            @endif
                        <span>
                            @if (Auth::user())
                                @if (Auth::user()->role_id == 1)
                                    Admin
                                @else
                                    User
                                @endif
                            @endif
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    @if (Auth::user())
                        @if (Auth::user()->role_id == 1)
                            <a href="/dashboard" class="nav-item nav-link {{ Request::is('dashboard') ? 'active':'' }}"><i class="fa-solid fa-gauge-high fa-fw me-2"></i>Dashboard</a>
                            <a href="/book-list" class="nav-item nav-link {{ Request::is('book-list') ? 'active':'' }}"><i class="fa-solid fa-lines-leaning fa-fw me-2"></i>Books</a>
                            <a href="/category" class="nav-item nav-link {{ Request::is('category') ? 'active':'' }}"><i class="fa-solid fa-layer-group fa-fw me-2"></i>Categories</a>
                            <a href="/users" class="nav-item nav-link @if (request()->route()->uri == 'users' || request()->route()->uri == 'users-banned' || request()->route()->uri == 'registered-users' || request()->route()->uri == 'user-detail/{slug}') active @endif"><i class="fa-solid fa-users fa-fw me-2"></i>Users</a>
                            <a href="/rent-logs" class="nav-item nav-link {{ Request::is('rent-logs') ? 'active':'' }}"><i class="fa-solid fa-clipboard-list fa-fw me-2"></i>Rent Log</a>
                            <a href="/books" class="nav-item nav-link {{ Request::is('books', 'deleted-list-book') ? 'active':'' }}"><i class="fa-solid fa-list-ul fa-fw me-2"></i>Book List</a>
                            <a href="/book-rent" class="nav-item nav-link {{ Request::is('book-rent') ? 'active':'' }}"><i class="fa-solid fa-book-open-reader fa-fw me-2"></i>Book Rent</a>
                            <a href="/book-return" class="nav-item nav-link {{ Request::is('book-return') ? 'active':'' }}"><i class="fa-solid fa-rotate-left fa-fw me-2"></i>Book Return</a>
                        @else
                            <a href="/book-list" class="nav-item nav-link {{ Request::is('book-list') ? 'active':'' }}"><i class="fa-solid fa-lines-leaning fa-fw me-2"></i>Books</a>
                            <a href="/rent-logs-user" class="nav-item nav-link {{ Request::is('rent-logs-user') ? 'active':'' }}"><i class="fa-solid fa-clipboard-list fa-fw me-2"></i>Rent Log</a>
                            <a href="/profile" class="nav-item nav-link {{ Request::is('profile') ? 'active':'' }}"><i class="fa-solid fa-user fa-fw me-2"></i>Profile</a>
                        @endif
                    @endif
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand sticky-top px-4 py-0">
                <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa-solid fa-book fa-fw me-2"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-circle-user fa-xl"></i>
                            <span>
                                @if (Auth::user())
                                    {{(Auth::user()->username)}}</h6>
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0">
                            @if (Auth::user())
                                @if (Auth::user()->role_id == 2)
                                <a href="profile" class="dropdown-item"><i class="fa-solid fa-user fa-fw me-2"></i>My Profile</a>
                                @endif
                            @endif
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout"><i class="fa-solid fa-right-from-bracket fa-fw me-2"></i>Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Modal Logout -->
            <form action="/logout" method="post">
                @csrf
            <div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content bg-light">
                    <div class="modal-header">
                      <h3 class="modal-title text-dark" id="logout">Logout</h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <h5>Are you sure you want to logout ?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <input type="submit" class="btn btn-danger" name="Logout" value="Logout">
                    </div>
                  </div>
                </div>
            </div>
            </form>
            <!-- Modal Logout end -->

            @yield('content')


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">4BookRent</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


    </div>


    <!-- JavaScript Libraries -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>