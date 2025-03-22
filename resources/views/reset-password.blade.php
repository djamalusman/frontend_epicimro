{{-- 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assetsformlogin/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Reset Password</title>
</head>

<body>

    <div class="main-container">
        <div class="form-wrapper">
            <div class="form-content">
                <form id="reset-password" class="form login-form active">
                    @csrf
                    <input type="hidden" id="token" name="token" value="{{ $token }}">
                    <input type="hidden" class="form-control" value="{{$email}}" id="email" name="email">
                    <h2>Reset Password</h2>
                    
                    <div class="input-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        <span class="input-icon">🔒</span>
                    </div>
                    <div class="input-group">
                        <label>Confirmation Password</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        <span class="input-icon">🔒</span>
                    </div>
                    <p class="switch-text">
                        <button type="submit" class="btn btn-primary btn-block text-primary">Reset Password</button>
                    </p>
                </form>
            </div>
        </div>
    </div>




    <script src="{{ asset('assetsformlogin/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#reset-password').on('submit', function(e) {
                e.preventDefault();
                
                let formData = $(this).serialize();
                
                $.ajax({
                    url: "{{ route('password.update') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Password berhasil direset',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('login') }}";
                        });
                    },
                    error: function(xhr) {
                        let errorMsg = "Terjadi kesalahan. Silakan coba lagi.";
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).flat().join("\n");
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMsg,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
      
        
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="password_confirmation"]');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (password.value !== confirmPassword.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Password and Confirm Password must match!',
                    confirmButtonColor: '#3085d6'
                });
                return false;
            }

            // If passwords match, submit the form
            this.submit();
        });

        // Real-time validation as user types
        confirmPassword.addEventListener('input', function() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Passwords do not match');
            } else {
                confirmPassword.setCustomValidity('');
            }
        });
    });
    </script>

</body>

</html> --}}



@extends('layouts.app')
@section('title')
Reset Password
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
     body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    .containers {
        width: 100%;
        max-width: 1200px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px; 
    }

    .left-side {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-right: 50px;
    }

    .left-side img {
        max-width: 600px;
        height: 600px;
    }

    .right-side {
        flex: 1;
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .right-side h1 {
        font-size: 28px;
        font-weight: bold;
        color: #000;
        margin-bottom: 10px;
    }

    .right-side h1 span {
        color: #f05537; /* Warna kuning untuk "Gratis!" */
    }

    .right-side p {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-warning {
        width: 100%;
        font-size: 18px;
        font-weight: bold;
        padding: 12px;
        background-color: #f05537;
        color: rgb(255, 255, 255);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(255, 255, 255, 0.4);
        margin-top: 10px;
    }

    .btn-warning:hover {
        background-color: #f05537;
        box-shadow: 0 6px 12px rgba(255, 193, 7, 0.5);
    }

    .form-check-label {
        font-size: 12px;
        color: #6c757d;
    }

    input[type="checkbox"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    a {
        color: blue;
        text-decoration: underline;
    }

</style>


            
            <div class="containers mt-20 mb-20">
                    <div class="left-side">
                        <img src="{{ asset('assets/imgs/avatar/Construction-worker-pana-1.png')}}" alt="Construction Illustration">
                    </div>
                    
                    <!-- Right Side -->
                    <div class="right-side">
                        <!-- Sign In Form -->
                        <form id="reset-password" class="form login-form active">
                            @csrf
                            <input type="hidden" id="token" name="token" value="{{ $token }}">
                            <input type="hidden" class="form-control" value="{{$email}}" id="email" name="email">
                            <h1>ConfirReset Password <span>Anda!</span></h1>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>\
                            </div>
                            <div class="form-group">
                                <label>Confirmation Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                
                            </div>
                            <button type="submit" class="btn btn-warning">Submit</button>
                            <p class="mt-3">Already have an account? <a href="/logincompany" id="showSignIn">Sign In</a></p>
                        </form>
                    </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="content-single">
                    <img src="{{ asset('assets/imgs/avatar/freepik__upload__99286.png')}}" alt="Construction Illustration">
                    
                </div>
            </div>

           

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#confirm-email').on('submit', function(e) {
                e.preventDefault();
                
                let formData = $(this).serialize();
                
                $.ajax({
                    url: "{{ route('confirm.emails') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Email berhasil dikonfirmasi.',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('login') }}";
                        });
                    },
                    error: function(xhr) {
                        let errorMsg = "Terjadi kesalahan. Silakan coba lagi.";
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).flat().join("\n");
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMsg,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
      
        
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const password = document.querySelector('input[name="password"]');
            const confirmPassword = document.querySelector('input[name="password_confirmation"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (password.value !== confirmPassword.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'Password and Confirm Password must match!',
                        confirmButtonColor: '#3085d6'
                    });
                    return false;
                }

                // If passwords match, submit the form
                this.submit();
            });

            // Real-time validation as user types
            confirmPassword.addEventListener('input', function() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match');
                } else {
                    confirmPassword.setCustomValidity('');
                }
            });
        });
        window.history.forward(1);
    </script>

@endsection
