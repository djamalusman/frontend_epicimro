<!DOCTYPE html>
<html class="no-js" lang="en">

   @include('includes.style')
    <body style="background-color: white;">
        <!-- Preloader Start -->
        @include('includes.header')

        <!--End header-->
        <!-- Content -->
        <main class="main">
             @yield('content')
        </main>
        <!-- End Content -->
        @include('includes.footer')
        @include('includes.script')
    </body>

</html>
