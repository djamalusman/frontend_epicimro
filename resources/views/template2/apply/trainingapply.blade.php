jobapply
@extends('template1.layouts.app')
@section('title')
Register Training
@endsection
@section('content')

<!-- CSS Libraries -->

<link rel="stylesheet" href="{{ asset('assets2/modules/select2/dist/css/select2.min.css')}}">
 <!-- General CSS Files -->
 <link rel="stylesheet" href="{{ asset('assets2/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets2/modules/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets2/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets2/css/components.css')}}">

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

.button-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
  }

  .button-link:hover {
    background-color: #0056b3;
  }

</style>
<section class="section-box">
    <div class="box-head-single">
        <div class="container">
        <div class="d-flex align-items-center">
            <img src="{{ asset('http://admin.trainingkerja.com/public/storage/' . ($imagetraining->nama ?? '')) }}"
                alt="Logo" style="width: 255px; height: 105px; margin-right: 10px;">
            <div>
                <h2 class="mb-0">{{ $getdataDetail->traning_name }}</h2>
                <small>{{ $getdataDetail->company_name }}</small>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Lihat deskripsi pekerjaa
                </button>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-body">
            <br>
            <div class="row">
                <div class="col-12">
                
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
                                                Data Kandidat
                                            </div>
                                        </div>
                                        <!-- Step 2: Create an App -->
                                        <div class="wizard-step" id="step2">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Riwayat Kandidat
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <form id="wizardForm" class="wizard-content mt-2" method="POST" action="{{ route('storeTrainingClient') }}" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                @csrf
                                <input hidden type="text" name="idtraining" value="{{ $idtraining }}" class="form-control" required>
                                <input hidden type="text" name="emailsession" value="{{ session('email') }}"
                                    class="form-control" required>

                                <!-- Step 1: User Account -->
                                <div class="wizard-pane d-none" data-step="1">
                                   
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Nama</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" value="{{session('name')}}" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Email</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" value="{{session('email')}}" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">No.Tlp</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text"  readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Pendidikan</label>
                                        <div class="col-lg-4 col-md-6">
                                            <select class="form-control select2" name="education" required>
                                                <option value="">Pilih</option>
                                                @foreach ($education as $val)
                                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                            <a href="{{'/course-grid'}}" class="btn btn-primary">Back to Job</a>
                                            <button type="button" class="btn btn-primary" data-next="2">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-pane d-none" data-step="2">
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Belum Bekerja</label>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="custom-switch-checkbox"  class="custom-switch-input" id="jobStatusCheckbox">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Posisi pekerjaan</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" name="positionWork" class="form-control" id="positionWork">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Nama Perusahaan</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" name="companyName" class="form-control" id="companyName">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Keahlian Anda</label>
                                        <div class="col-lg-4 col-md-6">
                                            <textarea name="writeskill" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right text-left">Pelatihan yang pernah di ikuti</label>
                                        <div class="col-lg-4 col-md-6">
                                            <textarea name="trainingcourse" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-6 offset-md-4 text-right">
                                            <button type="button" class="btn btn-primary" data-prev="1">Previous</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    
                </div>
            </div>
        </div>
    </section>
</section>
<!-- Modal -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <br>
            <div class="modal-body">
                <h5>About training</h5>
                <?php echo $getdataDetail->abouttraining; ?>
                <br>
                <h5>Trainer</h5>
                <?php echo $getdataDetail->abouttrainer; ?>
                <br>
                <h5>cCreer</h5>
                <?php echo $getdataDetail->aboutcareer; ?>
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
<script src="{{ asset('assets2/modules/jquery.min.js')}}"></script>
<script src="{{ asset('assets2/modules/popper.js')}}"></script>
<script src="{{ asset('assets2/modules/tooltip.js')}}"></script>
<script src="{{ asset('assets2/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets2/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('assets2/modules/moment.min.js')}}"></script>
<script src="{{ asset('assets2/js/stisla.js')}}"></script>
<script src="{{ asset('assets2/modules/select2/dist/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
<script src="{{ asset('assets2/js/scripts.js')}}"></script>
<script src="{{ asset('assets2/js/custom.js')}}"></script>
<script type="text/javascript">
    function relocate_home() {
        const url = "https://trainingkerja.com/job-grid";
        window.open(url, '_blank'); // Membuka di tab baru
    }
    setInterval(function() {
        // Mengecek session 'email'
        var emailSession = @json(session('email'));

        if (!emailSession) {
            // Jika session email null atau tidak ada, arahkan ke halaman welcome
            window.location.href = "{{ route('redirectToLogin') }}";
        }
    }, 1000); // Setiap 1000 ms (1 detik)
    
    // Get the checkbox and input fields
    const jobStatusCheckbox = document.getElementById('jobStatusCheckbox');
    const positionWorkInput = document.getElementById('positionWork');
    const companyNameInput = document.getElementById('companyName');

    // Add event listener to the checkbox
    jobStatusCheckbox.addEventListener('change', function() {
        const isDisabled = jobStatusCheckbox.checked;
        positionWorkInput.disabled = isDisabled;
        companyNameInput.disabled = isDisabled;
    });
    
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
                Swal.fire({
                    title: 'Success!',
                    text: 'Form submitted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please complete all fields.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Kirim form jika di langkah terakhir
        wizardForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah pengiriman form default

            // Validasi input pada langkah aktif
            if (validateStep(currentStep)) {
                var emailSession = @json(session('email'));
                if (!emailSession) {
                    // Redirect jika session email tidak ada
                    window.location.href = "{{ route('redirectToLogin') }}";
                    return;
                }

                // Jika valid, kirim form
                const formData = new FormData(wizardForm);

                fetch('{{ route('storeTrainingClient') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tampilkan SweetAlert2 jika berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pendaftaran berhasil,silahkan melakukan pembayaran',
                        }).then(() => {
                            window.location.href = "{{ route('trainingclientindex') }}"; // Redirect setelah sukses
                        });
                    } else {
                        // Tampilkan SweetAlert2 jika gagal
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ada kesalahan saat mengirim lamaran. Silakan coba lagi.',
                        });
                    }
                })
                .catch(error => {
                    // Tampilkan SweetAlert2 jika terjadi error
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirim form.',
                    });
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Harap lengkapi semua kolom.',
                });
            }
        }); 

        // Inisialisasi untuk menunjukkan langkah pertama
        showStep(currentStep);
    });
    window.history.forward(1);
</script>

@endsection

