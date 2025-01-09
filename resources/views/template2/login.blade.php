<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assetsformlogin/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="main-container">
        <div class="form-wrapper">
            <div class="form-content">
                <!-- Login Form -->
                <form id="signInForm" class="form login-form active" method="POST" action="{{ route('signIn') }}">
                    @csrf
                    <h2>Welcome Back!</h2>
                    <p>Login to your account to continue</p>
                    <div class="input-group">
                        <input type="email" placeholder="Email" id="signInEmail" name="email" required>
                        <span class="input-icon">📧</span>
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Password" id="signInPassword" name="password" required>
                        <span class="input-icon">🔒</span>
                    </div>
                    <button type="submit" class="btn">Login</button>

                    <p class="switch-text">
                        <br>
                        Don’t have an account? <span class="toggle-form">Sign Up</span>
                        </br>
                    </p>
                </form>

                <!-- Signup Form -->
                <form id="signUpForm" class="form signup-form" method="POST" action="{{ route('signup') }}">
                    @csrf
                    <h2>Create Account</h2>
                    <p>Sign up to explore new opportunities</p>
                    <div class="input-group">
                        <input type="text" id="username" name="username" placeholder="Username" required>
                        <span class="input-icon">👤</span>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <span class="input-icon">📧</span>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span class="input-icon">🔒</span>
                    </div>
                    <button type="submit" class="btn">Sign Up</button>

                    <p class="switch-text">
                        <br>
                        Already have an account? <span class="toggle-form">Login</span>
                        </br>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <div id="successModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Pendaftaran Berhasil</h2>
            <p>Akun Anda telah berhasil dibuat. Anda akan diarahkan ke halaman login.</p>
            <button id="modalCloseSucessBtn">OK</button>
        </div>
    </div>
    <div id="errorModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; text-align: center;">
            <p id="errorMessage"></p>
            <button id="modalCloseBtn">Close</button>
        </div>
    </div>
    <div id="successModalSignIn" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Login Berhasil</h2>
            <button id="modalCloseSucessBtnSignIn">OK</button>
        </div>
    </div>
    <div id="errorModalSignIn"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; text-align: center;">
            <p id="errorMessage"></p>
            <button id="modalCloseBtnSignIn">Close</button>
        </div>
    </div>


    <script src="{{ asset('assetsformlogin/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('signUpForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Mencegah submit form standar

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('{{ route('signup') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        username,
                        email,
                        password
                    })
                });

                const data = await response.json();

                // Jika sukses
                if (data.message) {
                    const successModal = document.getElementById('successModal');
                    successModal.style.display = 'flex';
                    document.getElementById('modalCloseSucessBtn').addEventListener('click', () => {
                        successModal.style.display = 'none';
                        window.location.reload(); // Reload halaman
                    });
                }
                // Jika ada error
                else if (data.error) {
                    const errorModal = document.getElementById('errorModal');
                    document.getElementById('errorMessage').innerText = data.error || 'Something went wrong!';
                    errorModal.style.display = 'flex';
                    document.getElementById('modalCloseBtn').addEventListener('click', () => {
                        errorModal.style.display = 'none';

                    });
                }

            } catch (error) {
                console.error('Error:', error);
            }
        });


        document.getElementById('signInForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Mencegah submit form standar

            const email = document.getElementById('signInEmail').value;
            const password = document.getElementById('signInPassword').value;
            try {
                const response = await fetch('{{ route('signIn') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        email,
                        password
                    }),
                });

                const data = await response.json();

                // Jika sukses
                if (data.message) {
                    const successModal = document.getElementById('successModalSignIn');
                    successModal.style.display = 'flex';
                    document.getElementById('modalCloseSucessBtnSignIn').addEventListener('click', () => {
                        successModal.style.display = 'none';
                        // Redirect ke dashboard
                        setTimeout(() => {
                            window.location.href = '{{ route('dashboard') }}';
                        }, 1000); // Dengan delay 1 detik
                    });
                }
                // Jika ada error
                else if (data.error) {
                    const errorModal = document.getElementById('errorModalSignIn');
                    document.getElementById('errorMessage').innerText = data.error || 'Something went wrong!';
                    errorModal.style.display = 'flex';
                    document.getElementById('modalCloseBtnSignIn').addEventListener('click', () => {
                        errorModal.style.display = 'none';

                    });
                }

            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
</body>

</html>
