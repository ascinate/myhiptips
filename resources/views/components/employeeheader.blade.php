<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hiptips Employee Panel</title>

    <!-- plugins:css -->

    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- End layout styles -->
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

    <style type="text/css">
      .sel-btn1{
        background: rgb(88,34,195);
         background: linear-gradient(90deg, rgba(88,34,195,1) 0%, rgba(45,253,132,1) 100%);
        color: #fff;
        border: none !important;

      }
      .sel-btn2{
        background: rgb(34,193,195);
        background: linear-gradient(90deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%);
        color: #fff;
        border: none !important;

      }

      .serch-new{
        background: rgb(34,193,195);
         background: linear-gradient(90deg, rgba(34,193,195,1) 0%, rgba(45,253,132,1) 100%);
         color: #fff !important;
         text-transform: capitalize;
      }
    </style>
  </head>

  <body>
    <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{ url('/employee/dashboard') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
          </a>

          <a class="navbar-brand brand-logo-mini" href="{{ url('/employee/dashboard') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
          </a>
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="{{ url('/employee/logout') }}">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
          </ul>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      <!-- partial -->

