@extends('template2.layouts.app')
@section('title')
    Pembayaran Training
@endsection
@section('content')
    @push('page-specific-css')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('assets2/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets2/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets2/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    @endpush
    <section class="section">
        <div class="section-header">
            <h1>Pembayaran Training</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Apply</a></div>
              <div class="breadcrumb-item">Pembayaran Training</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card-header" style="background:rgb(255, 255, 255) ">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('http://admin.trainingkerja.com/public/storage/' . ($data['getdtTraining']->imagetraining  ?? '')) }}"
                        alt="Logo" style="width: 255px; height: 105px; margin-right: 10px;">
                    <div>
                        <h2 class="mb-0">{{ $data['getdtTraining']->traning_name }}</h2>
                        <small>{{ $data['getdtTraining']->company_name }}</small>
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Lihat deskripsi Training
                        </button>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card">
                    
                    <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail4">Bank</label>
                                
                                    {{-- <select name="idbank" id="idbank" class="form-control" required>
                                        <option value="" disabled selected>Pilih Bank</option>
                                        @foreach ($data['bankAccount'] as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                        @endforeach 
                                    </select> --}}
                                    <select name="idbank" id="idbank" class="form-control" required>
                                        <option value="" disabled {{ empty($data['selectedBankId']) ? 'selected' : '' }}>Pilih Bank</option>
                                        @foreach ($data['bankAccount'] as $bank)
                                            <option value="{{ $bank->id }}" {{ $bank->id == $data['selectedBankId'] ? 'selected' : '' }}>
                                                {{ $bank->bank_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                            </div>
                            <div class="form-group" id="transferInfo">
                                <label for="accountDetails">Pilih Rekening</label>
                                <select name="accountDetails" id="accountDetails" class="form-control">
                                    <option value="" disabled selected>Pilih Rekening Transfer</option>
                                    @foreach ($data['accountsTransfer'] as $account)
                                        <option value="{{ $account->id }}" 
                                            {{ isset($data['selectedAccountId']) && $data['selectedAccountId'] == $account->id ? 'selected' : '' }}>
                                            {{ $account->nama }} - {{ $account->nomor_rekening }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card">
                  <div class="card-body">
                      <form method="post" id="paymentForm" class="needs-validation" novalidate="" enctype="multipart/form-data">
                          @csrf
                          <input type="text" name="idtraining" id="idtraining" readonly hidden value="{{$data['idtraining']}}" class="form-control" required>
                          <input type="text" name="idusers" id="idusers" readonly hidden value="{{$data['idusers']}}" class="form-control" required>
                          <div class="form-group">
                              <label for="inputEmail4">Jumlah Pembayaran</label>
                              <input type="text" name="amount" id="amount" readonly value="{{$data['getdtTraining']->registrationfee}}" class="form-control" required>
                          </div>
                          <div class="form-group ">
                              <label for="inputEmail4">Upload Bukti Pembayaran</label></br>                              
                              <div class="input-group mb-3">
                                <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="input-group-append">
                                    @if ($data['getdtTraining']->payment_proof !="" || $data['getdtTraining']->payment_proof !=null)
                                    <a href="javascript:void(0);" class="btn btn-primary" id="viewButton">View</a>
                                    @endif
                                </div>
                              </div>

                          </div>
                          <div class="card-footer text-right">
                              <button class="btn btn-primary">Bayar</button>
                          </div>
                      </form>
                  </div>
              </div>

            </div>
          </div>
        </div>
      </section>
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <br>
            <div class="modal-body">
                <h5>About training</h5>
                <?php echo $data['getdtTraining']->abouttraining; ?>
                <br>
                <h5>Trainer</h5>
                <?php echo $data['getdtTraining']->abouttrainer; ?>
                <br>
                <h5>Career</h5>
                <?php echo $data['getdtTraining']->aboutcareer; ?>
            </div>
        </div>
    </div>
</div>
      <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Pembayaran Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Terima kasih! Pembayaran Anda telah berhasil dikirim. Kami akan memprosesnya secepat mungkin.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModalButton" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentProofModal" tabindex="-1" role="dialog" aria-labelledby="paymentProofModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentProofModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tempat untuk menampilkan gambar atau PDF -->
                    <div id="modalContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
<script>

    document.getElementById('viewButton').addEventListener('click', function() {
        var paymentProofUrl = "{{ asset('storage/' . $data['getdtTraining']->payment_proof) }}";
        var modalContent = document.getElementById('modalContent');

        // Cek apakah file adalah gambar atau PDF
        var fileExtension = paymentProofUrl.split('.').pop().toLowerCase();

        if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
            // Tampilkan gambar dalam modal
            modalContent.innerHTML = `<img src="${paymentProofUrl}" class="img-fluid" alt="Bukti Pembayaran">`;
        } else if (fileExtension === 'pdf') {
            // Tampilkan PDF dalam modal menggunakan embed
            modalContent.innerHTML = `<embed src="${paymentProofUrl}" width="100%" height="400px" type="application/pdf">`;
        } else {
            modalContent.innerHTML = 'File tidak dapat ditampilkan.';
        }

        // Tampilkan modal
        $('#paymentProofModal').modal('show');
    });

    // AJAX untuk mengambil data rekening transfer berdasarkan bank yang dipilih
    document.getElementById('idbank').addEventListener('change', function () {
        var idbank = this.value;

        // Cek jika idbank terpilih
        if (idbank) {
            fetch(`/accounts-transfer/${idbank}`)
                .then(response => response.json())
                .then(data => {
                    var accountSelect = document.getElementById('accountDetails');
                    accountSelect.innerHTML = '<option value="" disabled selected>Pilih Rekening Transfer</option>'; // Reset pilihan
                    data.forEach(function(account) {
                        var option = document.createElement('option');
                        option.value = account.id;
                        option.textContent = account.nama + ' - ' + account.nomor_rekening;

                        // Set selected if the account ID matches
                        if (account.id === {{ isset($data['selectedAccountId']) ? $data['selectedAccountId'] : 'null' }}) {
                            option.selected = true;
                        }

                        accountSelect.appendChild(option);
                    });

                    // Tampilkan bagian rekening transfer
                    document.getElementById('transferInfo').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        } else {
            // Jika tidak ada bank yang dipilih, sembunyikan bagian transfer
            document.getElementById('transferInfo').style.display = 'none';
        }
    });

    // Form submission (sebelumnya sudah dijelaskan)
    document.querySelector('#paymentForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Ambil data dari form
        const formData = new FormData(this);

        // Tambahkan id accountDetails ke dalam FormData
        const accountDetails = document.getElementById('accountDetails').value;
        if (accountDetails) {
            formData.append('accountDetails', accountDetails);
        } else {
            alert('Harap pilih rekening transfer.');
            return; // Hentikan pengiriman jika tidak ada rekening transfer yang dipilih
        }

        // Kirim data melalui fetch
        fetch("{{ route('storePayment') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    $('#successModal').modal('show'); // Tampilkan modal
                    document.querySelector('#paymentForm').reset(); // Reset form
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
    });

    document.getElementById('closeModalButton').addEventListener('click', function () {
        // Redirect ke halaman trainingclientindex
        window.location.href = "{{ route('trainingclientindex') }}";
    });
</script>
@endsection
