@php
    // Ambil role user yang sedang login$userRole = Auth::check() ? Auth::user()->role : 'guest';
$userRole = Auth::check() ? Auth::user()->role : 'guest';

@endphp
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
                            @foreach($menus->where('is_header', 0)->where('role', $userRole) as $menu)
                                @php
                                    // Ambil submenu berdasarkan is_header dan role
                                    $submenus = $menus->where('is_header', $menu->id)->where('role', $userRole);
                                @endphp
                                <li @if($submenus->isNotEmpty()) class="has-children" @endif>
                                    <a class="active" href="{{ $menu->url }}">
                                        {{ $menu->name }}
                                    </a>
                                    @if($submenus->isNotEmpty())
                                    <ul class="sub-menu">
                                        @foreach($submenus as $submenu)
                                        <li>
                                            <a href="{{ $submenu->url }}">
                                                {{ $submenu->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                            
                        </ul>
                        
                     </nav>
                     <div class="burger-icon burger-icon-white">
                         <span class="burger-icon-top"></span>
                         <span class="burger-icon-mid"></span>
                         <span class="burger-icon-bottom"></span>
                     </div>
                 </div>
             </div>
             <div class="header-right">
                <div class="block-signin">
                    @if(Auth::check())
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-border float-right" style="background-color:#f05537!important;">Logout</button>
                        </form>
                    @else
                        
                            <a href="{{ route('login') }}" class="btn btn-default btn-shadow ml-40 hover-up">Masuk</a>
                      
                            <a href="{{ route('logincompany') }}" class="btn btn-default btn-shadow ml-40 hover-up" style="color: white;">untuk perusahaan</a>
                        
                    @endif
                </div>
            </div>
         </div>


     </div>
 </header>

 <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
     <div class="mobile-header-wrapper-inner">
         @if (session('email'))
             <div class="mobile-header-top">
                 <div class="user-account">
                     <img src="{{ asset('assets/imgs/avatar/ava_1.png')}}" alt="jobhub" />
                     <div class="content">
                         <h6 class="user-name">{{ session('name') }}</h6>
                         <p class="font-xs text-muted">Welcome Back </p>
                         
                     </div>
                 </div>
                 <div class="burger-icon burger-icon-white">
                     <span class="burger-icon-top"></span>
                     <span class="burger-icon-mid"></span>
                     <span class="burger-icon-bottom"></span>
                 </div>
             </div>
         @else
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
         @endif
         <div class="mobile-header-content-area">
             <div class="perfect-scroll">

                 <div class="mobile-menu-wrap mobile-header-border">
                     <!-- mobile menu start -->
                     <nav>
                     <ul class="mobile-menu font-heading">
                            @foreach($menus->where('is_header', 0)->where('role', $userRole) as $menu)
                                @php
                                    // Ambil submenu berdasarkan is_header dan role
                                    $submenus = $menus->where('is_header', $menu->id)->where('role', $userRole);
                                @endphp
                                <li @if($submenus->isNotEmpty()) class="has-children" @endif>
                                    <a class="active" href="{{ $menu->url }}">
                                        {{ $menu->name }}
                                    </a>
                                    @if($submenus->isNotEmpty())
                                    <ul class="sub-menu">
                                        @foreach($submenus as $submenu)
                                        <li>
                                            <a href="{{ $submenu->url }}">
                                                {{ $submenu->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                    
                            @if(Auth::check())
                                <li class="has">
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline ">
                                        @csrf
                                        <button type="submit" style="background-color:#f05537px!mportant; " class="btn btn-border float-right">Logout</button>
                                    </form>
                                </li>
                            @else
                                <li class="has">
                                    <a href="{{ route('login') }}" class="btn btn-border float-right" style="color: white;">Sign in</a>
                                </li>
                            @endif
                        </ul>
                         
                     </nav>
                     
                 </div>


                 <div class="site-copyright">Copyright 2024 Training Kerja</div>
             </div>
         </div>
     </div>
 </div>

 <!--End header-->