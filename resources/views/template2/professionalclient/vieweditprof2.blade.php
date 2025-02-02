@extends('template2.layouts.app') @section('title')
    Profesional Patner
@endsection
@section('content')
    @push('page-specific-css')
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
      
    @endpush
    <style>
        .select2 {
            width: 100% !important;
            /* Make the Select2 width 100% of its parent */
        }


        /* Optionally, you can specify a custom fixed width */
        .select2-container {
            width: 100% !important;
            /* Make the container for the select2 control 100% */
        }
    </style>
    <section class="section">
        <div class="section-header">
          <h1>Form</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
            <div class="breadcrumb-item">Form</div>
          </div>
        </div>

        <div class="section-body">
         

          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form id="editTaskForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>PROFESSIONAL PARTNER DATABASE / CONSTRUCTION PROFESSIONAL DATABASE</label> 
                            <input value="CONSTRUCTION PROFESSIONAL DATABASE" readonly class="form-control">
                           
                        </div>
                        <div class="form-group col-md-6" hidden>
                            <label>PROFESSIONAL PARTNER DATABASE / CONSTRUCTION PROFESSIONAL DATABASE</label> 
                            <select name="mproftraining" id="profesionalPatner" class="form-control select2">
                                <option value="">Pilih Profesional Patner</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Name / Nama</label>
                            <input type="text" readonly name="nama" value="{{$data['name']}} {{$data['lastname']}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile Phone / No HP</label>
                            <input type="text" readonly name="nama" value="{{$data['phone']}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email Address / Alamat email</label>
                            <input type="text" readonly name="nama" value="{{$data['email']}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Background Pendidikan</label><br>
                            <select name="mnamabgroudneducation2" id="backgroundPendidikan2"  class="form-control select2">
                                <option value="">Pilih Background Pendidikan</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Background Pendidikan ( Lainnya )</label>
                            <textarea name="otherbgrndeducation2" class="form-control"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Jenjang Pendidikan Terakhir</label>
                            <select name="mnamaeducation2" id="jenjangPendidikan2"  class="form-control select2">
                                <option value="">Pilih Jenjang Pendidikan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Province of Domicile / Propinsi Tempat Tinggal </label>
                            <select name="mprovinceData2" id="provinceData2"  class="form-control select2">
                                <option value="">Pilih Jenjang Pendidikan</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>City Of Domicile / Kota Domisili / Tempat Tinggal</label>
                            <textarea name="residence2" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Owned Certification / Sertifikasi yang di Miliki ( Lainnya )</label>
                            <textarea name="othersertifikat2" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Age / Umur</label>
                            <select name="mage" id="ageData2"  class="form-control select2">
                                <option value="">Pilih Age / Umur</option>
                            </select>
                        </div>
                    
                        
                        <div class="form-group col-md-6">
                            <label>Work Experience  / Pengalaman Pekerjaan</label>
                            <select name="mworkexperience2" id="workexperience2"  class="form-control select2">
                                <option value="">Pilih Work Experience  / Pengalaman Pekerjaan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Owned Certification / Sertifikasi yang di Miliki
                            </label>
                            <select name="msertifikat2" id="sertifikat2"  class="form-control select2">
                                <option value="">Pilih Owned Certification / Sertifikasi yang di Miliki</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>Software yang di kuasai</label>
                            <select name="msoftware2"  id="software2" class="form-control select2">
                                <option value="">Pilih Software yang di kuasai</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Software yang di kuasai ( Lainnya )</label>
                            <textarea name="othersoftware2" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Posisi yang Diminati</label>
                            <select name="mnamajobvacancy2" id="posisiDiminati" class="form-control select2">
                                <option value="">Pilih Posisi</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Dimanakah pengalaman proyek  kontruksi / EPC yang pernah dikerjakan?</label>
                            <select name="mepc2" id="epc" class="form-control select2">
                                <option value="">Pilih Posisi</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gaji perbulan yang diharapkan  / Bulan</label>
                            <select name="msalaray2" id="salaray" class="form-control select2">
                                <option value="">Pilih Posisi</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tunjangan atau benefit lainya yang diharapkan </label>
                            <input type="text" readonly name="tunjangan2" id="tunjangan2" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Appload Cv</label></br>
                            <div class="input-group mb-3">
                                <!-- Menampilkan path file CV di input teks (readonly) -->
                                <input type="file" name="cvpath2" class="form-control" id="cvpath2">
                                <input type="text" hidden class="form-control" id="cvpath2y">
                                <div class="input-group-append">
                                    <!-- Tombol View untuk melihat file CV -->
                                    <a href="#" id="viewCvButton" class="btn btn-primary" style="display:none;" type="button" rel="noopener noreferrer"> View</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Appload Portofolio  ( untuk video berikan link videonya tuliskan dalam word kemudian di appload ) </label>
                            <div class="input-group mb-3">
                                <!-- Menampilkan path file CV di input teks (readonly) -->
                                <input type="file" name="portofoliopath2" class="form-control" id="portofoliopath2">
                                <input type="text" hidden class="form-control" id="portofoliopath2y">
                                <div class="input-group-append">
                                    <!-- Tombol View untuk melihat file CV -->
                                    <a href="#" id="viewportofoliopath2Button" class="btn btn-primary" style="display:none;" type="button" rel="noopener noreferrer"> View</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </section>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('assets2/modules/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>

        <script>
            $(document).ready(function() {
                // Fungsi untuk memuat dropdown
                function loadOptions(url, selectId, selectedValue = null) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $(selectId).empty().append('<option value="">Pilih</option>');
                            $.each(response.data, function(index, item) {
                                var isSelected = selectedValue && item.id == selectedValue ? 'selected' : '';
                                $(selectId).append('<option value="' + item.id + '" ' + isSelected + '>' + item.nama + '</option>');
                            });
                        },
                        error: function() {
                            alert('Gagal memuat data ' + selectId);
                        }
                    });
                }
        
                // Memuat dropdown data ketika halaman di-load
                loadOptions('/get-profesionalPatner', '#profesionalPatner');
                loadOptions('/get-background-pendidikan', '#backgroundPendidikan');
                loadOptions('/get-jenjang-pendidikan', '#jenjangPendidikan');
                loadOptions('/get-province-data', '#provinceData');
                loadOptions('/get-age-Data', '#ageData');
                loadOptions('/get-workexperience-Data', '#workexperience');
                loadOptions('/get-sertifikat-Data', '#sertifikat');
                loadOptions('/get-posisi-diminati', '#posisiDiminati', task.idjobvacancy);
                loadOptions('/get-epc', '#epc', task.ideproject);
                loadOptions('/get-salaray', '#salaray', task.idsalary);
        
                // Ambil data yang akan diedit
                var taskId = {{$data['idprof']}}; 
                if (taskId) {
                    $.ajax({
                        url: '/get-taskedit/' + taskId,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                var task = response.data;
                                
                                loadOptions('/get-profesionalPatner', '#profesionalPatner', task.idrof_training);
                                loadOptions('/get-background-pendidikan', '#backgroundPendidikan', task.idbgroundeducation);
                                $('#otherbgrndeducation').val(task.other_bgrnd_education);
                                loadOptions('/get-jenjang-pendidikan', '#jenjangPendidikan', task.idducation);
                                loadOptions('/get-province-data', '#provinceData', task.idprovince);
                                $('#residence').val(task.residence);
                                loadOptions('/get-age-Data', '#ageData', task.idage);
                                loadOptions('/get-workexperience-Data', '#workexperience', task.idexperiencelevel);
                                loadOptions('/get-sertifikat-Data', '#sertifikat', task.idsertifikat);
                                $('#othersertifikat').val(task.other_certification);
                                
                                loadOptions('/get-software-Data', '#software', task.idsoftware);
                                $('#othersoftware').val(task.other_software);
                                
                                loadOptions('/get-posisi-diminati', '#posisiDiminati', task.idjobvacancy);
                                loadOptions('/get-epc', '#epc', task.ideproject);
                                loadOptions('/get-salaray', '#salaray', task.idsalary);
                                $('#tunjagnan').val(task.tunjangan2);
                                // Set file path dan tampilkan tombol jika ada file
                                setFilePath('#cvpath2y', '#viewCvButton', task.cvpath);
                                setFilePath('#portofoliopath2y', '#viewportofoliopath2Button', task.portofoliopath);
                            }
                        },
                        error: function() {
                            alert('Gagal memuat data untuk diedit');
                        }
                    });
                }
        
                // Menampilkan tombol hanya jika ada file
                function setFilePath(inputId, buttonId, filePath) {
                    $(inputId).val(filePath);
                    if (filePath) {
                        $(buttonId).show();
                    } else {
                        $(buttonId).hide();
                    }
                }
        
                // Fungsi untuk menangani klik tombol View file
                function viewFile(buttonId, inputId) {
                    $(buttonId).click(function(e) {
                        e.preventDefault();
                        var filePath = $(inputId).val();
                        if (filePath) {
                            var fileUrl = "{{ asset('storage') }}/" + filePath;
                            window.open(fileUrl, '_blank');
                        } else {
                            alert("File tidak ditemukan.");
                        }
                    });
                }
        
                // Panggil fungsi untuk setiap tombol file
                viewFile('#viewCvButton', '#cvpath2y');
                viewFile('#viewportofoliopath2Button', '#portofoliopath2y');
        
                // Handle form submit untuk update data
                $("#editTaskForm").submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '/update-task',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Memperbarui data',
                                }).then(() => {
                                    window.location.href = "{{ route('professionalclientindex') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Memperbarui data. Silakan coba lagi.',
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan. Silakan coba lagi.',
                            });
                        }
                    });
                });
            });
        
        
        </script>

    @push('page-specific-scripts')
    <script type="text/javascript">
        window.history.forward(1);
    </script>
@endpush
@endsection