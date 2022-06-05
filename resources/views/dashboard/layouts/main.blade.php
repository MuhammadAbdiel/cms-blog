<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard | {{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    {{-- Laraberg CSS --}}
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">

    {{-- Froala Editor CSS --}}
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@4.0.8/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />

    {{-- Dragula CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/dragula/css/dragula.min.css') }}">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    @yield('style')
</head>

<body>

    @include('dashboard.layouts.header')

    @include('dashboard.layouts.sidebar')

    <main id="main" class="main">

        @yield('breadcrumb')

        <!-- End Page Title -->

        <section class="section dashboard">

            @yield('content')

            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to sign out?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary"
                                data-bs-dismiss="modal">Cancel</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Muhammad Abdiel Firjatullah</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- End main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- Froala Editor JS --}}
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@4.0.8/js/froala_editor.pkgd.min.js'>
    </script>

    {{-- React JS CDN --}}
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>

    {{-- Laraberg JS --}}
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>

    @yield('laraberg')

    {{-- Sweet Alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- Laravel File Manager --}}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    {{-- Dragula JS --}}
    <script src="{{ asset('assets/dragula/js/dragula.min.js') }}"></script>

    {{-- Sortable JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    {{-- <script src="../node_modules/sortablejs/Sortable.js"></script> --}}

    {{-- Custom JS --}}
    <script src="{{ asset('assets/dragula/js/post.js') }}"></script>
    <script src="{{ asset('assets/dragula/js/template.js') }}"></script>
    <script src="{{ asset('assets/dragula/js/user.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

    @yield('script')

    @include('sweetalert::alert')
</body>

</html>