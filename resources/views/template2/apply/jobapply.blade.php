<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Apply Job</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets2/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/modules/fontawesome/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg" style="background:#f05537 !important"></div>



            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-10">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($getdataDetail->file ?? '')) }}"
                                                alt="Logo" style="width: 75px; height: 75px; margin-right: 10px;">
                                            <div>
                                                <h4 class="mb-0">{{ $getdataDetail->job_title }}</h4>
                                                <small>{{ $getdataDetail->companyName }}</small>
                                                <br>
                                                <a href="#" style="text-decoration: none;" data-bs-toggle="modal"
                                                    data-bs-target="#jobDescriptionModal">
                                                    Lihat deskripsi pekerjaan
                                                </a>
                                            </div>
                                        </div>
                                        <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($dataTk->item_file_2 ?? '')) }}"
                                            alt="Company Logo" style="width: 150px; height: 50px;">
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-8 offset-lg-2">
                                                <div class="wizard-steps">
                                                    <!-- Step 1: User Account -->
                                                    <div class="wizard-step wizard-step-active" id="step1">
                                                        <div class="wizard-step-icon">
                                                            <i class="far fa-user"></i>
                                                        </div>
                                                        <div class="wizard-step-label">
                                                            Pilih Dokuemn
                                                        </div>
                                                    </div>
                                                    <!-- Step 2: Create an App -->
                                                    <div class="wizard-step" id="step2">
                                                        <div class="wizard-step-icon">
                                                            <i class="fas fa-box-open"></i>
                                                        </div>
                                                        <div class="wizard-step-label">
                                                            Pertanyaan Perusahaan
                                                        </div>
                                                    </div>
                                                    <!-- Step 3: Server Information -->
                                                    <div class="wizard-step" id="step3">
                                                        <div class="wizard-step-icon">
                                                            <i class="fas fa-server"></i>
                                                        </div>
                                                        <div class="wizard-step-label">
                                                            Server Information
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="wizardForm" class="wizard-content mt-2" method="POST"
                                            enctype="multipart/form-data">
                                            <!-- CSRF Token -->
                                            @csrf
                                            <input hidden type="text" name="jobid" value="{{ $jobid }}"
                                                class="form-control" required>
                                            <input hidden type="text" name="emailsession"
                                                value="{{ session('email') }}" class="form-control" required>
                                            <!-- Step 1: User Account -->
                                            <div class="wizard-pane" data-step="1">

                                                <div class="form-group row">
                                                    <label class="col-md-4 text-md-right text-left">Surat lamaran
                                                    </label>
                                                    <div class="col-lg-4 col-md-6">
                                                        <textarea name="coverletter" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 text-md-right text-left">Upload CV</label>
                                                    <div class="col-lg-4 col-md-6">
                                                        <input type="file" name="cv" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                                        <button type="button" class="btn btn-primary"
                                                            id="nextStep1">Next <i
                                                                class="fas fa-arrow-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 2: Create an App -->
                                            <div class="wizard-pane d-none" data-step="2">
                                                <div class="form-group row">
                                                    <label class="col-md-4 text-md-right text-left">App Name</label>
                                                    <div class="col-lg-4 col-md-6">
                                                        <input type="text" name="app_name" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                                        <button type="button" class="btn btn-secondary"
                                                            id="prevStep2"><i class="fas fa-arrow-left"></i>
                                                            Previous</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="nextStep2">Next <i
                                                                class="fas fa-arrow-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 3: Server Information -->
                                            <div class="wizard-pane d-none" data-step="3">
                                                <div class="form-group row">
                                                    <label class="col-md-4 text-md-right text-left">Server Type</label>
                                                    <div class="col-lg-4 col-md-6">
                                                        <select name="server_type" class="form-control" required>
                                                            <option value="">Select Server</option>
                                                            <option value="shared">Shared</option>
                                                            <option value="dedicated">Dedicated</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                                        <button type="button" class="btn btn-secondary"
                                                            id="prevStep3"><i class="fas fa-arrow-left"></i>
                                                            Previous</button>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer class="main-footer" style="background:#f05537 !important">
                <div class="footer-left">

                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>
    <div class="modal fade" id="jobDescriptionModal" tabindex="-1" aria-labelledby="jobDescriptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobDescriptionModalLabel">Deskripsi Pekerjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi deskripsi pekerjaan -->
                    <p>Deskripsi pekerjaan Staff IT Programmer:</p>
                    <?php echo $getdataDetail->job_description; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Data submitted successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorModalMessage">
                    <!-- Error message will appear here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentStep = 1; // Step yang sedang aktif
            const totalSteps = 3; // Total langkah dalam wizard
            const wizardForm = document.getElementById('wizardForm'); // Form utama
            const wizardPanes = document.querySelectorAll('.wizard-pane'); // Semua langkah form

            // Fungsi untuk mengubah langkah aktif
            function showStep(step) {
                wizardPanes.forEach(pane => {
                    pane.classList.add('d-none'); // Sembunyikan semua langkah
                });
                const currentPane = document.querySelector(`.wizard-pane[data-step="${step}"]`);
                currentPane.classList.remove('d-none'); // Tampilkan langkah yang sesuai

                // Navigasi langkah pada indikator
                const steps = document.querySelectorAll('.wizard-step');
                steps.forEach((stepElem, index) => {
                    if (index + 1 === step) {
                        stepElem.classList.add('wizard-step-active');
                    } else {
                        stepElem.classList.remove('wizard-step-active');
                    }
                });
            }

            // Periksa validitas form pada langkah tertentu
            function validateStep(step) {
                const currentPane = document.querySelector(`.wizard-pane[data-step="${step}"]`);
                const inputs = currentPane.querySelectorAll(
                    'input, select, textarea'); // Ambil semua input di dalam langkah
                let isValid = true;

                // Periksa setiap input valid atau tidak
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        isValid = false;
                        input.classList.add('is-invalid'); // Menambahkan class invalid jika tidak valid
                    } else {
                        input.classList.remove('is-invalid'); // Hapus class invalid jika valid
                    }
                });
                return isValid;
            }

            // Tombol next
            document.getElementById('nextStep1').addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    if (currentStep <= totalSteps) {
                        showStep(currentStep);
                    }
                } else {
                    alert("Please complete all fields in Step " + currentStep);
                }
            });

            // Tombol previous
            document.getElementById('prevStep2').addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            document.getElementById('prevStep3').addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Kirim form jika di langkah terakhir
            wizardForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form default
                if (validateStep(currentStep)) {
                    // Form valid, lanjutkan ke pengiriman data
                    const formData = new FormData(wizardForm); // Ambil data form

                    fetch('/submit-form', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Tangani respons dari server
                            alert("Form submitted successfully!");
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("Error submitting form.");
                        });
                } else {
                    alert("Please complete all fields.");
                }
            });

            // Inisialisasi untuk menunjukkan langkah pertama
            showStep(currentStep);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets2/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/modules/popper.js') }}"></script>
    <script src="{{ asset('assets2/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets2/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets2/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets2/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets2/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets2/js/scripts.js') }}"></script>
    <script src="{{ asset('assets2/js/custom.js') }}"></script>
</body>

</html>
