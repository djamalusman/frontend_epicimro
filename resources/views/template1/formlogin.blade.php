@extends('layouts.app')
@section('title')
Register as Professional
@endsection

@section('meta')
    <!-- Meta Tags -->

    <meta name="description"
        content="Pusat training dan lowongan kerja sektor Industri, EPC, Fabrikasi, Inspeksi, Operation, Maintenance, Repair, & Overhaul">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Kerjateknik Academy" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://kerjateknik.id" />
    <meta property="og:image" content="https://kerjateknik.id/assets/imgs/theme/kerjateknik.png" />
    <meta property="og:description"
        content="Kerjateknik Academy: Pusat training dan lowongan kerja sektor Industri, EPC, Fabrikasi, Inspeksi, Operation, Maintenance, Repair, & Overhaul" />

    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kerjateknik Academy">
    <meta name="twitter:description"
        content="Kerjateknik Academy: Pusat training dan lowongan kerja sektor Industri, EPC, Fabrikasi, Inspeksi, Operation, Maintenance, Repair, & Overhaul">
    <meta name="twitter:image" content="https://kerjateknik.id/assets/imgs/theme/kerjateknik.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <style>
       
        #containers {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }
        .register-containers {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .left-side {
            background-color: #ff9800;
            padding: 40px;
            color: white;
            text-align: center;
        }
        .left-side img {
            max-width: 100%;
            height: auto;
        }
        .right-side {
            padding: 40px;
            position: relative;
        }
        .btn-warning {
            width: 100%;
            font-size: 18px;
        }
        .form-check-label {
            font-size: 12px;
        }
        .hidden {
            display: none;
        }
        .title-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .title-container img {
            width: 100px; /* Ukuran gambar */
            height: 40px;
            margin-left: 125px; /* Menambahkan jarak ke kanan */
        }
        
        @media (max-width: 480px) {
            .register-containers {
                padding: 15px;
            }
            h5#formTitle {
                font-size: 15px;
            }
            .title-container img {
                width: 100px; /* Ukuran gambar */
                height: 40px;
                margin-left: 15px; /* Menambahkan jarak ke kanan */
            }
            .left-side img {
                width: 80%; /* Perkecil ukuran gambar */
            }
            
            .form-group input {
                font-size: 14px; /* Ukuran input lebih kecil */
            }

            .btn-warning {
                font-size: 14px; /* Ukuran tombol lebih kecil */
                padding: 10px;
            }
        }

        /*         
        .banner {
            width: 100%;
            background-color: #fdf8f3; 
            text-align: center;
            padding: 20px 0;
        }

        .banner-content {
            max-width: 1200px; 
            margin: 0 auto;
        }

        .banner img {
            width: 100%; 
            max-width: 100%;
            height: 300px; 
            display: block;
        }


        
        @media (max-width: 768px) {
            .banner h2 {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .banner h2 {
                font-size: 18px;
            }
        } */
        .btn-warning {
            background-color: #f05537 !important; /* Warna background tombol */
            border-color: #f05537 !important; /* Warna border */
            color: #fff !important; /* Warna teks */
        }

        .btn-warning:hover {
            background-color: #d84830 !important; /* Warna saat hover */
            border-color: #d84830 !important;
        }

    </style>

    <div class="containers">

        <div class="register-containers row">
            <!-- <div class="banner">
                <div class="banner-content">
                    <img src="{{ asset('assets/imgs/avatar/banners.jpeg')}}" alt="Banner Image">
                </div>
            </div> -->
            <!-- Left Side -->
            <div class="col-md-5 left-side d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/imgs/avatar/Construction-worker-pana-1.png')}}" alt="Construction Illustration">
            </div>
            
            <!-- Right Side -->
            <div class="col-md-7 right-side">
                <div class="title-container">
                    <h6 id="formTitle" style="font-size: 18px;">Register as Professional</h6>
                    <img src="https://admin.trainingkerja.com/public/storage/6727b1318a81e.webp" alt="Register Icon">
                </div>
                <!-- Sign In Form -->
                <form id="signInForm" method="POST" action="{{ route('signIn') }}">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" id="signInEmail" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="signInPassword" name="password" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-warning">Sign In</button>
                    <p class="mt-3">Don't have an account? <a href="#" id="showSignUp">Sign Up</a></p>
                </form>

                <!-- Sign Up Form (Hidden by Default) -->
                <form id="signUpForm" class="hidden">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="signUpUsername" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" id="signUpEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="signUpPassword" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-success">Sign Up</button>
                    <p class="mt-3">Already have an account? <a href="#" id="showSignIn">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Toggle between Sign In and Sign Up forms
        $("#showSignUp").click(function() {
            $("#signInForm").addClass("hidden");
            $("#signUpForm").removeClass("hidden");
            $("#formTitle").text("Sign Up as Professional");
        });

        $("#showSignIn").click(function() {
            $("#signUpForm").addClass("hidden");
            $("#signInForm").removeClass("hidden");
            $("#formTitle").text("Register as Professional");
        });

        // Handle Sign Up Form Submission
        $("#signUpForm").submit(function(e) {
            e.preventDefault();
            
            let username = $("#signUpUsername").val();
            let email = $("#signUpEmail").val();
            let password = $("#signUpPassword").val();

            $.ajax({
                url: "{{ route('signup') }}",
                type: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    username: username,
                    email: email,
                    password: password
                },
                success: function(response) {
                    Swal.fire("Success!", "Account created successfully!", "success");
                    $("#signUpForm")[0].reset();
                    $("#signUpForm").addClass("hidden");
                    $("#signInForm").removeClass("hidden");
                    $("#formTitle").text("Register as Professional");
                },
                error: function(response) {
                    Swal.fire("Error!", "Failed to create account.", "error");
                }
            });
        });

        // Handle Sign In Form Submission
        $("#signInForm").submit(function(e) {
            e.preventDefault();

            let email = $("#signInEmail").val();
            let password = $("#signInPassword").val();

            $.ajax({
                url: "{{ route('signIn') }}",
                type: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    email: email,
                    password: password
                },
                success: function(response) {
                    Swal.fire("Success!", "Logged in successfully!", "success").then(() => {
                        window.location.href = "/dashboardindex"; 
                    });
                },
                error: function(response) {
                    Swal.fire("Error!", "Invalid credentials.", "error");
                }
            });
        });
    </script>

@endsection
