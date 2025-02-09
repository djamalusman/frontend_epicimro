<!-- <div class="card">
    <div class="card-body">
        <h4 class="card-title">Reset Password</h4>
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div> -->

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
                <form id="signInForm" class="form login-form active" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <h2>Reset Password</h2>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password" placeholder="password"  required>
                        <span class="input-icon">🔒</span>
                    </div>
                    <div class="input-group">
                        <input id="password_confirmation" type="password" placeholder="password confirmation" class="form-control" name="password_confirmation" required>
                        <span class="input-icon">🔒</span>
                    </div>
                    <p class="switch-text">
                        <br>
                        <button type="submit" class="btn btn-primary btn-block text-primary"">
                            Reset Password
                        </button>
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

</html>
