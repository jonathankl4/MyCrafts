<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('meta')
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('shop/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('shop/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('shop/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('shop/css/style.css') }}" rel="stylesheet">

    {{-- data table  --}}
    <script src="{{ asset('js/jquery-1.12.0.min.js') }}" language="javascript"></script>
    <link href='http://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css' type='text/css' rel='stylesheet'>
    <script src='http://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js' language='javascript'></script>

    {{-- untuk save canvas  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>



    @yield('style')
</head>

<body>

    <!-- Spinner Start -->
    <div id="loadingScreen" style="display: none;">
        <div class="overlay" style="position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;"></div>
        <div class="spinner" style="position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            color: white;
            z-index: 9999;">
            <!-- Ini adalah simbol loading, bisa berupa animasi GIF atau CSS spinner -->
            Loading...
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top" style="z-index: 2">
        <div class="container topbar bg-dark d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas  me-2 text-secondary"></i> <a href="#"
                            class="text-white">Selamat datang di MyCrafts, {{ $user->username }} </a></small>

                </div>
                <div class="top-link pe-2">
                    {{-- top info jika user belum melakukan login --}}
                    @if ($user->role == 'guest')
                        <small class="text-white mx-2">Daftarkan dirimu jika belum</small>

                        {{-- top info jika user sudah melakukan login  --}}
                    @else
                        <small class="text-white mx-2">Selamat Berbelanja</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <h1 class=" display-6">MyCrafts</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        {{-- <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="shop.html" class="nav-item nav-link">Shop</a>
                            <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="cart.html" class="dropdown-item">Cart</a>
                                    <a href="chackout.html" class="dropdown-item">Chackout</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a> --}}
                    </div>
                    <div class="d-flex m-3 me-0">

                        {{-- <a href="" class="btn " style="background-color: #b39368 ;color: black">Custom Meja/Lemari</a> --}}
                        &nbsp;
                        &nbsp;
                        <button class="btn-search btn border border-dark btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                class="fas fa-search text-dark"></i></button>
                        {{-- navbar jika belum login  --}}
                        @if ($user->role == 'guest')
                            <a href="{{ url('/register') }}" class="btn btn-dark">Daftar</a>
                            &nbsp;
                            <a href="{{ url('/login') }}" class="btn btn-dark">Masuk</a>


                            {{-- navbar jika sudah login  --}}
                        @else
                            {{-- search  --}}

                            {{-- shopping cart  --}}
                            <a href="{{ url('/customer/pembelian') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x text-dark"></i>
                                {{-- <span class="position-absolute bg-danger rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">0</span> --}}
                            </a>
                            {{-- profile  --}}
                            <a href="#" class="my-auto" data-bs-toggle="dropdown">
                                <i class="fas fa-user fa-2x text-dark"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="" alt class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">{{ $user->username }}</span>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/seller') }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="" alt class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">Seller</span>

                                            </div>
                                        </div>
                                    </a>
                                </li>


                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" style="background: transparent; border:none">
                                            <a class="dropdown-item">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Log Out </span>
                                            </a>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @endif




                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/anjaybisa" method="get">
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            @csrf
                            <input type="search" class="form-control p-3" placeholder="keywords"
                                aria-describedby="search-icon-1">
                            <button style="border: transparent"><span id="search-icon-1"
                                    class="input-group-text p-3"><i class="fa fa-search"></i></span></button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    @yield('content')
    <!-- Hero Start -->

    <!-- Hero End -->


    <!-- Featurs Section Start -->

    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->

    <!-- Fruits Shop End-->


    <!-- Featurs Start -->

    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->

    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->

    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->

    <!-- Bestsaler Product End -->


    <!-- Fact Start -->

    <!-- Fact Start -->


    <!-- Tastimonial Start -->

    <!-- Tastimonial End -->


    <!-- Footer Start -->

    <!-- Footer End -->

    <!-- Copyright Start -->

    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    @include('sweetalert::alert')

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('shop/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('shop/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('shop/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('shop/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('shop/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- data table  --}}
    <link href='http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>
    <script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/510/fabric.min.js"></script>

    @yield('script')
</body>

</html>
