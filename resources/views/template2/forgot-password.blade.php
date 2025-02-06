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
                <!-- Login Form -->
                <form id="signInForm" class="form login-form active" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h2>Reset Password</h2>
                    <div class="input-group">
                        <input type="email" placeholder="Email" id="signInEmail" name="email" required>
                        <span class="input-icon">📧</span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Kirim Link Reset Password
                    </button>
                    <p class="switch-text">
                        <br>
                        <a href="{{ route('login') }}" class="text-primary">Back to Login</a>
                        </br>
                    </p>
                </form>

                <!-- Signup Form -->
                <form id="signUpForm" class="form signup-form">

                </form>
            </div>
        </div>
    </div>




    <script src="{{ asset('assetsformlogin/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

</body>

</html>
