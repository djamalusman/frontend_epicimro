@extends('layouts.app')
@section('title', 'Posting Training')


@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/') }}plugins/summernote/summernote-bs4.min.css">
<style>

   
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
  .new-input-group {
      margin-top: 10px; /* Adjust the margin as needed */
  }
  /* Efek zoom pada gambar thumbnail */
  .img-thumbnail {
      transition: transform 0.3s ease; /* Animasi zoom */
      cursor: pointer; /* Kursor pointer untuk menunjukkan gambar dapat diklik */
  }
  
  .img-thumbnail:hover {
      transform: scale(1.6); /* Memperbesar gambar saat di-hover, gunakan nilai yang lebih tinggi untuk zoom lebih besar */
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
                            <h4 class="mb-20 mt-25">Tambah Training</h4>
                            <form id="training-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Nama Training</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                        <input type="text" class="form-control" id="nama_training" name="nama_training">
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 mb-20">
                                        <label for="abouttraining" class="form-label"><strong>About Training</strong></label>
                                        <span class="dis-block text-muted text-md-lh24">
                                                <textarea class="form-control abouttraining" id="abouttraining" name="abouttraining"></textarea>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Youtube</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                                <input type="text" class="form-control" id="yotube" name="yotube">
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Category</strong>
                                            <select class="form-control dis-block text-muted text-md-lh24" style="height:44px;" id="category" name="category">
                                                <option value="">Pilih category</option>
                                                @foreach($liscategory as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Jenis Sertifikasi</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control dis-block text-muted text-md-lh24" style="height:44px;" id="jenis_sertifikasi" name="jenis_sertifikasi">
                                                <option value="">Pilih Jenis Sertifikasi</option>
                                                @foreach($listsertifikasi as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Durasi Training</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="number" class="form-control" id="training_duration" name="training_duration">
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 mb-20 mt-25">
                                        <span class="btn btn-tags-sm mb-10 mr-5" id="basic-addon2">Hari</span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Persyaratan</strong>
                                        <div id="persyaratan-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control persyaratan" name="persyaratan[]" placeholder="Masukkan persyaratan">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-add" onclick="addInput(this, 'persyaratan')">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Jadwal mulai training</strong>
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
                                                <option>Tahun</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Jadwal selesai training</strong>
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
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Materi Training</strong>
                                        <div id="materi-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control materi_training" name="materi_training[]" placeholder="Masukkan materi training">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-add" onclick="addInput(this, 'materi')">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Fasilitas</strong>
                                        <div id="fasilitas-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control fasilitas" name="fasilitas[]" placeholder="Masukkan fasilitas">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-add" onclick="addInput(this, 'fasilitas')">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-10">
                                        <strong class="text-md-bold">Biaya Pendaftaran</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="text" class="form-control" id="registrationfee" name="registrationfee">
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-10">
                                        <strong class="text-md-bold">Type</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                                <select class="form-control dis-block text-muted text-md-lh24" style="height:44px;" id="type" name="type">
                                                    <option value="">Pilih Type</option>
                                                        @foreach($listtype as $value)
                                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                                        @endforeach
                                                </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">About Trainer</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <textarea class="form-control abouttrainer" name="abouttrainer" id="abouttrainer" rows="4" cols="50"></textarea>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Provinsi</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <select class="form-control dis-block text-muted text-md-lh24" style="height:44px;" id="provinsi" name="provinsi">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach($listprovinsi as $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-10">
                                        <strong class="text-md-bold">Lokasi</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="text" class="form-control" id="lokasi" name="lokasi">
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">Photo</strong>
                                        <div id="photo-container">
                                            <div class="input-group mb-2">
                                                <input type="file" class="form-control photo" id="photo" name="photo[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-10">
                                        <strong class="text-md-bold">Link Pendaftaran</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <input type="text" class="form-control" id="link_pendaftaran" placeholder="Link Google Form / Ms Form" name="link_pendaftaran">
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-12 mb-20">
                                        <strong class="text-md-bold">About Career</strong>
                                        <span class="dis-block text-muted text-md-lh24">
                                            <textarea class="form-control aboutcareer" name="aboutcareer" id="aboutcareer" rows="4" cols="50"></textarea>
                                        </span>
                                    </div>
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
    <div class="modal fade custom-modal" id="previewModal" tabindex="-1" aria-labelledby="addPersonalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Priview</h5>
                    <button type="button" class="btn-close" style="color: white;!important" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-content">

                        <!-- Dynamically filled by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    

   <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <i class="fas fa-check-circle check-icon"></i>
            <h4 class="mt-4">Oh Yeah!</h4>
            <p>Data berhasil disimpan</p>
            </div>
        </div>
        </div>
    </div>
    <!-- Failed Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fas fa-exclamation-circle error-icon"></i>
                <br>
                <p id="error-message"></p>
            </div>

        </div>
        </div>
    </div>
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="spinner-border medium custom-color" role="status">
            <span class="sr-only">Loading...</span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('/') }}plugins/summernote/summernote-bs4.min.js"></script>


<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // Tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }

    $(document).ready(function () {
        // Inisialisasi Summernote
        $('#abouttraining, #abouttrainer, #aboutcareer').summernote({
            height: 100,
            toolbar: [
                ['font', ['fontsize', 'clear']], 
                ['color', ['color']], 
                ['para', ['ul', 'ol', 'paragraph']], 
                ['insert', ['picture']], 
            ],
            disableDragAndDrop: true
        });

        // Fungsi untuk menambah input baru
        window.addInput = function (button) {
            var inputGroup = $(button).closest('.input-group');
            var newInputGroup = inputGroup.clone();
            newInputGroup.find('input').val('');
            newInputGroup.find('.btn-add').remove(); 
            newInputGroup.append('<button type="button" class="btn btn-danger btn-remove" onclick="removeInput(this)">-</button>');
            inputGroup.after(newInputGroup);
        }

        // Fungsi untuk menghapus input yang ditambahkan
        window.removeInput = function (button) {
            $(button).closest('.input-group').remove();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var registrationFeeInput = document.getElementById('registrationfee');

        registrationFeeInput.addEventListener('keyup', function(e) {
            // Gunakan fungsi formatRupiah untuk memformat inputan
            registrationFeeInput.value = formatRupiah(this.value, 'Rp');
        });
    });
    function addInput(button) {
        var inputGroup = $(button).closest('.input-group');
        var newInputGroup = inputGroup.clone();
        newInputGroup.find('input').val('');
        newInputGroup.find('.btn-add').remove();
        newInputGroup.append('<button type="button" class="btn btn-danger btn-remove" onclick="removeInput(this)">-</button>');
        newInputGroup.addClass('new-input-group'); // Add class for spacing
        inputGroup.after(newInputGroup);
    }

    function removeInput(button) {
        $(button).closest('.input-group').remove();
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';

        var parts = dateStr.split(' ')[0].split('-');
        var date = new Date(parts[0], parts[1] - 1, parts[2]);

        var day = date.getDate();
        var month = date.toLocaleString('default', { month: 'long' });
        var year = date.getFullYear();

        return day + ' ' + month + ' ' + year;
    }

    $('#preview-btn').click(function() {
        var categoryText = $('#category option:selected').text();
        var jenis_sertifikasiText = $('#jenis_sertifikasi option:selected').text();
        var typeText = $('#type option:selected').text();
        var provinsiText = $('#provinsi option:selected').text();


        var formData = {
            
            title: $('#nama_training').val(),
            yotube: $('#yotube').val(),
            category: categoryText,
            jenis_sertifikasi: jenis_sertifikasiText,
            training_duration: $('#training_duration').val(),
            persyaratan: [],
            materi_training: [],
            fasilitas: [],
            jadwal_mulai_tanggal: formatDate(`${$('#jadwal_mulai_tahun').val()}-${$('#jadwal_mulai_bulan').val()}-${$('#jadwal_mulai_tanggal').val()}`),
            jadwal_selesai_tanggal: formatDate(`${$('#jadwal_selesai_tahun').val()}-${$('#jadwal_selesai_bulan').val()}-${$('#jadwal_selesai_tanggal').val()}`),
            type: typeText,
            provinsi: provinsiText,
            aboutraining: $('#abouttraining').val(),
            abouttrainer: $('#abouttrainer').val(),
            aboutcareer: $('#aboutcareer').val(),

            lokasi: $('#lokasi').val(),
            link_pendaftaran: $('#link_pendaftaran').val(),
            status: 3
        };

        // Collect all dynamic inputs
        $('.persyaratan').each(function() {
            formData.persyaratan.push($(this).val());
        });
        $('.materi_training').each(function() {
            formData.materi_training.push($(this).val());
        });
        $('.fasilitas').each(function() {
            formData.fasilitas.push($(this).val());
        });

        $('#modal-content').html(`
            
            <div class="mb-3">
                <label>Nama Training</label>
                <input type="text" class="form-control" value="${formData.title}" readonly>
            </div>
            <div class="mb-3">
                <label>Yotube</label>
                <input type="text" class="form-control" value="${formData.yotube}" readonly>
            </div>
             <div class="mb-3">
                <label>Category</label>
                <input type="text" class="form-control" value="${formData.category}" readonly>
            </div>
            <div class="mb-3">
                <label>Jenis Sertifikasi</label>
                <input type="text" class="form-control" value="${formData.jenis_sertifikasi}" readonly>
            </div>
            <div class="mb-3">
                <label>Durasi Training</label>
                <input type="text" class="form-control" value="${formData.training_duration}" readonly>
            </div>
            <div class="mb-3">
                <label>Persyaratan</label>
                ${formData.persyaratan.map(p => `<input type="text" class="form-control" value="${p}" readonly>`).join('')}
            </div>

            <div class="mb-3">
                <label>Tanggal Mulai Training</label>
                <input type="text" class="form-control" value="${formData.jadwal_mulai_tanggal}" readonly>
            </div>


            <div class="mb-3">
                <label>Tanggal Selesai Training</label>
                <input type="text" class="form-control" value="${formData.jadwal_selesai_tanggal}" readonly>
            </div>

            <div class="mb-3">
                <label>Materi Training</label>
                ${formData.materi_training.map(m => `<input type="text" class="form-control" value="${m}" readonly>`).join('')}
            </div>
            <div class="mb-3">
                <label>Fasilitas</label>
                ${formData.fasilitas.map(f => `<input type="text" class="form-control" value="${f}" readonly>`).join('')}
            </div>

            <div class="mb-3">
                <label>Type</label>
                <input type="text" class="form-control" value="${formData.type}" readonly>
            </div>

            <div class="mb-3">
                <label>Provinsi</label>
                <input type="text" class="form-control" value="${formData.provinsi}" readonly>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" class="form-control" value="${formData.lokasi}" readonly>
            </div>

            <div class="mb-3">
                <label>Link Pendaftaran</label>
                <input type="text" class="form-control" value="${formData.link_pendaftaran}" readonly>
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
                                        <div class="mb-3" style=" text-align: left;">
                                            <label for="picture">Photo ${index + 1}</label>
                                        </div>
                                        <div class="mb-3">
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

    function showLoading() {
        $('#loadingOverlay').show();
    }

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
    $(document).ready(function() {
        // Initialize Select2
        $('select[name="jadwal_mulai_tanggal"], select[name="jadwal_mulai_bulan"], select[name="jadwal_mulai_tahun"]').select2();
        $('select[name="jadwal_selesai_tanggal"], select[name="jadwal_selesai_bulan"], select[name="jadwal_selesai_tahun"]').select2();
        $('select[name="category"], select[name="jenis_sertifikasi"]').select2();
        $('select[name="lokasi"]').select2();
        $('select[name="provinsi"]').select2();
        $('select[name="type"]').select2();

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

            var fileInput = $('#photo')[0];
            for (var i = 0; i < fileInput.files.length; i++) {
                formData.append('photo[]', fileInput.files[i]);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            showLoading(); // Show loading indicator

            $.ajax({
                url: '/store-course-endpoint',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    hideLoading(); // Hide loading indicator
                    $('#successModal').modal('show');

                    setTimeout(function() {
                        $('#successModal').modal('hide');
                        window.location.href = '/posttraining';
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
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#jadwal_mulai_tanggal, #jadwal_mulai_bulan, #jadwal_mulai_tahun').select2();
        $('#jadwal_selesai_tanggal, #jadwal_selesai_bulan, #jadwal_selesai_tahun').select2();

        // Fungsi untuk mengisi tanggal (1-31)
        function populateDays(selectElement) {
            selectElement.empty();
            selectElement.append('<option value="">Pilih Tanggal</option>');
            for (let i = 1; i <= 31; i++) {
                selectElement.append(`<option value="${i}">${i}</option>`);
            }
        }

        // Fungsi untuk mengisi bulan
        function populateMonths(selectElement) {
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            selectElement.empty();
            selectElement.append('<option value="">Pilih Bulan</option>');
            months.forEach((month, index) => {
                selectElement.append(`<option value="${index + 1}">${month}</option>`);
            });
        }

        // Fungsi untuk mengisi tahun (tahun sekarang sampai 10 tahun ke depan)
        function populateYears(selectElement) {
            const currentYear = new Date().getFullYear();
            selectElement.empty();
            selectElement.append('<option value="">Pilih Tahun</option>');
            for (let i = currentYear; i <= currentYear + 10; i++) {
                selectElement.append(`<option value="${i}">${i}</option>`);
            }
        }

        // Mengisi data untuk jadwal mulai
        populateDays($('#jadwal_mulai_tanggal'));
        populateMonths($('#jadwal_mulai_bulan'));
        populateYears($('#jadwal_mulai_tahun'));

        // Mengisi data untuk jadwal selesai
        populateDays($('#jadwal_selesai_tanggal'));
        populateMonths($('#jadwal_selesai_bulan'));
        populateYears($('#jadwal_selesai_tahun'));

        // Event handler untuk update jumlah hari berdasarkan bulan yang dipilih
        $('#jadwal_mulai_bulan, #jadwal_mulai_tahun').change(function() {
            updateDays('jadwal_mulai');
        });

        $('#jadwal_selesai_bulan, #jadwal_selesai_tahun').change(function() {
            updateDays('jadwal_selesai');
        });

        // Fungsi untuk update jumlah hari berdasarkan bulan dan tahun
        function updateDays(prefix) {
            const month = parseInt($(`#${prefix}_bulan`).val());
            const year = parseInt($(`#${prefix}_tahun`).val());
            
            if (month && year) {
                const daysInMonth = new Date(year, month, 0).getDate();
                const daySelect = $(`#${prefix}_tanggal`);
                const selectedDay = parseInt(daySelect.val());
                
                daySelect.empty();
                daySelect.append('<option value="">Pilih Tanggal</option>');
                
                for (let i = 1; i <= daysInMonth; i++) {
                    daySelect.append(`<option value="${i}" ${selectedDay === i ? 'selected' : ''}>${i}</option>`);
                }
            }
        }
    });
</script>

@endsection
