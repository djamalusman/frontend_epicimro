<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Default Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dynamic Meta Section -->
    @yield('meta')

    <!-- Styles -->
    @include('includes.style')
{{-- <style>
li {
 display: block;
 transition-duration: 0.5s;
}

li:hover {
  cursor: pointer;
}

ul li ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
}

ul li:hover > ul,
ul li ul:hover {
  visibility: visible;
  opacity: 1;
  display: block;
}

ul li ul li {
  clear: both;
  width: 100%;
}
</style> --}}
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
