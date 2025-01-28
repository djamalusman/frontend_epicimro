<!DOCTYPE html>
<html class="no-js" lang="en">
<title>{{ $data['title'] ?? 'Default Title' }}</title>
@include('template2.includes.style')
@stack('page-specific-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body style="background-color: white;">
    <!-- Preloader Start -->
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('template2.includes.navbar')
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('template2.includes.sidebar', ['menus' => $menus])

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
    @stack('page-specific-scripts')

    @include('template2.includes.script')
</body>

</html>
