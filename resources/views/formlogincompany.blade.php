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
                       
                        <form id="signInForm" method="POST" action="{{ route('signIn') }}">
                            <h1>Pasang lowongan kerja dan training kerja <span>Gratis!</span></h1>
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
                            <h1>Pasang lowongan kerja dan training kerja <span>Gratis!</span></h1>
                            <div class="form-check mt-3 hidden">
                                <input type="checkbox" class="form-check-input" id="isEmployee">
                                <label class="form-check-label" for="isEmployee">Sign up as Employee</label>
                            </div>

                            <div class="form-group">
                                <label id="usernameLabel">Company Name</label>
                                <input type="text" class="form-control" id="signUpUsernamecompany" name="usernamecompnay" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label id="emailLabel">Email compnay</label>
                                <input type="email" class="form-control" id="signUpEmailcompany" name="emailcompnay" placeholder="Enter email">
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
                                <label id="passwordLabel">Password company</label>
                                <input type="password" class="form-control" id="signUpPasswordcompany" name="passwordcompnay" placeholder="Enter password">
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

                        <!-- forgot password (Hidden by Default) -->
                        <form id="sendEmailForm" class="hidden">
                            <h1>Send email to reset password</h1>
                            <div class="form-check mt-3 hidden">
                                <label class="form-check-label" for="isEmployee">Forgot password</label>
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>
                            <button type="submit" class="btn btn-warning" id="sendEmail">Kirim</button>
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
       

        // Reset modal on close
      

       
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

        document.getElementById("signUpForm").addEventListener("submit", function (e) {
            e.preventDefault(); // Mencegah form terkirim sebelum validasi

            let checkbox = document.getElementById("termsCheckbox");
            let errorText = document.getElementById("errorText");

            if (!checkbox.checked) {
                errorText.style.display = "block"; // Tampilkan pesan error
                return;
            } else {
                errorText.style.display = "none"; // Sembunyikan pesan error
            }

            let signUpUsernamecompany = $("#signUpUsernamecompany").val();
            let signUpEmailcompany = $("#signUpEmailcompany").val();
            let signUpPasswordcompany = $("#signUpPasswordcompany").val();
            let istermsCheckbox = checkbox.checked ? 1 : 0;
            let isEmployee = $("#isEmployee").is(":checked");
            let employeeId = isEmployee ? $("#employeeId").val() : null;

            showLoading(); 

            $.ajax({
                url: "{{ route('signupcompany') }}",
                type: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    username: signUpUsernamecompany,
                    email: signUpEmailcompany,
                    password: signUpPasswordcompany,
                    privacypolicy: istermsCheckbox,
                    isEmployee: isEmployee,
                    employeeId: employeeId
                },
                success: function (response) {
                    hideLoading();

                    if (response.success) {
                        let message = response.message;
                        if (response.email_error) {
                            message += " Namun, email gagal dikirim.";
                        }

                        // Panggil API untuk mengirim email pendaftaran
                        $.ajax({
                            url: "/send-registration-email",
                            type: "POST",
                            data: {
                                _token: $("meta[name='csrf-token']").attr("content"),
                                email: signUpEmailcompany
                            }
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Pendaftaran Berhasil',
                            text: message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('logincompany') }}";
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
        $("#signInForm").submit(function(e) {
            e.preventDefault();

            let email = $("#signInEmail").val();
            let password = $("#signInPassword").val();
            showLoading(); 
            $.ajax({
                url: "{{ route('signInCompany') }}",
                type: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    email: email,
                    password: password
                }
            })
            .done(function(response) { 
                hideLoading(); 
                Swal.fire("Success!", response.message || "Logged in successfully!", "success").then(() => {
                    window.location.href = "/welcome"; 
                });
            })
            .fail(function(xhr) {  
                hideLoading();
                let errorMessage = "Gagal login. Silakan coba lagi.";
                if (xhr.responseJSON?.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (xhr.status === 422) {
                    errorMessage = "Email atau password tidak valid.";
                } else if (xhr.status === 500) {
                    errorMessage = "Terjadi kesalahan server. Silakan coba lagi nanti.";
                }
                Swal.fire("Error!", errorMessage, "error");
            });
        });

        $("#sendEmailForm").submit(function (e) {
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
            .done(function (response) {
                hideLoading();

                // Panggil API untuk mengirim email reset password
                $.ajax({
                    url: "/send-password-reset-email",
                    type: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        email: email
                    }
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    setTimeout(() => {
                        window.location.href = "{{ route('logincompany') }}"; // Redirect
                    }, 500);
                });
            })
            .fail(function (xhr) {
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


    </script>

@endsection
