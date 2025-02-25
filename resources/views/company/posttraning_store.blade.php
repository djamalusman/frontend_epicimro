@extends('layouts.app')
@section('title', 'Posting Training')

@push('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<br>
<br>
<br>
<br>
<br>
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
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Figma</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Adobe XD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">App</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Digital</a>
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
                                                <select class="form-control dis-block text-muted text-md-lh24" style="height:44px;" id="jenis_sertifikasi" name="jenis_sertifikasi">
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
                                            <select class="form-control dis-block text-muted text-md-lh24" style="height:44px;" id="jenis_sertifikasi" name="jenis_sertifikasi">
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
                                                <input type="file" class="form-control photo" name="photo[]">
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
                <br>
                <div class="single-recent-jobs">
                    <h4 class="heading-border"><span>News</span></h4>
                    <div class="list-recent-jobs">
                        <div class="card-job hover-up wow animate__animated animate__fadeInUp">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/digital.png" /></figure>
                                </div>
                                <div class="card-job-top--info">
                                    <h6 class="card-job-top--info-heading"><a href="job-single.html">Digital Experience Designer</a></h6>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <span class="card-job-top--company">AliStudio, Inc</span>
                                            <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i>
                                                New York, NY</span>
                                            <span class="card-job-top" </span>
                                        </div>
                                        <div class="col-lg-5">
                                            <span class="card-job-top--price">$500<span>/Hour</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-job-description mt-20">
                                We want someone who has been doing this for a solid 2-3 years. We want someone
                                who can
                                demonstrate an extremely strong portfolio. Create deliverables for your product
                                area
                                (for example competitive analyses, user flows.
                            </div>
                            <div class="card-job-bottom mt-25">
                                <div class="row">
                                    <div class="col-lg-9 col-sm-8 col-12">
                                        <a href="job-grid.html" class="btn btn-small background-urgent btn-pink mr-5">Urgent</a>
                                        <a href="job-grid-2.html" class="btn btn-small background-blue-light mr-5">Senior</a>
                                        <a href="job-grid.html" class="btn btn-small background-6 disc-btn">Full time</a>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12 text-end"><div class="mb-20">
                                    </div>
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub" /></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub" /></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-job hover-up wow animate__animated animate__fadeInUp">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/n-digital.png" /></figure>
                                </div>
                                <div class="card-job-top--info">
                                    <h6 class="card-job-top--info-heading"><a href="job-single.html">Digital Experience Designer</a></h6>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <span class="card-job-top--company">AliStudio, Inc</span>
                                            <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i>
                                                New York, NY</span>
                                            <span class="card-job-top--type-job text-sm"><i class="fi-rr-briefcase"></i>
                                                Full time</span>
                                            <span class="card-job-top--post-time text-sm"><i class="fi-rr-clock"></i> 3
                                                mins ago</span>
                                        </div>
                                        <div class="col-lg-5  text-lg-end">
                                            <span class="card-job-top--price">$500<span>/Hour</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-job-description mt-20">
                                We want someone who has been doing this for a solid 2-3 years. We want someone
                                who can
                                demonstrate an extremely strong portfolio. Create deliverables for your product
                                area
                                (for example competitive analyses, user flows.
                            </div>
                            <div class="card-job-bottom mt-25">
                                <div class="row">
                                    <div class="col-lg-9 col-sm-8 col-12">
                                        <a href="job-grid.html" class="btn btn-small background-urgent btn-pink mr-5">Urgent</a>
                                        <a href="job-grid-2.html" class="btn btn-small background-blue-light mr-5">Senior</a>
                                        <a href="job-grid.html" class="btn btn-small background-6 disc-btn">Full time</a>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12 text-end">
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub" /></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub" /></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-job hover-up wow animate__animated animate__fadeInUp">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/n-digital2.png" /></figure>
                                </div>
                                <div class="card-job-top--info">
                                    <h6 class="card-job-top--info-heading"><a href="job-single.html">Digital Experience Designer</a></h6>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <span class="card-job-top--company">AliStudio, Inc</span>
                                            <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i>
                                                New York, NY</span>
                                            <span class="card-job-top--type-job text-sm"><i class="fi-rr-briefcase"></i>
                                                Full time</span>
                                            <span class="card-job-top--post-time text-sm"><i class="fi-rr-clock"></i> 3
                                                mins ago</span>
                                        </div>
                                        <div class="col-lg-5 text-lg-end">
                                            <span class="card-job-top--price">$500<span>/Hour</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-job-description mt-20">
                                We want someone who has been doing this for a solid 2-3 years. We want someone
                                who can
                                demonstrate an extremely strong portfolio. Create deliverables for your product
                                area
                                (for example competitive analyses, user flows.
                            </div>
                            <div class="card-job-bottom mt-25">
                                <div class="row">
                                    <div class="col-lg-9 col-sm-8 col-12">
                                        <a href="job-grid.html" class="btn btn-small background-urgent btn-pink mr-5">Urgent</a>
                                        <a href="job-grid-2.html" class="btn btn-small background-blue-light mr-5">Senior</a>
                                        <a href="job-grid.html" class="btn btn-small background-6 disc-btn">Full time</a>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12 text-end">
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub" /></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub" /></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-job hover-up wow animate__animated animate__fadeInUp">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/digital.png" /></figure>
                                </div>
                                <div class="card-job-top--info">
                                    <h6 class="card-job-top--info-heading"><a href="job-single.html">Digital Experience Designer</a></h6>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <span class="card-job-top--company">AliStudio, Inc</span>
                                            <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i>
                                                New York, NY</span>
                                            <span class="card-job-top--type-job text-sm"><i class="fi-rr-briefcase"></i>
                                                Full time</span>
                                            <span class="card-job-top--post-time text-sm"><i class="fi-rr-clock"></i> 3
                                                mins ago</span>
                                        </div>
                                        <div class="col-lg-5 text-lg-end">
                                            <span class="card-job-top--price">$500<span>/Hour</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-job-description mt-20">
                                We want someone who has been doing this for a solid 2-3 years. We want someone
                                who can
                                demonstrate an extremely strong portfolio. Create deliverables for your product
                                area
                                (for example competitive analyses, user flows.
                            </div>
                            <div class="card-job-bottom mt-25">
                                <div class="row">
                                    <div class="col-lg-9 col-sm-8 col-12">
                                        <a href="job-grid.html" class="btn btn-small background-urgent btn-pink mr-5">Urgent</a>
                                        <a href="job-grid-2.html" class="btn btn-small background-blue-light mr-5">Senior</a>
                                        <a href="job-grid.html" class="btn btn-small background-6 disc-btn">Full time</a>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12 text-end">
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub" /></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub" /></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            
        </div>
    </div>assets
</section>

@push('scripts')
<!-- Core JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- Other plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
jQuery(function($) {
    console.log('jQuery version:', $.fn.jquery);
    console.log('Summernote loaded:', typeof $.fn.summernote !== 'undefined');
    
    try {
        $('#abouttraining').summernote({
            height: 100,
            toolbar: [
                ['font', ['fontsize', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36']
        });
        
        $('#abouttrainer').summernote({
            height: 100,
            toolbar: [
                ['font', ['fontsize', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36']
        });
        
        $('#aboutcareer').summernote({
            height: 100,
            toolbar: [
                ['font', ['fontsize', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36']
        });
        
        console.log('Summernote initialized successfully');
    } catch (error) {
        console.error('Error initializing Summernote:', error);
    }
});
</script>


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

    $(document).ready(function(){
        // Manually initialize Bootstrap tooltip
        $('[data-toggle="tooltip"]').tooltip();
        
        // Initialize Summernote with basic configuration
        if ($.fn.summernote) {
            $('#abouttraining').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol']]
                ]
            });
            
            $('#abouttrainer').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol']]
                ]
            });
            
            $('#aboutcareer').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol']]
                ]
            });
        } else {
            console.error('Summernote is not loaded properly');
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
            companyname: $('#company_name').val(),
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
            <div class="form-group row">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control" value="${formData.companyname}" readonly>
            </div>
            <div class="form-group row">
                <label>Nama Training</label>
                <input type="text" class="form-control" value="${formData.title}" readonly>
            </div>
            <div class="form-group row">
                <label>Yotube</label>
                <input type="text" class="form-control" value="${formData.yotube}" readonly>
            </div>
             <div class="form-group row">
                <label>Category</label>
                <input type="text" class="form-control" value="${formData.category}" readonly>
            </div>
            <div class="form-group row">
                <label>Jenis Sertifikasi</label>
                <input type="text" class="form-control" value="${formData.jenis_sertifikasi}" readonly>
            </div>
            <div class="form-group row">
                <label>Durasi Training</label>
                <input type="text" class="form-control" value="${formData.training_duration}" readonly>
            </div>
            <div class="form-group row">
                <label>Persyaratan</label>
                ${formData.persyaratan.map(p => `<input type="text" class="form-control" value="${p}" readonly>`).join('')}
            </div>

            <div class="form-group row">
                <label>Tanggal Mulai Training</label>
                <input type="text" class="form-control" value="${formData.jadwal_mulai_tanggal}" readonly>
            </div>


            <div class="form-group row">
                <label>Tanggal Selesai Training</label>
                <input type="text" class="form-control" value="${formData.jadwal_selesai_tanggal}" readonly>
            </div>

            <div class="form-group row">
                <label>Materi Training</label>
                ${formData.materi_training.map(m => `<input type="text" class="form-control" value="${m}" readonly>`).join('')}
            </div>
            <div class="form-group row">
                <label>Fasilitas</label>
                ${formData.fasilitas.map(f => `<input type="text" class="form-control" value="${f}" readonly>`).join('')}
            </div>

            <div class="form-group row">
                <label>Type</label>
                <input type="text" class="form-control" value="${formData.type}" readonly>
            </div>

            <div class="form-group row">
                <label>Provinsi</label>
                <input type="text" class="form-control" value="${formData.provinsi}" readonly>
            </div>

            <div class="form-group row">
                <label>Lokasi</label>
                <input type="text" class="form-control" value="${formData.lokasi}" readonly>
            </div>

            <div class="form-group row">
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
                                        <div class="form-group row" style=" text-align: left;">
                                            <label for="picture">Photo ${index + 1}</label>
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
                url: '/public/store-course-endpoint',
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

@push('scripts')
@endpush
