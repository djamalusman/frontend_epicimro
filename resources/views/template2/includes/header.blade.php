 <!-- Preloader Start -->
 <div id="preloader-active">
     <div class="preloader d-flex align-items-center justify-content-center">
         <div class="preloader-inner position-relative">
             {{-- <div class="text-center">
				<img src="{{ asset('assets/imgs/theme/loading.gif')}}" alt="jobhub" />
			</div> --}}
         </div>
     </div>
 </div>
 <header class="header sticky-bar">
     <div class="container">
         <div class="main-header">
             <div class="header-left">
                 <div class="header-logo">
                     <a href="/" class="d-flex">
                         <img alt="jobhub"
                             src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($dataTk->item_file_2 ?? '')) }}" />

                     </a>
                 </div>
                 <div class="header-nav">
                     <nav class="nav-main-menu d-none d-xl-block">
                         <ul class="main-menu">
                             <li class="has">
                                 <a class="active" href="{{ route('welcome') }}">Home</a>
                             </li>

                             <li class="has">
                                 <a href="{{ route('course-grid') }}">Training</a>
                             </li>
                             <li class="has">
                                 <a href="{{ route('job-grid') }}">Jobs</a>
                             </li>
                             <li class="has">
                                 <a href="{{ route('news-list') }}">News</a>
                             </li>
                             <li class="has">
                                 <a href="{{ route('certification') }}">Certificate</a>
                             </li>

                             <li class="has">
                                 <a href="{{ route('registration') }}">Join Us</a>
                             </li>

                         </ul>
                     </nav>
                     <div class="burger-icon burger-icon-white">
                         <span class="burger-icon-top"></span>
                         <span class="burger-icon-mid"></span>
                         <span class="burger-icon-bottom"></span>
                     </div>
                 </div>
             </div>

         </div>


     </div>
 </header>

 <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
     <div class="mobile-header-wrapper-inner">
         <div class="mobile-header-top">
             <div class="user-account">
                 <div class="content">
                     <h4><b>Menu</b></h4>
                 </div>
             </div>
             <div class="burger-icon burger-icon-white">
                 <span class="burger-icon-top"></span>
                 <span class="burger-icon-mid"></span>
                 <span class="burger-icon-bottom"></span>
             </div>
         </div>
         <div class="mobile-header-content-area">
             <div class="perfect-scroll">

                 <div class="mobile-menu-wrap mobile-header-border">
                     <!-- mobile menu start -->
                     <nav>
                         <ul class="mobile-menu font-heading">
                             <li class="has">
                                 <a href="{{ route('course-grid') }}">Training</a>
                             </li>
                             <li class="has">
                                 <a href="{{ route('job-grid') }}">Jobs</a>
                             </li>
                             <li class="has">
                                 <a href="{{ route('news-list') }}">News</a>
                             </li>

                             <li class="has">
                                 <a href="{{ route('certification') }}">Certificate</a>
                             </li>
                             <li class="has">
                                 <a href="{{ route('registration') }}">Join Us</a>
                             </li>

                         </ul>
                     </nav>
                     <!-- mobile menu end -->
                 </div>


                 <div class="site-copyright">Copyright 2024 © Training Kerja</div>
             </div>
         </div>
     </div>
 </div>

 <!--End header-->
