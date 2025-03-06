@extends('layouts.app')
@section('title', 'Input Job')


@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/') }}plugins/summernote/summernote-bs4.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
<style>

 #inputText {
        width: 100%;
        height: 40px;
        padding: 0.5em;
        margin-bottom: 1em;
        font-size: 1em;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5em 1em;
        margin: 0.2em;
        background-color: #007bff;
        color: white;
        border-radius: 0.5em;
        font-size: 1em;
        line-height: 1.5; /* Menyesuaikan tinggi baris */
        height: 2.5em; /* Menyesuaikan tinggi badge */
    }

    .badge .close {
        margin-left: 0.5em;
        cursor: pointer;
        font-weight: bold;
    }


    #inputTextLevel {
        width: 100%;
        height: 40px;
        padding: 0.5em;
        margin-bottom: 1em;
        font-size: 1em;
    }

    .badgeLevel {
        display: inline-flex;
        align-items: center;
        padding: 0.5em 1em;
        margin: 0.2em;
        background-color: #007bff;
        color: white;
        border-radius: 0.5em;
        font-size: 1em;
        line-height: 1.5; /* Menyesuaikan tinggi baris */
        height: 2.5em; /* Menyesuaikan tinggi badge */
    }

    .badgeLevel .close {
        margin-left: 0.5em;
        cursor: pointer;
        font-weight: bold;
    }


    #inputTextEdit {
        width: 100%;
        height: 40px;
        padding: 0.5em;
        margin-bottom: 1em;
        font-size: 1em;
    }

    .badgeEdit {
        display: inline-flex;
        align-items: center;
        padding: 0.5em 1em;
        margin: 0.2em;
        background-color: #007bff;
        color: white;
        border-radius: 0.5em;
        font-size: 1em;
        line-height: 1.5; /* Menyesuaikan tinggi baris */
        height: 2.5em; /* Menyesuaikan tinggi badge */
    }

    .badgeEdit .close {
        margin-left: 0.5em;
        cursor: pointer;
        font-weight: bold;
    }

    #inputTextLevelEdit {
        width: 100%;
        height: 40px;
        padding: 0.5em;
        margin-bottom: 1em;
        font-size: 1em;
    }

    .badgeLevelEdit {
        display: inline-flex;
        align-items: center;
        padding: 0.5em 1em;
        margin: 0.2em;
        background-color: #007bff;
        color: white;
        border-radius: 0.5em;
        font-size: 1em;
        line-height: 1.5; /* Menyesuaikan tinggi baris */
        height: 2.5em; /* Menyesuaikan tinggi badge */
    }

    .badgeLevelEdit .close {
        margin-left: 0.5em;
        cursor: pointer;
        font-weight: bold;
    }

.modal-body {
    max-height: 400px;
    max-width: 500px;
    overflow-y: auto;
}
@keyframes checkAnimation {
      0% { transform: scale(0); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }

    .modal-content {
      text-align: center;
      padding: 20px;
    }

    .check-icon {
      font-size: 5em;
      color: green;
      animation: checkAnimation 1s;
    }

    .error-icon {
    font-size: 5em;
    color: red;
    animation: checkAnimation 1s;
}

    .btn-ok {
      background-color: green;
      color: white;
    }
    .form-group {
    margin-bottom: 1rem; /* Menambahkan jarak bawah antar grup form */
  }
  .form-group label {
    display: block; /* Menampilkan label sebagai block untuk memastikan label berada di atas input */
    margin-bottom: .5rem; /* Menambahkan jarak antara label dan input */
  }
  .form-control {
    width: 100%; /* Pastikan input mengambil lebar penuh dari form group */
  }

  .loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050; /* Make sure it's above other elements */
}
.spinner-border.medium {
    width: 5rem; /* Atur lebar spinner */
    height: 5rem; /* Atur tinggi spinner */
    border-width: .55em; /* Atur ketebalan border spinner */
}

