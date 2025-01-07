<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets2/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/modules/fontawesome/css/all.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets2/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

</head>

<body style="background-color: white;">
    <!-- Preloader Start -->
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('template2.includes.navbar')
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('template2.includes.sidebar')
            </div>
            <!--End header-->
            <!-- Content -->
            <main class="main-content">
                @yield('content')
            </main>
            @include('template2.includes.footer')
        </div>
    </div>
    <!-- End Content -->

    @include('template2.includes.script')
</body>

</html>
