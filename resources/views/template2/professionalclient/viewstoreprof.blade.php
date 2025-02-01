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
          <h1>Profesional Patner</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Apply</a></div>
            <div class="breadcrumb-item"><a href="#">Training Profesional</a></div>
            <div class="breadcrumb-item">Create Profesional Patner</div>
        </div>
        </div>

        <div class="section-body">
          

          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card">
                
                <div class="card-body">
                  <form id="taskForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>PROFESSIONAL PARTNER DATABASE / CONSTRUCTION PROFESSIONAL DATABASE</label> 
                                <select name="mproftraining" id="profesionalPatner"  class="form-control select2">
                                    <option value="">Pilih Profesional Patner</option>
                                </select>
                            </div>
                        </div>
                        <!-- Form 1 -->
                        <div class="form-row" id="form1">
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
                                <textarea name="otherbgrndeducation" class="form-control"></textarea>
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
                                <textarea name="residence" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owned Certification / Sertifikasi yang di Miliki ( Lainnya )</label>
                                <textarea name="othersertifikat" class="form-control"></textarea>
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
                                <textarea name="othersoftware" class="form-control"></textarea>
                            </div>
                            

                            <div class="form-group col-md-6">
                                <label>Berminat untuk menjadi trainer ?</label>
                                <select name="mtrainer" id="trainer" class="form-control select2">
                                    <option value="">Pilih trainer</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Biaya / Fee yang diharapkan Per Jam ? </label>
                                <input type="text" name="fee" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Appload CV </label>
                                <input type="file" name="cvpath" class="form-control">
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
                         <!-- Form 2 -->
                        <div class="form-row" id="form2">
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
                                <input type="text" readonly name="tunjangan2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Appload CV </label>
                                <input type="file" name="cvpath2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Appload Portofolio  ( untuk video berikan link videonya tuliskan dalam word kemudian di appload ) </label>
                                <input type="file" name="portofoliopath2" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
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
            function toggleForms() {
                var selectedValue = $('#profesionalPatner').val();
                
                if (selectedValue === '1') {
                    $('#form1 :input').prop('disabled', false);
                    $('#form1').show();
                    $('#form2 :input').prop('disabled', true);
                    $('#form2').hide();
                } else if (selectedValue === '2') {
                    $('#form1 :input').prop('disabled', true);
                    $('#form1').hide();
                    $('#form2 :input').prop('disabled', false);
                    $('#form2').show();
                } else {
                    $('#form1 :input, #form2 :input').prop('disabled', true);
                    $('#form1, #form2').hide();
                }
            }

            $('#profesionalPatner').change(toggleForms);
            toggleForms(); // Panggil saat halaman dimuat untuk set awal
        });

        $(document).ready(function() {
            function loadOptions(url, selectId) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $(selectId).empty().append('<option value="">Pilih</option>');
                        $.each(response.data, function(index, item) {
                            $(selectId).append('<option value="' + item.id + '">' + item.nama + '</option>');
                        });
                    },
                    error: function() {task.idducation
                        alert('Gagal memuat data ' + selectId);
                    }
                });
            }

            // Panggil fungsi untuk mengisi dropdown
            
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

            loadOptions('/get-posisi-diminati', '#posisiDiminati');
            loadOptions('/get-epc', '#epc');
            loadOptions('/get-salaray', '#salaray');
            loadOptions('/get-background-pendidikan', '#backgroundPendidikan2');
            loadOptions('/get-jenjang-pendidikan', '#jenjangPendidikan2');
            loadOptions('/get-province-data', '#provinceData2');
            loadOptions('/get-age-Data', '#ageData2');
            loadOptions('/get-workexperience-Data', '#workexperience2');
            loadOptions('/get-sertifikat-Data', '#sertifikat2');
            loadOptions('/get-software-Data', '#software2');
            // Handle form submit
            $("#taskForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/insert-task',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $("#form1")[0].reset(); // Reset form setelah sukses form1
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Simpan data Profesional Patner',
                            }).then(() => {
                                window.location.href = "{{ route('professionalclientindex') }}"; // Redirect setelah sukses
                            });
                        } else {
                            alert('Gagal menyimpan data');
                        }
                    },
                    error: function(xhr) {
                        // alert('Terjadi kesalahan: ' + xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ada kesalahan saat simpan data Profesional Patner. Silakan coba lagi.',
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