.spinner-border.custom-color {
    border-color: rgba(0, 0, 0, 0.1); /* Warna border spinner yang lebih terang */
    border-top-color: #e8f0fa; /* Warna spinner (warna utama) */
}
/* Efek zoom pada gambar thumbnail */
.img-thumbnail {
    transition: transform 0.3s ease; /* Animasi zoom */
    cursor: pointer; /* Kursor pointer untuk menunjukkan gambar dapat diklik */
}

.img-thumbnail:hover {
    transform: scale(1.6); /* Memperbesar gambar saat di-hover, gunakan nilai yang lebih tinggi untuk zoom lebih besar */
}
.modal-body img {
    max-width: 100%; /* Memastikan gambar tidak melebihi lebar modal */
    height: 100px!important; /* Menjaga rasio aspek gambar */
}
</style>
<section class="section-box">
    <div class="box-head-single box-head-single-candidate">
        <div class="container">
            @foreach($personalsummarys as $personalsummary)
            <div class="heading-image-rd online">
                <a href="#">
                    <figure>
                        <img src="{{ asset('/storage/' . ($personalsummary->photo ?? '')) }}">
                    </figure>
                </a>
            </div>
                <div class="heading-main-info">
                    <h4 class="mb-20 mt-25">{{ $personalsummary->name }} {{ $personalsummary->lastname }}

                    </h4>
                    <div class="head-info-profile">
                        <span class="text-small mr-20"><i class="fi-rr-marker text-mutted"></i>{{$personalsummary->provinsi_name}},{{$personalsummary->company_address}}</span>
                        <span class="text-small mr-20"><i class="fi fi-rr-envelope"></i> {{ $personalsummary->email }}</span>
                        <span class="text-small"><i class="fi-rr-phone-call text-mutted"></i> {{ $personalsummary->phone }}</span>

                    </div>
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">{{$personalsummary->sector_name}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-box mt-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="content-single">
                    <div class="divider"></div>
                            <h4 class="mb-20 mt-25">Tambah Job</h4>
                            <form id="training-form" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Photo</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="file" class="form-control photo" id="photo" name="photo">
                                        </span>
                                    </div>

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Jobs Title</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="text" class="form-control" id="jobTitle" name="jobTitle">
                                        </span>
                                    </div>

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Employment Status</strong>
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="employmentStatus" name="employmentStatus">
                                               <option>--Pilih Employee status--</option>
                                                @foreach($listemployeestatus as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Employment Status</strong>
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="workLocation" name="workLocation">
                                                <option>--Pilih Placement--</option>
                                                @foreach($listworklocation as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                    </div>


                                    <div class="col-md-4 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Est. Salary</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="estSalary" name="estSalary">
                                                <option>--Pilih Salaray--</option>
                                                @foreach($listsalary as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20 mt-25">
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="salaryDateMonth" name="salaryDateMonth">
                                                <option>--Pilih Fee--</option>
                                                @foreach($listfee as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Sector</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="sector" name="sector">
                                                <option>--Pilih Sector--</option>
                                                @foreach($listsector as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <!-- Provinsi -->
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Provinsi</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="provinsi" name="provinsi">
                                                <option>Pilih Provinsi</option>
                                                @foreach($listprovinsi as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <!-- Lokasi -->
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">City</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                             <input type="text" class="form-control" id="lokasi" name="lokasi">
                                        </span>
                                    </div>

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Link Pendaftaran</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                             <input type="text" class="form-control" id="link_pendaftaran" name="link_pendaftaran">
                                        </span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-section-title col-md-2" style="color: #007bff"><h4><b>Requirement</b></h4></div>
                                    </div>

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Education</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="education" name="education">
                                                <option>--Pilih Education--</option>
                                                @foreach($listeducation as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Experience Level</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control2 dis-block text-muted text-md-lh24" style="height:44px;" id="experienceLevel" name="experienceLevel">
                                                <option>--Pilih Experience Level--</option>
                                                @foreach($listexperiencelevel as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>

                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Certification</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="text" class="form-control" id="certification" name="certification">
                                        </span>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-12 mb-20">
                                        <label for="abouttraining" class="form-label"><strong>Jobs Description</strong></label>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <textarea class="form-control descJobdesc" name="jobdescripsi" id="jobdescripsi" rows="4" cols="50"></textarea>
                                        </span>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-12 mb-20">
                                        <label for="abouttraining" class="form-label"><strong>Skill Requirement</strong></label>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <textarea class="form-control descReqdesc" name="skillRequirement" id="skillRequirement" rows="4" cols="50"></textarea>
                                        </span>
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-section-title col-md-2" style="color: #007bff"><h4><b>Schedule</b></h4></div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Publish Date mulai</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control" style="height:45px;" id="jadwal_mulai_tanggal" name="jadwal_mulai_tanggal">
                                                <option>Tanggal</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20 mt-25">
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control" style="height:45px;" id="jadwal_mulai_bulan" name="jadwal_mulai_bulan">
                                                <option>Bulan</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20 mt-25">
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control" style="height:45px;" id="jadwal_mulai_tahun" name="jadwal_mulai_tahun">
                                                <option>Tahun</option><br>
                                                <br>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Publish Date selesai</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control" style="height:45px;"  id="jadwal_selesai_tanggal" name="jadwal_selesai_tanggal">
                                                <option>Tanggal</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20 mt-25">
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control" style="height:45px;"  id="jadwal_selesai_bulan" name="jadwal_selesai_bulan">
                                                <option>Bulan</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20 mt-25">
                                        <span class="dis-block text-muted text-md-lh24">
                                        <select class="form-control" style="height:45px;"  id="jadwal_selesai_tahun" name="jadwal_selesai_tahun">
                                                <option>Tahun</option>
                                            </select>
                                        </span>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                                            <button type="button" id="preview-btn" class="btn btn-info">Preview</button>&nbsp;&nbsp;
                                            <button type="button" id="pending-btn" class="btn btn-warning">Pending</button>&nbsp;&nbsp;
                                            <button type="button" id="publish-btn" class="btn btn-primary">Publish</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>

            <!-- Sidebar -->

        </div>
    </div>

</section>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap (jika diperlukan oleh Summernote) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote -->

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- Plugin lainnya -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/') }}dist/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>\
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('/') }}plugins/summernote/summernote-bs4.min.js"></script>

<script>



function formatDate(dateStr) {
        if (!dateStr) return '';

        var parts = dateStr.split(' ')[0].split('-');
        var date = new Date(parts[0], parts[1] - 1, parts[2]);

        var day = date.getDate();
        var month = date.toLocaleString('default', { month: 'long' });
        var year = date.getFullYear();

        return day + ' ' + month + ' ' + year;
    }

$(document).ready(function() {
        // Function to show loading indicator
        function showLoading() {
            $('#loadingOverlay').show();
        }

        // Function to hide loading indicator
        function hideLoading() {
            $('#loadingOverlay').hide();
        }

        $('input[type="file"]').change(function(e) {
            console.log('Picture Changed');
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            const [file] = $(this)[0].files;
            if (file) {
                $(".simulasi-gambar-" + this.id).attr("src", URL.createObjectURL(file));
            }
            $(this).next(".custom-file-label").html(files.join(", "));
        });

        $('#preview-btn').click(function() {
            // Fungsi untuk mengubah format tanggal MM/DD/YYYY ke YYYY-MM-DD
            // function formatDate(inputDate) {
            //     if (!inputDate) return null;
            //     const [month, day, year] = inputDate.split('/');
            //     return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
            // }
            function stripHtmlTags(text) {
                return text.replace(/<\/?[^>]+>/gi, '');
            }


            var formData = {
                jobTitle: $('#jobTitle').val(),
                employmentStatus: $('#employmentStatus').val(),
                workLocation: $('#workLocation').val(),
                salaryDateMonth: $('#salaryDateMonth').val(),
                estSalary: $('#estSalary').val(),
                sector: formatDate($('#sector').val()),
                provinsi: $('#provinsi').val(),
                lokasi: $('#lokasi').val(),
                link_pendaftaran: $('#link_pendaftaran').val(),
                education: $('#education').val(),
                experienceLevel: $('#experienceLevel').val(),
                certification: $('#certification').val(),
                jobdescripsi: $('#jobdescripsi').val(),
                skillRequirement: $('#skillRequirement').val(),
                jadwal_mulai_tanggal: formatDate(`${$('#jadwal_mulai_tahun').val()}-${$('#jadwal_mulai_bulan').val()}-${$('#jadwal_mulai_tanggal').val()}`),
                jadwal_selesai_tanggal: formatDate(`${$('#jadwal_selesai_tahun').val()}-${$('#jadwal_selesai_bulan').val()}-${$('#jadwal_selesai_tanggal').val()}`),
                status: 3
            };

            $('#modal-content').html(`

                <div class="form-group row">
                <label>Job Title</label>
                <input type="text" class="form-control" value="${formData.jobTitle}" readonly>
                </div>

                <div class="form-group row">
                <label>Employee Stataus</label>
                <select class="form-control" readonly>
                    <option value="${formData.employmentStatus}" selected>${$('#employmentStatus option:selected').text()}</option>
                </select>
                </div>

                <div class="form-group row">
                <label>Placement</label>
                <select class="form-control" readonly>
                    <option value="${formData.workLocation}" selected>${$('#workLocation option:selected').text()}</option>
                </select>
                </div>

                <div class="form-group row">
                <label>Fee</label>
                <select class="form-control" readonly>
                    <option value="${formData.salaryDateMonth}" selected>${$('#salaryDateMonth option:selected').text()}</option>
                </select>
                </div>

                <div class="form-group row">
                <label>Salaray</label>
                <select class="form-control" readonly>
                    <option value="${formData.estSalary}" selected>${$('#estSalary option:selected').text()}</option>
                </select>
                </div>

                <div class="form-group row">
                <label>Sector</label>
                <select class="form-control" readonly>
                    <option value="${formData.sector}" selected>${$('#sector option:selected').text()}</option>
                </select>
                </div>
                <div class="form-group row">
                    <label>Provinsi</label>
                     <select class="form-control" readonly>
                         <option value="${formData.provinsi}" selected>${$('#provinsi option:selected').text()}</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label>City</label>
                    <input type="text" class="form-control" value="${formData.lokasi}" readonly>
                </div>
                <div class="form-group row">
                    <label>Link Pendaftaran</label>
                    <input type="text" class="form-control" value="${formData.link_pendaftaran}" readonly>
                </div>
                <div class="form-group row">
                <label>Education</label>
                <select class="form-control" readonly>
                    <option value="${formData.education}" selected>${$('#education option:selected').text()}</option>
                </select>
                </div>

                <div class="form-group row">
                <label>Experience Level</label>
                <select class="form-control" readonly>
                    <option value="${formData.experienceLevel}" selected>${$('#experienceLevel option:selected').text()}</option>
                </select>
                </div>

                <div class="form-group row">
                <label>Certification</label>
                    <input type="text" class="form-control" value="${formData.certification}" readonly>
                </div>

                <div class="form-group row">
                <label>Job Descripsi</label>
                    <textarea   class="form-control" placeholder="Type something and press Enter..." name="name" readonly>${stripHtmlTags(formData.jobdescripsi)}</textarea>
                </div>

                <div class="form-group row">
                <label>Skill Requirement</label>
                    <textarea   class="form-control" placeholder="Type something and press Enter..." name="name" readonly>${stripHtmlTags(formData.skillRequirement)}</textarea>
                </div>

                <div class="form-group row">
                    <label>Tanggal Mulai</label>
                    <input type="text" class="form-control" value="${formData.jadwal_mulai_tanggal}" readonly>
                </div>

                <div class="form-group row">
                    <label>Tanggal Selesai</label>
                    <input type="text" class="form-control" value="${formData.jadwal_selesai_tanggal}" readonly>
                </div>
            `);

            var fileInput = document.querySelectorAll('.photo');
            if (fileInput.length > 0) {
                var imageUrls = [];
                var filesLoaded = 0;

                fileInput.forEach(function(input) {
                    var files = input.files;
                    if (files.length > 0) {
                        for (var i = 0; i < files.length; i++) {
                            (function(file) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    imageUrls.push(e.target.result);
                                    filesLoaded++;
                                    if (filesLoaded === fileInput.length) {
                                        var imagesHtml = imageUrls.map((url, index) => `
                                        <div class="form-group row" style=" text-align: left;">
                                            <label for="picture">Photo</label>
                                        </div>
                                        <div class="form-group row">
                                            <img src="${url}" alt="Preview Image ${index + 1}" class="img-thumbnail" width="250px">
                                        </div>
                                    `).join('');
                                        $('#modal-content').append(imagesHtml);
                                    }
                                };
                                reader.readAsDataURL(file);
                            })(files[i]);
                        }
                    }
                });
            }

            $('#previewModal').modal('show');


        });
        $('select[name="jadwal_mulai_tanggal"], select[name="jadwal_mulai_bulan"], select[name="jadwal_mulai_tahun"]').select2();
        $('select[name="jadwal_selesai_tanggal"], select[name="jadwal_selesai_bulan"], select[name="jadwal_selesai_tahun"]').select2();
        // $('select[name="category"], select[name="jenis_sertifikasi"]').select2();
        $('select[name="employmentStatus"]').select2();
        $('select[name="workLocation"]').select2();
        $('select[name="salaryDateMonth"]').select2();
        $('select[name="estSalary"]').select2();
        $('select[name="sector"]').select2();
        $('select[name="education"]').select2();
        $('select[name="experienceLevel"]').select2();
        $('select[name="provinsi"]').select2();
        // Populate days
        for (let i = 1; i <= 31; i++) {
            $('select[name="jadwal_mulai_tanggal"], select[name="jadwal_selesai_tanggal"]').append(`<option value="${i}">${i}</option>`);
        }

        // Populate months
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        months.forEach((month, index) => {
            $('select[name="jadwal_mulai_bulan"], select[name="jadwal_selesai_bulan"]').append(`<option value="${index + 1}">${month}</option>`);
        });

        // Populate years
        const currentYear = new Date().getFullYear();
        for (let i = currentYear; i <= currentYear + 10; i++) {
            $('select[name="jadwal_mulai_tahun"], select[name="jadwal_selesai_tahun"]').append(`<option value="${i}">${i}</option>`);
        }

        $('#pending-btn').click(function() {
            submitFormWithStatus(2);
        });

        $('#publish-btn').click(function() {
            submitFormWithStatus(1);
        });

        function submitFormWithStatus(status) {
            var formData = new FormData($('#training-form')[0]);
            formData.append('status', status);

            // var fileInput = $('#item_files')[0];
            // for (var i = 0; i < fileInput.files.length; i++) {
            //     formData.append('item_files[]', fileInput.files[i]);
            // }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            showLoading(); // Show loading indicator

            $.ajax({
                url: '/store-jobvacancy',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    hideLoading(); // Hide loading indicator
                    $('#successModal').modal('show');

                    setTimeout(function() {
                        $('#successModal').modal('hide');
                        location.reload();
                        window.location.href = '/postjobs';
                    }, 2000);

                    $('#previewModal').modal('hide');
                    $('#training-form')[0].reset();
                },
                error: function(xhr, status, error) {
                    hideLoading(); // Hide loading indicator
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan. Silakan coba lagi.';
                    $('#error-message').text('Terjadi kesalahan. Silakan coba lagi');
                    $('#errorModal').modal('show');

                    // setTimeout(function() {
                    //     $('#errorModal').modal('hide');
                    //     location.reload();
                    // }, 2000);
                }
            });
        }
    });




    $("#registration_schedule").datepicker({
        // format: "dd-mm-yyyy",
        startDate: new Date(),
    });
    $("#startdate").datepicker({
        // format: "dd-mm-yyyy",
        startDate: new Date(),
    });
    $("#enddate").datepicker({
        // format: "dd-mm-yyyy",
        startDate: new Date(),
    });
    // $(".desc").summernote({
    //     toolbar: [

    //         ['font', ['clear']], // Tombol font tidak ditampilkan
    //         ['color', ['color']], // Tombol warna tidak ditampilkan
    //         ['para', ['ul', 'ol', 'paragraph']],

    //     ],
    //     buttons: {
    //         // Menambahkan tombol custom recent color jika diperlukan
    //         recentColor: function() {
    //             return $.summernote.ui.button({
    //                 contents: '<i class="note-icon-note"></i> Recent Color',
    //                 tooltip: 'Recent Color',
    //                 click: function() {
    //                     // Fungsi untuk recent color
    //                 }
    //             }).render();
    //         }
    //     },
    //     // Menyembunyikan toolbar default
    //     disableDragAndDrop: true
    // });descJobdesc descReqdesc
    $(".descJobdesc").summernote({
        height: 250,
            toolbar: [
                ['font', [ 'fontsize', 'clear']], // Menampilkan opsi style font dan ukuran font
                //['font', ['fontname', 'fontsize', 'clear']],
                ['color', ['color']], // Tombol warna ditampilkan
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']], // Menambahkan tombol untuk menyisipkan gambar
            ],
            //fontNames: ['Arial', 'Courier New', 'Helvetica', 'Times New Roman'], // Daftar font yang tersedia
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48', '64'], // Daftar ukuran font
            buttons: {
                recentColor: function() {
                    return $.summernote.ui.button({
                        contents: '<i class="note-icon-note"></i> Recent Color',
                        tooltip: 'Recent Color',
                        click: function() {
                            // Fungsi untuk recent color
                        }
                    }).render();
                }
            },
            disableDragAndDrop: true
    });
    $(".descReqdesc").summernote({
        height: 250,
            toolbar: [
                ['font', [ 'fontsize', 'clear']], // Menampilkan opsi style font dan ukuran font
                //['font', ['fontname', 'fontsize', 'clear']],
                ['color', ['color']], // Tombol warna ditampilkan
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']], // Menambahkan tombol untuk menyisipkan gambar
            ],
            //fontNames: ['Arial', 'Courier New', 'Helvetica', 'Times New Roman'], // Daftar font yang tersedia
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48', '64'], // Daftar ukuran font
            buttons: {
                recentColor: function() {
                    return $.summernote.ui.button({
                        contents: '<i class="note-icon-note"></i> Recent Color',
                        tooltip: 'Recent Color',
                        click: function() {
                            // Fungsi untuk recent color
                        }
                    }).render();
                }
            },
            disableDragAndDrop: true
    });
    $('input[type="file"]').change(function(e) {
        console.log('Picture Changed');
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        const [file] = $(this)[0].files;
        if (file) {
            $(".simulasi-gambar-" + this.id).attr("src", URL.createObjectURL(file));
        }
        $(this).next(".custom-file-label").html(files.join(", "));
    });

    function deletePrompt(id) {
        var url = "{{ route('pages-list-detail-delete',':id') }}";
        url = url.replace(":id", id);

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        Swal.fire({
            title: "Delete data?",
            showCancelButton: true,
            confirmButtonText: "Delete",
            confirmButtonColor: "#d33",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: url,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data["status"] == "success") {
                            Toast.fire({
                                icon: "success",
                                title: data["message"],
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: data["message"],
                            });
                        }
                    },
                    error: function(reject) {
                        Toast.fire({
                            icon: "error",
                            title: "Something went wrong",
                        });
                    },
                });
            }
        });
    }

    function parsingDataToModal(id) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        var url = "{{ route('edit-traningcourse-detail',':id') }}";
        url = url.replace(":id", id);
        $.ajax({
            url: url,
            type: "GET",
            processData: false,
            contentType: false,
            success: function(data) {
                data = JSON.parse(data);
                if (data["status"] == "success") {
                    $("#edit-data-list-item").html(data["output"]);
                    $("#edit-item").modal("toggle");
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data["message"],
                    });
                }
            },
            error: function(reject) {
                Toast.fire({
                    icon: "error",
                    title: "Something went wrong",
                });
            },
        });
    }
</script>
@endsection
