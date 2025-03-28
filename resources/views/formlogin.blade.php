@extends('layouts.app')
@section('title')
Sign In & Sign Up
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
        .btn-warning {
            background-color: #f05537 !important; /* Warna background tombol */
            border-color: #f05537 !important; /* Warna border */
            color: #fff !important; /* Warna teks */
        }

        .btn-warning:hover {
            background-color: #d84830 !important; /* Warna saat hover */
            border-color: #d84830 !important;
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

    </style>

    <div class="containers">

        <div class="register-containers row">
            
            <div class="col-md-5 left-side d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/imgs/avatar/Construction-worker-pana-1.png')}}" alt="Construction Illustration">
            </div>
            
            <!-- Right Side -->
            <div class="col-md-7 right-side">
                <div class="title-container">
                    <h6 id="formTitle" style="font-size: 18px;">Sign In & SingUp</h6>
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
                    <p class="mt-3">Don't have an account? <a href="#" id="showSignUp">Sign Up</a>  &nbsp;&nbsp &nbsp; 
                            
                        <a href="#" id="showForgotPassword">forgot password?</a></p>
                </form>

                <!-- Sign Up Form (Hidden by Default) -->
                <form id="signUpForm" class="hidden">
                     <!-- Checkbox untuk memilih Employee -->
                     <!-- Checkbox untuk memilih Employee -->
                    <div class="form-check mt-3 hidden" >
                        <input type="checkbox" class="form-check-input" id="isEmployee">
                        <label class="form-check-label" for="isEmployee">Sign up as Employee</label>
                    </div>

                    <div class="form-group">
                        <label id="usernameLabel">Username</label>
                        <input type="text" class="form-control" id="signUpUsername" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label id="emailLabel">Email Address</label>
                        <input type="email" class="form-control" id="signUpEmail" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label style="display: flex; align-items: flex-start;">
                            <p><input type="checkbox" id="termsCheckbox" style="margin-top: 5px; margin-right: 5px;">
                            By registering, you agree to the 
                            <a href="/privacy-policy" target="_blank">Privacy Policy</a> 
                            and consent to receive marketing messages from us.</p>
                        </label>
                    
                        <p id="errorText" style="color: red; display: none;">You must agree to the Privacy Policy!</p>
                    
                    </div>
                    <div class="form-group">
                        <label id="passwordLabel">Password</label>
                        <input type="password" class="form-control" id="signUpPassword" name="password" placeholder="Enter password">
                    </div>

                    <!-- Input tambahan untuk Employee -->
                    <div id="employeeFields" class="mt-3 d-none">
                        <div class="form-group">
                            <label>Company ID</label>
                            <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="Enter Employee ID">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Sign Up</button>
                    <p class="mt-3">Already have an account? <a href="#" id="showSignIn">Sign In</a></p>
                </form>


                <form id="sendEmailForm" class="hidden">
                    <div class="form-check mt-3 hidden">
                        <label class="form-check-label" for="isEmployee">Forgot password</label>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <button type="submit" class="btn btn-warning" id="sendEmail">Kirim</button>
                    <p class="mt-3">Already have an account? <a href="/login" id="showSignIn">Sign In</a></p>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById("isEmployee").addEventListener("change", function () {
            let isChecked = this.checked;
            let employeeField = $("#employeeId");

            // Mengubah label input sesuai pilihan
            document.getElementById("usernameLabel").textContent = isChecked ? "Employee Name" : "Username";
            document.getElementById("emailLabel").textContent = isChecked ? "Work Email" : "Email Address";
            document.getElementById("passwordLabel").textContent = isChecked ? "Work Password" : "Password";

            if (isChecked) {
                $("#employeeFields").removeClass("d-none").removeAttr("hidden"); // Tampilkan input
                employeeField.val("EMP-" + Math.floor(10000 + Math.random() * 90000)); // Atur ID otomatis
                employeeField.prop("readonly", true); // Mencegah perubahan
            } else {
                $("#employeeFields").addClass("d-none").attr("hidden", true);
                employeeField.val(""); // Kosongkan nilai jika tidak dicentang
                employeeField.prop("readonly", false); // Kembalikan agar bisa diubah jika diperlukan
            }
        });

        // Toggle between Sign In and Sign Up forms
        $("#showSignIn").click(function() {
            $("#signUpForm, #sendEmailForm").addClass("hidden"); // Sembunyikan semua form selain Sign In
            $("#signInForm").removeClass("hidden");
            $("#formTitle").text("Sign Up as Company");
        });
        // Toggle antara Sign In dan Sign Up
        $("#showSignUp").click(function() {
            $("#signInForm, #sendEmailForm").addClass("hidden"); // Sembunyikan semua form selain Sign In
            $("#signUpForm").removeClass("hidden");
            $("#formTitle").text("Sign Up as Company");
        });

        $("#showForgotPassword").click(function() {
            $("#signInForm, #signUpForm").addClass("hidden"); // Sembunyikan form lain
            $("#sendEmailForm").removeClass("hidden"); // Tampilkan form forgot password
            $("#formTitle").text("Reset Password");
        });

        function showLoading() {
            $.LoadingOverlay("show", {
                background: "rgba(0, 0, 0, 0.5)",
                image: "",
                fontawesome: "fa fa-spinner fa-spin",
                fontawesomeColor: "#fff"
            });
        }

        function hideLoading() {
            $.LoadingOverlay("hide");
        }


        $(document).ready(function () {
            // Handle Sign Up Form Submission
            $("#signUpForm").submit(function (e) {
                e.preventDefault();
                let checkbox = document.getElementById("termsCheckbox");
                let errorText = document.getElementById("errorText");

                if (!checkbox.checked) {
                    errorText.style.display = "block"; 
                    return;
                } else {
                    errorText.style.display = "none";
                }

                let username = $("#signUpUsername").val();
                let email = $("#signUpEmail").val();
                let password = $("#signUpPassword").val();
                let isEmployee = $("#isEmployee").is(":checked");
                let employeeId = isEmployee ? $("#employeeId").val() : null;
                let istermsCheckbox = checkbox.checked ? 1 : 0;

                showLoading(); 

                $.ajax({
                    url: "{{ route('signup') }}",
                    type: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        username: username,
                        email: email,
                        password: password,
                        isEmployee: isEmployee,
                        employeeId: employeeId,
                        privacypolicy: istermsCheckbox,
                    },
                    success: function (response) {
                        hideLoading(); 

                        if (response.success) {
                            // **🔹 Kirim Email Konfirmasi setelah sukses mendaftar**
                            $.ajax({
                                url: "/send-registration-email",
                                type: "POST",
                                data: {
                                    _token: $("meta[name='csrf-token']").attr("content"),
                                    email: email,
                                    password: password
                                }
                            }).done(function(emailResponse) {
                                console.log("Email Registrasi:", emailResponse.message);
                            }).fail(function(error) {
                                console.error("Gagal mengirim email registrasi:", error);
                            });

                            Swal.fire({
                                icon: 'success',
                                title: 'Pendaftaran Berhasil',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = "{{ route('login') }}";
                            });
                        } else {
                            Swal.fire("Error!", response.error, "error");
                        }
                    },
                    error: function (xhr) {
                        hideLoading(); 
                        let errorMessage = "Failed to create account.";
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire("Error!", errorMessage, "error");
                    }
                });
            });
            // Handle Sign In Form Submission
            $("#signInForm").submit(function (e) {
                e.preventDefault();

                let email = $("#signInEmail").val();
                let password = $("#signInPassword").val();

                showLoading(); // Tampilkan loading overlay

                $.ajax({
                    url: "{{ route('signIn') }}",
                    type: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        email: email,
                        password: password
                    }
                })
                .done(function (response) {
                    hideLoading(); // Sembunyikan loading setelah sukses

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        setTimeout(() => {
                            window.location.href = "{{ route('logincompany') }}";
                        }, 500);
                    });
                })
                .fail(function (xhr) {
                    hideLoading(); // Sembunyikan loading saat terjadi error

                    let errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
                    if (xhr.responseJSON?.error) {
                        errorMessage = xhr.responseJSON.error;
                    } else if (xhr.status === 422) {
                        errorMessage = "Email tidak valid atau belum terdaftar.";
                    } else if (xhr.status === 500) {
                        errorMessage = "Terjadi kesalahan server. Silakan coba lagi nanti.";
                    }
                    Swal.fire("Error!", errorMessage, "error");
                });
            });

            $("#sendEmailForm").submit(function(e) {
                e.preventDefault();
                let email = $("#email").val();
                let token = $("meta[name='csrf-token']").attr("content");

                if (!email) {
                    Swal.fire("Error!", "Email is required!", "error");
                    return;
                }

                showLoading(); 

                $.ajax({
                    url: "{{ route('password.email') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        email: email
                    }
                })
                .done(function(response) {
                    hideLoading();

                    if (response.success) {
                        // **🔹 Kirim Email Reset Password setelah sukses**
                        $.ajax({
                            url: "/send-password-reset-email",
                            type: "POST",
                            data: {
                                _token: token,
                                email: email
                            }
                        }).done(function(emailResponse) {
                            console.log("Email Reset Password:", emailResponse.message);
                        }).fail(function(error) {
                            console.error("Gagal mengirim email reset password:", error);
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{ route('logincompany') }}";
                            }, 500);
                        });
                    } else {
                        Swal.fire("Error!", response.error, "error");
                    }
                })
                .fail(function(xhr) {
                    hideLoading();
                    let errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
                    if (xhr.responseJSON?.error) {
                        errorMessage = xhr.responseJSON.error;
                    } else if (xhr.status === 422) {
                        errorMessage = "Email tidak valid atau belum terdaftar.";
                    } else if (xhr.status === 500) {
                        errorMessage = "Terjadi kesalahan server. Silakan coba lagi nanti.";
                    }
                    Swal.fire("Error!", errorMessage, "error");
                });
            });
        });


    </script>

@endsection
