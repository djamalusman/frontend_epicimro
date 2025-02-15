@extends('layouts.app')

@section('title', 'Profile Candidate')

@section('content')
<style>
    .truncate {
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Batasi 3 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .btn-more {
        background-color: #f05537;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        margin-top: 5px;
        border-radius: 5px;
    }
</style>
<section class="section-box">
    <div class="box-head-single box-head-single-candidate">
        <div class="container">
            <div class="heading-image-rd online">
                <a href="#">
                    <figure><img alt="jobhub" src="assets/imgs/page/candidates/img-candidate.png"></figure>
                </a>
            </div>
            <div class="heading-main-info">
                <h4>{{ session('name') }}</h4>
                <div class="head-info-profile">
                    <span class="text-small mr-20"><i class="fi-rr-marker text-mutted"></i> Chicago, US</span>
                    <span class="text-small mr-20"><i class="fi-rr-briefcase text-mutted"></i> Ui/UX design</span>
                    <span class="text-small"><i class="fi-rr-clock text-mutted"></i> $45 / hour</span>
                    <div class="rate-reviews-small">
                        <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                        <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                        <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                        <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                        <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                        <span class="ml-10 text-muted text-small">(5.0)</span>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-lg-5">
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Figma</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Adobe XD</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">App</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Digital</a>
                    </div>
                    <div class="col-lg-3">
                        <a href="#" class="btn btn-default">ubah</a>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-box mt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="content-single">
                    <h4 class="mb-20">Ringkasan pribadi</h4>
                    <p>
                        Hi, I am <strong>Danica Lewis,</strong> a professional Ui/Ux and Graphic designer with 4+ years of experience. I can design website ui, app ui, dashboard ui, thank you card, logo, flyer, brochure, banner, etc. If you need any help just give me a knock. Looking forward to working with you!
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet. Deleniti asperiores, commodi quae ipsum quas est itaque, ipsa, dolore beatae voluptates nemo blanditiis iste eius officia minus. Id nisi, consequuntur sunt impedit quidem, vitae mollitia!
                    </p>
                    <div class="divider"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-4">
                                <h4 class="mb-20 mt-25">Karier</h4>
                            </div>
                            <div class="col-lg-4">
                            <button type="button" class="btn btn-default  mb-20 mt-25" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                            </div>
                        </div>
                        <div class="row">
                            
                            @if($experiences->isEmpty())
                                <div class="alert alert-info">
                                    Belum ada pengalaman kerja yang ditambahkan.
                                </div>
                            @else
                            @foreach($experiences as $experience)
                                <div class="col-lg-6 col-md-6" id="experienceList">
                                        <div class="card-grid-2 hover-up wow animate__ animate__fadeIn animated" data-wow-delay=".s" style="visibility: visible; animation-name: fadeIn;" data-id="{{ $experience->id }}">
                                            <div class="mt-15" style="display: flex; justify-content: flex-end; gap: 10px;">
                                                <button class="btn-default edit-experience" 
                                                        data-id="{{ $experience->id }}"
                                                        data-position="{{ $experience->position }}"
                                                        data-company="{{ $experience->company }}"
                                                        data-start-date="{{ $experience->start_date ? $experience->start_date->format('Y-m-d') : '' }}"
                                                        data-end-date="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}"
                                                        data-is-current="{{ $experience->is_current ? '1' : '0' }}"
                                                        data-description="{{ $experience->description }}" 
                                                        style="border: 0px; background-color:white;">
                                                    <i class="fas fa-edit"></i>
                                                </button> 
                                                <button type="button" class="btn-default delete-experience" 
                                                        data-id="{{ $experience->id }}" 
                                                        style="border: 0px; background-color:white;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="card-block-info" >
                                            
                                                <div class="mt-10" style="color:black;font-family: 'Open Sans' ;font-weight:520;font-size: 26px;">
                                                    {{ $experience->position }}
                                                </div>
                                                <div class="mt-10">
                                                    <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                        {{ $experience->company }} </h6>
                                                </div>
                                                <div class="mt-10">
                                                    <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                        {{ $experience->start_date ? $experience->start_date->format('M Y') : '-' }} - 
                                                        {{ $experience->is_current ? 'Saat ini' : ($experience->end_date ? $experience->end_date->format('M Y') : '-') }}
                                                        @if($experience->start_date)
                                                            @php
                                                                $endDate = $experience->is_current ? now() : ($experience->end_date ?? now());
                                                                $diff = $experience->start_date->diff($endDate);
                                                                $years = $diff->y;
                                                                $months = $diff->m;
                                                                $duration = [];
                                                                if($years > 0) $duration[] = $years . ' tahun';
                                                                if($months > 0) $duration[] = $months . ' bulan';
                                                            @endphp
                                                            ({{ implode(' ', $duration) }})
                                                        @endif
                                                    </h6>
                                                </div>
                                                <div class="single-body">
                                                    <div class="single-content">
                                                        <p id="description-{{ $experience->id }}" class="truncate">{{ $experience->description }}</p>
                                                        <button id="toggleButton-{{ $experience->id }}" class="btn-more" style="display: none;">More</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                            @endif
                        </div>

                        {{-- <h4 class="mb-20 mt-25">Riwayat Pendidikan</h4> --}}

                        <div class="row align-items-end">
                            <div class="col-lg-4">
                                <h4 class="mb-20 mt-25">Pendidikan</h4>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-default  mb-20 mt-25" data-bs-toggle="modal" data-bs-target="#educationModal">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($educations as $education)
                                <div class="col-lg-6 col-md-6" id="educationList">
                                        <div class="card-grid-2 hover-up wow animate__ animate__fadeIn animated" data-wow-delay=".s" style="visibility: visible; animation-name: fadeIn;" data-id="{{ $education->id }}">
                                            <div class="mt-15" style="display: flex; justify-content: flex-end; gap: 10px;">
                                                <button class=" btn-default" onclick="editEducation({{ $education->id }})" style="border: 0px; background-color:white;">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-defaultt" style="border: 0px; background-color:white;" onclick="deleteEducation({{ $education->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        <div class="card-block-info">
                                           
                                            <div class="mt-10" style="color:black;font-family: 'Open Sans' ;font-weight:520;font-size: 26px;">
                                                {{ $education->school_name }}
                                            </div>
                                            <div class="mt-10">
                                                <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                    {{ $education->degree }} - {{ $education->field_of_study }} </h6>
                                            </div>
                                            <div class="mt-10">
                                                <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                    {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - 
                                                    {{ $education->is_current ? 'Sekarang' : \Carbon\Carbon::parse($education->end_date)->format('M Y') }} </h6>
                                            </div>
                                            <div class="single-body">
                                                <div class="single-content">
                                                    <p id="descriptioneducation-{{ $education->id }}" class="truncate">{{ $education->description }}</p>
                                                    <button id="toggleButtoneducation-{{ $education->id }}" class="btn-more" style="display: none;">More</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="divider"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-4">
                                <h4 class="mb-20 mt-25">Sertifikat</h4>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-default  mb-20 mt-25" data-bs-toggle="modal" data-bs-target="#certificationModal">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($certifications as $certification)
                                <div class="col-lg-6 col-md-6" id="certificationList">
                                        <div class="card-grid-2 hover-up wow animate__ animate__fadeIn animated" data-wow-delay=".s" style="visibility: visible; animation-name: fadeIn;" data-id="{{ $certification->id }}">
                                            <div class="mt-15" style="display: flex; justify-content: flex-end; gap: 10px;">
                                                <button class=" btn-default" onclick="editCertification({{ $certification->id }})" style="border: 0px; background-color:white;">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-defaultt" style="border: 0px; background-color:white;" onclick="deleteCertification({{ $certification->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        <div class="card-block-info">
                                           
                                            <div class="mt-10" style="color:black;font-family: 'Open Sans' ;font-weight:520;font-size: 26px;">
                                                {{ $certification->name }}
                                            </div>
                                            <div class="mt-10">
                                                <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                    {{ $certification->issuing_organization }} -  Diterbitkan: {{ \Carbon\Carbon::parse($certification->issue_date)->format('M Y') }}
                                                    @if($certification->has_expiration && $certification->expiration_date)
                                                    <br>Kadaluarsa: {{ \Carbon\Carbon::parse($certification->expiration_date)->format('M Y') }}
                                                    @endif </h6>
                                            </div>
                                            <div class="mt-10">
                                                <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                   ID Kredensial: {{ $certification->credential_id }} </h6>
                                            </div>
                                            <div class="single-body">
                                                <div class="single-content">
                                                    <p id="descriptioncertification-{{ $certification->id }}" class="truncate">{{ $certification->description }}</p>
                                                    <button id="toggleButton-{{ $certification->id }}" class="btn-more" style="display: none;">More</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                <div class="sidebar-shadow">
                    <h5 class="font-bold">Overview</h5>
                    <div class="sidebar-list-job mt-10">
                        <ul>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Experience</span>
                                    <strong class="small-heading">4 years</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">From</span>
                                    <strong class="small-heading">Dallas, Texas<br />Remote Friendly</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-dollar"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Salary</span>
                                    <strong class="small-heading">$35k - $45k</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Member since</span>
                                    <strong class="small-heading">Jul 2012</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Last Delivery</span>
                                    <strong class="small-heading">4 days</strong>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar-list-job mt-10">
                        <a href="#" class="btn btn-default mr-10">Contact Me</a>
                        <a href="#" class="btn btn-border">Get a Quote</a>
                    </div>

                    <div class="sidebar-team-member none-bd pt-10">
                        <h6 class="small-heading">Follower</h6>
                        <div class="sidebar-list-member sidebar-list-follower">
                            <ul>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar1.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="online">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar2.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar3.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar4.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar5.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar6.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar7.png" /></figure>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <figure><img alt="jobhub" src="assets/imgs/page/job-single/avatar8.png" /></figure>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sidebar-shadow">
                    <h5 class="sidebar-title">Overview</h5>
                    <div class="block-tags">
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Figma</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Adobe XD</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">HTML 5</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Css 3</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Javascript</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Jquery</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">NodeJS</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">MongoDb</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">SEO expert</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Gimp</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Photo editing</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">Sketch</a>
                        <a href="#" class="btn btn-tags-sm mb-10 mr-5">jam</a>
                    </div>
                </div>
                <div class="sidebar-normal">
                    <div>
                        <h6 class="small-heading">Are you also hiring?</h6>
                        <ul class="ul-lists">
                            <li><a href="#">Writing & Translation</a></li>
                            <li><a href="#">Video & Animation</a></li>
                            <li><a href="#">Music & Audio</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Programming & Tech</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Tambah Pengalaman -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceModalLabel">Tambah Pengalaman Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="experienceForm">
                    @csrf
                    <input type="hidden" name="experience_id" id="experience_id">
                    
                        
                            <div class="mb-3">
                                <label>Posisi</label>
                                <input type="text" name="position" class="form-control" required>
                            </div>
                       
                            <div class="mb-3">
                                <label>Perusahaan</label>
                                <input type="text" name="company" class="form-control" required>
                            </div>
                    
                       
                            <div class="mb-3">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control end-date">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input current-job" id="currentJob">
                                    <label class="form-check-label" for="currentJob">Masih Bekerja</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi Pekerjaan</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveExperience">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educationModalLabel">Tambah Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="educationForm">
                    <input type="hidden" id="educationId">
                    <div class="mb-3">
                        <label for="school_name" class="form-label">Nama Sekolah/Universitas</label>
                        <input type="text" class="form-control" id="school_name" name="school_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="degree" class="form-label">Gelar</label>
                        <input type="text" class="form-control" id="degree" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="field_of_study" class="form-label">Bidang Studi</label>
                        <input type="text" class="form-control" id="field_of_study" name="field_of_study" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_current" name="is_current">
                            <label class="form-check-label" for="is_current">
                                Masih Bersekolah
                            </label>
                        </div>
                    </div>
                    <div class="mb-3" id="end_date_group">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveEducation">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="certificationModal" tabindex="-1" aria-labelledby="certificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificationModalLabel">Tambah Sertifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="certificationForm">
                    <input type="hidden" id="certificationId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Sertifikasi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="issuing_organization" class="form-label">Organisasi Penerbit</label>
                        <input type="text" class="form-control" id="issuing_organization" name="issuing_organization" required>
                    </div>
                    <div class="mb-3">
                        <label for="credential_id" class="form-label">ID Kredensial (Opsional)</label>
                        <input type="text" class="form-control" id="credential_id" name="credential_id">
                    </div>
                    <div class="mb-3">
                        <label for="issue_date" class="form-label">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="has_expiration" name="has_expiration">
                            <label class="form-check-label" for="has_expiration">
                                Memiliki Tanggal Kadaluarsa
                            </label>
                        </div>
                    </div>
                    <div class="mb-3" id="expiration_date_group">
                        <label for="expiration_date" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="descriptioncertifications" name="descriptioncertifications" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveCertification">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("[id^='description-']").forEach(function (desc) {
            const id = desc.id.split('-')[1];
            const button = document.getElementById(`toggleButton-${id}`);
            
            if (desc.scrollHeight > desc.clientHeight) {
                button.style.display = "block";
            }
            
            button.addEventListener("click", function () {
                if (desc.classList.contains("truncate")) {
                    desc.classList.remove("truncate");
                    button.textContent = "Less";
                } else {
                    desc.classList.add("truncate");
                    button.textContent = "More";
                }
            });
        });

        

        document.querySelectorAll("[id^='descriptioneducation-']").forEach(function (desc) {
            const id = desc.id.split('-')[1];
            const button = document.getElementById(`toggleButtoneducation-${id}`);
            
            if (desc.scrollHeight > desc.clientHeight) {
                button.style.display = "block";
            }
            
            button.addEventListener("click", function () {
                if (desc.classList.contains("truncate")) {
                    desc.classList.remove("truncate");
                    button.textContent = "Less";
                } else {
                    desc.classList.add("truncate");
                    button.textContent = "More";
                }
            });
        });
    });
$(document).ready(function() {
    // Handle "Masih Bekerja" checkbox
    $('.current-job').change(function() {
        var endDateInput = $('.end-date');
        if (this.checked) {
            endDateInput.val('').prop('disabled', true);
        } else {
            endDateInput.prop('disabled', false);
        }
    });

    $('#is_current').change(function() {
            if (this.checked) {
                $('#end_date_group').hide();
                $('#end_date').val('');
            } else {
                $('#end_date_group').show();
            }
        });
        
        $('#has_expiration').change(function() {
            if (this.checked) {
                $('#expiration_date_group').show();
            } else {
                $('#expiration_date_group').hide();
                $('#expiration_date').val('');
            }
        });
    // Handle edit button click
    $(document).on('click', '.edit-experience', function() {
        var btn = $(this);
        var modal = $('#addExperienceModal');
        
        // Set form values
        modal.find('#experience_id').val(btn.data('id'));
        modal.find('input[name="position"]').val(btn.data('position'));
        modal.find('input[name="company"]').val(btn.data('company'));
        modal.find('input[name="start_date"]').val(btn.data('start-date'));
        
        // Handle current job and end date
        var isCurrent = btn.data('is-current') == '1';
        modal.find('.current-job').prop('checked', isCurrent);
        
        var endDateInput = modal.find('input[name="end_date"]');
        if (isCurrent) {
            endDateInput.val('').prop('disabled', true);
        } else {
            endDateInput.val(btn.data('end-date')).prop('disabled', false);
        }
        
        modal.find('textarea[name="description"]').val(btn.data('description'));
        
        // Update modal title
        modal.find('.modal-title').text('Edit Pengalaman Kerja');
        
        // Show modal
        modal.modal('show');
    });

    // Reset modal on close
    $('#addExperienceModal').on('hidden.bs.modal', function() {
        var modal = $(this);
        modal.find('#experience_id').val('');
        modal.find('form')[0].reset();
        modal.find('.end-date').prop('disabled', false);
        modal.find('.modal-title').text('Tambah Pengalaman Kerja');
    });

    // Form submission
    $('#saveExperience').click(function() {
        var form = $('#experienceForm');
        var formData = new FormData(form[0]);
        var experienceId = $('#experience_id').val();
        
        // Handle current job checkbox
        if ($('.current-job').is(':checked')) {
            formData.append('is_current', '1');
            formData.set('end_date', '');
        }

        var url = experienceId 
            ? `/save-experience/${experienceId}` 
            : '/save-experience';

        $.ajax({
            url: url,
            type: experienceId ? 'PUT' : 'POST',
            data: Object.fromEntries(formData),
            success: function(response) {
                // Close modal
                $('#addExperienceModal').modal('hide');
                
                // Reset form
                form[0].reset();
                $('.end-date').prop('disabled', false);
                
                // Format dates for display
                var startDate = new Date(response.data.start_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                var endDate = response.data.is_current ? 'Saat ini' : 
                             (response.data.end_date ? new Date(response.data.end_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) : '-');
                
                // Update atau tambah experience ke list
                var experienceHtml = `
                    <div class="card mb-3 experience-card" data-id="${response.data.id}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title mb-1">${response.data.position}</h5>
                                    <h6 class="card-subtitle mb-2">
                                        <a href="#" class="text-muted text-decoration-none">${response.data.company}</a>
                                    </h6>
                                    <p class="card-text text-muted mb-2" style="font-size: 0.9rem;">
                                        ${startDate} - ${endDate}
                                    </p>
                                    <p class="card-text">${response.data.description || ''}</p>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-link edit-experience" 
                                            data-id="${response.data.id}"
                                            data-position="${response.data.position}"
                                            data-company="${response.data.company}"
                                            data-start-date="${response.data.start_date}"
                                            data-end-date="${response.data.end_date || ''}"
                                            data-is-current="${response.data.is_current ? '1' : '0'}"
                                            data-description="${response.data.description || ''}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-link text-danger delete-experience" 
                                            data-id="${response.data.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                if (experienceId) {
                    // Update existing card
                    $(`.experience-card[data-id="${experienceId}"]`).replaceWith(experienceHtml);
                } else {
                    // Remove "No experience" message if present
                    if ($('#experienceList .alert').length) {
                        $('#experienceList .alert').remove();
                    }
                    // Add new card
                    $('#experienceList').prepend(experienceHtml);
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pengalaman kerja berhasil disimpan'
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menyimpan data'
                });
            }
        });
    });

    // Handle delete experience
    $(document).on('click', '.delete-experience', function() {
        const id = $(this).data('id');
        const card = $(this).closest('.experience-card');
        
        Swal.fire({
            title: 'Anda yakin?',
            text: "Pengalaman kerja ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/profile/experience/delete/${id}`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        card.fadeOut(300, function() {
                            $(this).remove();
                            if ($('#experienceList .experience-card').length === 0) {
                                $('#experienceList').html(`
                                    <div class="alert alert-info">
                                        Belum ada pengalaman kerja yang ditambahkan.
                                    </div>
                                `);
                            }
                        });
                        
                        Swal.fire(
                            'Terhapus!',
                            'Pengalaman kerja telah dihapus.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Gagal menghapus pengalaman kerja.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Education Functions
    function openEducationModal() {
        $('#educationModalLabel').text('Tambah Pendidikan');
        $('#educationForm')[0].reset();
        $('#educationId').val('');
        $('#educationModal').modal('show');
    }

    $('#is_current').change(function () {
        if ($(this).is(':checked')) {
            $('#end_date_group').hide();
            $('#end_date').val(''); // Kosongkan nilai end_date jika is_current dicentang
        } else {
            $('#end_date_group').show();
        }
    });

    // Perbaiki editEducation agar tetap mengikuti aturan
    window.editEducation = function (id) {
        const education = {!! json_encode($educations->keyBy('id')) !!};
        const educationData = education[id];

        if (!educationData) {
            console.error('Education data not found for id:', id);
            return;
        }

        console.log('Start Date:', educationData.start_date);
        console.log('End Date:', educationData.end_date);

        $('#educationModalLabel').text('Edit Pendidikan');
        $('#educationId').val(id);
        $('#school_name').val(educationData.school_name || '');
        $('#degree').val(educationData.degree || '');
        $('#field_of_study').val(educationData.field_of_study || '');
        $('#start_date').val(educationData.start_date ? educationData.start_date.substring(0, 10) : '');
        $('#end_date').val(educationData.end_date ? educationData.end_date.substring(0, 10) : '');
        $('#is_current').prop('checked', !!educationData.is_current);
        $('#description').val(educationData.description || '');

        if (educationData.is_current) {
            $('#end_date_group').hide();
            $('#end_date').val(''); // Kosongkan jika masih bersekolah
        } else {
            $('#end_date_group').show();
        }

        $('#educationModal').modal('show');
    };



    $('#saveEducation').click(function() {
            const id = $('#educationId').val();
            const formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                school_name: $('#school_name').val(),
                degree: $('#degree').val(),
                field_of_study: $('#field_of_study').val(),
                start_date: $('#start_date').val(),
                end_date: $('#is_current').is(':checked') ? null : $('#end_date').val(),
                is_current: $('#is_current').is(':checked') ? true : false,
                description: $('#description').val()
            };
            
            const url = id ? `/education-store/${id}` : '/education-store';
            const method = id ? 'PUT' : 'POST';
            
            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function(response) {
                    $('#educationModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data pendidikan berhasil disimpan'
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data'
                    });
                }
            });
    });

    window.deleteEducation = function (id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pendidikan akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/education/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.error || 'Terjadi kesalahan'
                        });
                    }
                });
            }
        });
    };


    // Certification Functions
    function openCertificationModal() {
        $('#certificationModalLabel').text('Tambah Sertifikasi');
        $('#certificationForm')[0].reset();
        $('#certificationId').val('');
        $('#certificationModal').modal('show');
    }

    window.editCertification = function (id) {
        const certification = @json($certifications->keyBy('id'));
        const certificationData = certification[id];

        if (!certificationData) {
            console.error('Certification data not found for id:', id);
            return;
        }

        $('#certificationModalLabel').text('Edit Sertifikasi');
        $('#certificationId').val(id);
        $('#name').val(certificationData.name || '');
        $('#issuing_organization').val(certificationData.issuing_organization || '');
        $('#credential_id').val(certificationData.credential_id || '');
        $('#issue_date').val(certificationData.issue_date ? certificationData.issue_date.substring(0, 10) : '');
        $('#expiration_date').val(certificationData.expiration_date ? certificationData.expiration_date.substring(0, 10) : '');
        $('#has_expiration').prop('checked', !!certificationData.has_expiration);
        $('#description').val(certificationData.description || '');

        if (certificationData.has_expiration) {
            $('#expiration_date_group').show();
        } else {
            $('#expiration_date_group').hide();
        }

        $('#certificationModal').modal('show');
    };

    $('#saveCertification').click(function() {
        const id = $('#certificationId').val();
        const formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $('#name').val(),
            issuing_organization: $('#issuing_organization').val(),
            credential_id: $('#credential_id').val(),
            issue_date: $('#issue_date').val(),
            expiration_date: $('#has_expiration').is(':checked') ? $('#expiration_date').val() : null,
            has_expiration: $('#has_expiration').is(':checked'),
            descriptioncertifications: $('#descriptioncertifications').val()
        };
        
        const url = id ? `/certification-store/${id}` : '/certification-store';
        const method = id ? 'PUT' : 'POST';
        
        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                $('#certificationModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data sertifikasi berhasil disimpan'
                }).then(() => {
                    window.location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data'
                });
            }
        });
    });

    window.deleteCertification = function (id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data sertifikasi akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/certification/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.error || 'Terjadi kesalahan'
                        });
                    }
                });
            }
        });
    };

    // Event Handlers
    
});
</script>

@endsection