<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('dashboard/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('dashboard/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    {{-- ANIMASI TEKS --}}
    <style>
        #hello-text {
            position: relative;
            animation: slideRight 5s linear infinite;
        }

        @keyframes slideRight {
            from { left: -100%; }
            to { left: 100%; }
        }
    </style>
    {{-- Animasi Teks End --}}

    <!-- ======= Header ======= -->
    @include('layouts.include.navbar')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @if (Auth::user()->role == 'admin')
        @include('layouts.include.sidebar.admin')
    @else
        @include('layouts.include.sidebar.user')
    @endif
    <!-- End Sidebar-->

    <main id="main" class="main">
        {{-- Handle Error --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h4 class="alert-heading">There's something wrong!</h4>
                <hr>
                <p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </p>
            </div>
        @endif

        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.include.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('dashboard/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/php-email-form/validate.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        //sweetalert for success or error message
        @if (session()->has('success'))
            swal({
                type: "success",
                icon: "success",
                title: "BERHASIL!",
                text: "{{ session('success') }}",
                timer: 5000,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @elseif (session()->has('error'))
            swal({
                type: "error",
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                timer: 5000,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @elseif (session()->has('info'))
            swal({
                type: "info",
                icon: "info",
                title: "INFO!",
                text: "{{ session('info') }}",
                timer: 5000,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @endif
    </script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

</body>

</html>
