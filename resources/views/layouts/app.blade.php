<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <!-- Default Meta -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Default Title')</title>

        <!-- Dynamic Meta Section -->
        @yield('meta')

        <!-- Styles -->
        @include('includes.style')
    </head>
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
