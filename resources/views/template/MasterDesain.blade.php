<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    @yield('meta')

    <title>@yield("title")</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" /> --}}
    <link rel="icon" type="image/x-icon" href="{{asset('img/icons/wood.png') }}"  />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/510/fabric.min.js"></script>
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
    <link rel="stylesheet" href="{{asset('vendor/css/core.css')}}"  />
    <link rel="stylesheet" href="{{asset('vendor/css/theme-default.css')}}"  />
    <link rel="stylesheet" href="{{asset('css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('js/config.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
    {{-- <script src="{{asset('js/jquery-1.12.0.min.js')}}" language="javascript"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}

    {{-- data Table --}}

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css"> --}}
    <script src="{{asset('js/jquery-1.12.0.min.js')}}" language="javascript"></script>
<link href='http://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css' type='text/css' rel='stylesheet'>
<script src='http://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js' language='javascript'></script>

    @yield('style')
  </head>

  <body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @yield('sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @yield('navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          @yield('content')
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('sweetalert::alert')



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    {{-- <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{asset('vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    {{-- data table  --}}
        {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.js"></script> --}}
    <link href='http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>
    <script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>

    <script src="{{asset('vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('js/extended-ui-perfect-scrollbar.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- fabric js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/510/fabric.min.js"></script>




    @yield('script')


  </body>
</html>
