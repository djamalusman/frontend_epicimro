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
                  <form id="editTaskForm">
                    <input type="hidden" name="id" value="{{$data['idprof']}}" id="taskId"> <!-- Untuk menyimpan ID data yang akan diedit -->

                    <div class="form-row">
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
                            <select name="mnamabgroudneducation" id="backgroundPendidikan"  class="form-control select2">
                                <option value="">Pilih Background Pendidikan</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Background Pendidikan ( Lainnya )</label>
                            <textarea name="otherbgrndeducation" id="otherbgrndeducation" class="form-control"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Jenjang Pendidikan Terakhir</label>
                            <select name="mnamaeducation" id="jenjangPendidikan"  class="form-control select2">
                                <option value="">Pilih Jenjang Pendidikan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Province of Domicile / Propinsi Tempat Tinggal </label>
                            <select name="mprovinceData" id="provinceData"  class="form-control select2">
                                <option value="">Pilih Jenjang Pendidikan</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>City Of Domicile / Kota Domisili / Tempat Tinggal</label>
                            <textarea name="residence" id="residence" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Owned Certification / Sertifikasi yang di Miliki ( Lainnya )</label>
                            <textarea name="othersertifikat" id="othersertifikat" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Age / Umur</label>
                            <select name="mage" id="ageData"  class="form-control select2">
                                <option value="">Pilih Age / Umur</option>
                            </select>
                        </div>
                    
                        
                        <div class="form-group col-md-6">
                            <label>Work Experience  / Pengalaman Pekerjaan</label>
                            <select name="mworkexperience" id="workexperience"  class="form-control select2">
                                <option value="">Pilih Work Experience  / Pengalaman Pekerjaan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Owned Certification / Sertifikasi yang di Miliki
                            </label>
                            <select name="msertifikat" id="sertifikat"  class="form-control select2">
                                <option value="">Pilih Owned Certification / Sertifikasi yang di Miliki</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bidang / Category Training yang diminati</label>
                            <select name="mbidang" id="bidang"  class="form-control select2">
                                <option value="">Pilih Bidang / Category Training yang diminati</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Software yang di kuasai</label>
                            <select name="msoftware"  id="software" class="form-control select2">
                                <option value="">Pilih Software yang di kuasai</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Software yang di kuasai ( Lainnya )</label>
                            <textarea name="othersoftware" id="othersoftware" class="form-control"></textarea>
                        </div>
                        

                        <div class="form-group col-md-6">
                            <label>Berminat untuk menjadi trainer ?</label>
                            <select name="mtrainer" id="trainer" class="form-control select2">
                                <option value="">Pilih trainer</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Biaya / Fee yang diharapkan Per Jam ? </label>
                            <input type="text" name="fee" id="fee" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cv</label></br>
                            <div class="input-group mb-3">
                                <!-- Menampilkan path file CV di input teks (readonly) -->
                                <input type="text" class="form-control" id="cvPath">
                                <div class="input-group-append">
                                    <!-- Tombol View untuk melihat file CV -->
                                    <a href="#" id="viewCvButton" class="btn btn-primary" style="display:none;" type="button" rel="noopener noreferrer"> View</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Appload Sertifikat</label>
                            <input type="file" name="sertifikatpath" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Appload Foto</label>
                            <input type="file" name="fotopath" class="form-control">
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
        function loadOptions(url, selectId, selectedValue) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $(selectId).empty().append('<option value="">Pilih</option>');
                    $.each(response.data, function(index, item) {
                        // Menambahkan selected pada option yang sesuai
                        var isSelected = item.id == selectedValue ? 'selected' : '';
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

            loadOptions('/get-bidang-Data', '#bidang');
            loadOptions('/get-software-Data', '#software');
            loadOptions('/get-trainer-Data', '#trainer');
        // Ambil data yang akan diedit
        var taskId = {{$data['idprof']}}; // ID data yang akan diedit, bisa diambil dari URL atau variabel
        $.ajax({
            url: '/get-taskedit/' + taskId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var task = response.data;
                    
                    loadOptions('/get-profesionalPatner', '#profesionalPatner', task.idrof_training);
                    loadOptions('/get-background-pendidikan', '#backgroundPendidikan',task.idbgroundeducation);
                    $('#otherbgrndeducation').val(task.other_bgrnd_education);
                    loadOptions('/get-jenjang-pendidikan', '#jenjangPendidikan',task.idducation);
                    loadOptions('/get-province-data', '#provinceData',task.idprovince);
                    $('#residence').val(task.residence);
                    loadOptions('/get-age-Data', '#ageData',task.idage);
                    loadOptions('/get-workexperience-Data', '#workexperience',task.idexperiencelevel);
                    loadOptions('/get-sertifikat-Data', '#sertifikat',task.idsertifikat);
                    $('#othersertifikat').val(task.other_certification);
                    
                    loadOptions('/get-software-Data', '#software',task.idsoftware);
                    $('#othersoftware').val(task.other_software);
                    loadOptions('/get-bidang-Data', '#bidang',task.idBidang);
                    loadOptions('/get-trainer-Data', '#trainer',task.idtrainer);
                    $('#fee').val(task.expected_fee_hour);
                    // Mengatur nilai file path dan mengaktifkan tombol View
                    $('#cvPath').val(task.cvpath); // Memasukkan path file CV
                    $('#viewCvButton').show(); // Menampilkan tombol View jika ada file
                    // loadOptions('/get-posisi-diminati', '#posisiDiminati', task.idjobvacancy);
                    // loadOptions('/get-posisi-diminati', '#posisiDiminati', task.idtrainer);
                    // loadOptions('/get-posisi-diminati', '#posisiDiminati', task.ideproject);
                    // loadOptions('/get-posisi-diminati', '#posisiDiminati', task.idsalary);
                    console.log("CV Path: ", task.cvpath);

                }
            },
            error: function(xhr) {
                alert('Gagal memuat data untuk diedit');
            }
        });

        // Menangani klik tombol View untuk melihat file CV
        $('#viewCvButton').click(function(e) {
            e.preventDefault();
            
            // Ambil path file CV
            var cvPath = $('#cvPath').val();
            console.log(cvPath);
            
            if (cvPath) {
                // Tentukan URL lengkap untuk menampilkan file
                var fileUrl = "{{ asset('storage') }}/" + cvPath;

                // Buka file di tab baru
                window.open(fileUrl, '_blank'); // Membuka file di tab baru
            } else {
                alert("File tidak ditemukan.");
            }
        });

        // Handle form submit untuk update data
        $("#editTaskForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/update-task',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert('Gagal memperbarui data');
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
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