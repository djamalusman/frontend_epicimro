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
    <!-- Modal -->
   
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
            <p id="errorMessageSigIn"></p>
            <button id="modalCloseBtnSignIn">Close</button>
        </div>
    </div>


    <script src="{{ asset('assetsformlogin/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript">
    @if(session('session_expired'))
        
        Swal.fire({
            icon: 'warning',
            title: 'Session Expired',
            text: "{{ session('session_expired') }}",
            confirmButtonText: 'OK'
        });
    @endif
    document.getElementById('signUpForm').addEventListener('submit', async (e) => {
        e.preventDefault(); // Mencegah submit form standar

        // Ambil nilai dari input form
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {
            // Kirim permintaan ke server
            const response = await fetch('{{ route("signup") }}', {
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
                }) // Kirim data sebagai JSON
            });

            // Periksa apakah respons berhasil
            if (!response.ok) {
                const errorMessage = `Error ${response.status}: ${response.statusText}`;
                throw new Error(errorMessage);
            }

            // Parsing respons JSON
            const data = await response.json();

            // Jika pendaftaran sukses
            if (data.message) {
                Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran Berhasil',
                    text: 'Akun Anda telah berhasil dibuat. Anda akan diarahkan ke halaman login.',
                    confirmButtonText: 'OK'
                });
            }
            // Jika terdapat error dari server
            else if (data.error) {
                showErrorModal(data.error || 'Something went wrong!');
            }
        } catch (error) {
            console.error('Error:', error.message);
            showErrorModal(error.message || 'An unexpected error occurred.');
        }
    });

    // Fungsi untuk menampilkan modal error
    function showErrorModal(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
            confirmButtonText: 'Close'
        });
    }



    document.getElementById('signInForm').addEventListener('submit', async (e) => {
    e.preventDefault(); // Mencegah submit form standar

    // Ambil data dari input form
    const email = document.getElementById('signInEmail').value;
    const password = document.getElementById('signInPassword').value;

    try {
        // Kirim permintaan ke server
        const response = await fetch('{{ route("signIn") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                email,
                password
            }) // Kirim data sebagai JSON
        });

        // Periksa jika respons tidak berhasil
        if (!response.ok) {
            const errorMessage = `Error ${response.status}: ${response.statusText}`;
            throw new Error(errorMessage); // Lempar error untuk ditangani oleh catch
        }

        // Parsing respons JSON
        const data = await response.json();

        // Jika login sukses
        if (data.message) {
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                confirmButtonText: 'OK'
            }).then(() => {
                // Setelah pengguna menekan tombol OK, arahkan ke halaman dashboard
                setTimeout(() => {
                    window.location.href = 'http://127.0.0.1:8000/dashboardindex';
                }, 1000);
            });
        }
        // Jika login gagal
        else if (data.error) {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Email atau password salah. Silakan coba lagi.',
                confirmButtonText: 'Close'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: 'Email atau password salah. Silakan coba lagi.',
            confirmButtonText: 'Close'
        });
    }
});

    </script>
</body>

</html>