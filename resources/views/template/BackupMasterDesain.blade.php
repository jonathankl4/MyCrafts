<!DOCTYPE html>


<html
  lang="en"

>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield("title")</title>

    <meta name="description" content="" />


    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="../assets/img/icons/brands/ubs.png" /> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    {{-- <link rel="stylesheet" href="vendor/css/core.css" class="template-customizer-core-css" /> --}}
    <link rel="stylesheet" href="{{asset('vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('vendor/libs/apex-charts/apex-charts.css')}}"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('vendor/js/helpers.js')}}"></script>


    <script src="{{asset('js/config.js')}}"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

  </head>

  <body>

    @include('sweetalert::alert')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" > --}}


                <!--SideBar-->
                @yield("sidebar")
            {{-- </aside> --}}


            <!-- / Menu -->


                    <!-- Layout container -->
            <div class="layout-page">
	            <!-- Navbar -->

	            @yield('navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
	                <!-- Content -->
                    @yield('content')




	                <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
    <!-- / Layout page -->
        </div>






    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- DataTable -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script  src="{{asset('vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script   src="{{asset('js/main.js')}}"></script>

    <!-- Page JS -->



    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Data Table -->
    <link href='http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>
    <script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>
  </body>
</html>

