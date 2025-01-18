@extends('template2.layouts.app')
@section('title')
Apply Job
@endsection
@section('content')
@push('page-specific-css')
<!-- CSS Libraries -->

<link rel="stylesheet" href="{{ asset('assets2/modules/select2/dist/css/select2.min.css')}}">

@endpush
<style>
/* Adjust the width of select2 elements */
.select2 {
    width: 100% !important;
    /* Make the Select2 width 100% of its parent */
}

/* Optionally, you can specify a custom fixed width */
.select2-container {
    width: 100% !important;
    /* Make the container for the select2 control 100% */
}

.card {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
</style>
<section class="section">
    <div class="section-header">
        <h1>Apply Job</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Job</a></div>
            <div class="breadcrumb-item"><a href="#">Apply</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex align-items-center">
            <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($getdataDetail->file ?? '')) }}"
                alt="Logo" style="width: 255px; height: 105px; margin-right: 10px;">
            <div>
                <h2 class="mb-0">{{ $getdataDetail->job_title }}</h2>
                <small>{{ $getdataDetail->companyName }}</small>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Lihat deskripsi pekerjaa
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                            Riwayat karir
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="wizardForm" class="wizard-content mt-2" method="POST" enctype="multipart/form-data">
                            <!-- CSRF Token -->
                            @csrf
                            <input hidden type="text" name="jobid" value="{{ $jobid }}" class="form-control" required>
                            <input hidden type="text" name="emailsession" value="{{ session('email') }}"
                                class="form-control" required>

                            <!-- Step 1: User Account -->
                            <div class="wizard-pane d-none" data-step="1">
                                <div class="form-group row">
                                    <label class="col-md-4 text-md-right text-left">Surat Lamaran</label>
                                    <div class="col-lg-4 col-md-6">
                                        <textarea name="coverletter" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 text-md-right text-left">Upload CV</label>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="file" name="cv" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    
                                    <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                    
                                    <input type="button" class="btn btn-primary" value="Back To Detail Job" onclick=" relocate_home()">
                                        <button type="button" class="btn btn-primary" data-next="2">Next <i
                                                class="fas fa-arrow-right"></i></button>
                                    </div>

                                </div>
                            </div>

                            <!-- Step 2: Create an App -->
                            <div class="wizard-pane d-none" data-step="2">
                                <div class="form-group row">
                                    <label class="col-md-4 text-md-right text-left">Gaji yang diharapkan?</label>
                                    <div class="col-lg-4 col-md-6">
                                        <select class="form-control select2" name="expectedsalary" required>
                                            <option value="">Pilih</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 text-md-right text-left">Pendidikan</label>
                                    <div class="col-lg-4 col-md-6">
                                        <select class="form-control select2" name="education" required>
                                            <option value="">Pilih</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 text-md-right text-left">Pengalaman Kerja</label>
                                    <div class="col-lg-4 col-md-6">
                                        <select class="form-control select2" name="workexperience" required>
                                            <option value="">Pilih</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                        <button type="button" class="btn btn-primary" data-prev="1"><i
                                                class="fas fa-arrow-left"></i> Previous</button>
                                        <button type="button" class="btn btn-primary" data-next="3">Next <i
                                                class="fas fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Server Information -->
                            <div class="wizard-pane d-none" data-step="3">
                                <div class="form-group row">

                                    <div class="col-lg-8 col-md-6">
                                        <label class="col-md-10 text-md-right text-left"><b>Beri tahu perusahaan tentang
                                                pengalaman kerja anda yang terakhir</b></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 text-md-right text-left">Tulis Keahlian Anda</label>
                                    <div class="col-lg-4 col-md-6">
                                        <textarea name="writeskill" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                        <button type="button" class="btn btn-primary" data-prev="2"><i
                                                class="fas fa-arrow-left"></i> Previous</button>
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

<!-- Modal -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Deskripsi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $getdataDetail->job_description; ?>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
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
function relocate_home() {
    const url = "https://trainingkerja.com/job-grid";
    window.open(url, '_blank'); // Membuka di tab baru
}

document.addEventListener("DOMContentLoaded", function() {
    let currentStep = 1; // Langkah yang sedang aktif
    const totalSteps = 3; // Total langkah dalam wizard
    const wizardForm = document.getElementById('wizardForm'); // Form utama
    const wizardPanes = document.querySelectorAll('.wizard-pane'); // Semua langkah form
    const wizardSteps = document.querySelectorAll('.wizard-step'); // Semua elemen indikator langkah

    // Fungsi untuk mengubah langkah aktif
    function showStep(step) {
        // Tampilkan atau sembunyikan wizard pane
        wizardPanes.forEach((pane, index) => {
            if (index + 1 === step) {
                pane.classList.remove('d-none'); // Tampilkan langkah aktif
            } else {
                pane.classList.add('d-none'); // Sembunyikan langkah lain
            }
        });

        // Perbarui indikator langkah (opsional jika ada wizard step di bagian atas)
        wizardSteps.forEach((stepElem, index) => {
            if (index + 1 === step) {
                stepElem.classList.add('wizard-step-active'); // Aktifkan langkah
            } else {
                stepElem.classList.remove('wizard-step-active'); // Nonaktifkan langkah lainnya
            }
        });

        currentStep = step; // Perbarui langkah aktif
    }

    // Validasi input pada langkah tertentu
    function validateStep(step) {
        const currentPane = document.querySelector(`.wizard-pane[data-step="${step}"]`);
        const inputs = currentPane.querySelectorAll('input, select, textarea');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
                input.classList.add('is-invalid'); // Tambahkan kelas invalid jika tidak valid
            } else {
                input.classList.remove('is-invalid'); // Hapus kelas invalid jika valid
            }
        });

        return isValid;
    }

    // Tambahkan event listener dinamis untuk tombol Next dan Previous
    wizardForm.addEventListener('click', function(e) {
        const target = e.target;
        if (target.matches('[data-next]')) {
            const nextStep = parseInt(target.getAttribute('data-next'));
            if (validateStep(currentStep)) {
                if (nextStep <= totalSteps) {
                    showStep(nextStep);
                }
            } else {
                alert("Please complete all fields in Step " + currentStep);
            }
        }

        if (target.matches('[data-prev]')) {
            const prevStep = parseInt(target.getAttribute('data-prev'));
            if (prevStep > 0) {
                showStep(prevStep);
            }
        }
    });

    // Tangani pengiriman form
    wizardForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman form default
        if (validateStep(currentStep)) {
            alert("Form submitted successfully!");
        } else {
            alert("Please complete all fields.");
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


@push('page-specific-scripts')

<script type="text/javascript">
window.history.forward(1);
</script>
@endpush
@endsection