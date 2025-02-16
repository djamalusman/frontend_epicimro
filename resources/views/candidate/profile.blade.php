@extends('layouts.app')

@section('title', 'Profile Candidate')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    .skill-tag {
        display: inline-block;
        background-color: #f1f3f5;
        color: #333;
        padding: 6px 12px;
        border-radius: 20px;
        margin: 5px;
        font-size: 14px;
        cursor: pointer;
    }
    .skill-tag .remove-skill {
        margin-left: 8px;
        color: #888;
        font-weight: bold;
        cursor: pointer;
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
                        {{-- <button class="btn-default edit-summary" 
                            data-id="{{ $personalsummary->id }}"
                            data-position="{{ $personalsummary->name }}"
                            data-company="{{ $personalsummary->lastname }}"
                            data-company="{{ $personalsummary->email }}"
                            data-company="{{ $personalsummary->password }}"
                            data-company="{{ $personalsummary->phone }}"
                            data-is-current="{{ $personalsummary->photo}}"
                            data-description="{{ $personalsummary->bio }}" 
                            style="border: 0px; background-color:white;">
                            <i class='fas fa-edit' style='font-size:25px;color:#f05537'></i>
                        </button> --}}
                        <button  class="btn-default" data-bs-toggle="modal" data-bs-target="#addPersonalModal" style="border: 0px; background-color:white;">
                            <i class='fas fa-edit' style='font-size:25px;color:#f05537'></i>
                        </button>
                    </h4>
                    <div class="head-info-profile">
                        <span class="text-small mr-20"><i class="fi-rr-marker text-mutted"></i> Chicago, US</span>
                        <span class="text-small mr-20"><i class="fi fi-rr-envelope"></i> {{ $personalsummary->email }}</span>
                        <span class="text-small"><i class="fi-rr-phone-call text-mutted"></i> {{ $personalsummary->phone }}</span>
                        
                    </div>
                    {{-- <div class="row align-items-end">
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Figma</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Adobe XD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">App</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Digital</a>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-box mt-1">
    <div class="container">
        <div class="row">
            <div class="divider"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="content-single">
                    
                        <div class="row align-items-end">
                            <div class="col-lg-4">
                                <h4 class="mb-20 mt-25">Ringkasan pribadi</h4>
                            </div>
                        </div>
                        <p>
                            {{$userData->description}}
                        </p>

                        <div class="divider mt-5"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <h4 class="mb-20 mt-25">Pengalaman Kerja  <button type="button"  style="border: 0px; background-color:white;"  class="btn-default  mb-20 mt-25" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                                    <i class='fas fa-plus-circle' style='font-size:25px;color:#f05537'></i>
                                </button></h4>
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
                                                {{-- <button class="btn-default edit-experience" 
                                                    data-id="{{ $experience->id }}"
                                                    data-position="{{ $experience->position }}"
                                                    data-company="{{ $experience->company }}"
                                                    data-start-date="{{ $experience->start_date ? $experience->start_date->format('Y-m-d') : '' }}"
                                                    data-end-date="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}"
                                                    data-is-current="{{ $experience->is_current ? '1' : '0' }}"
                                                    data-description="{{ $experience->description }}" 
                                                    style="border: 0px; background-color:white;">
                                                    <i class='fas fa-edit' style='font-size:20px;color:#f05537'></i>
                                                </button> 
                                                <button type="button" class="btn-default delete-experience" 
                                                        data-id="{{ $experience->id }}" 
                                                        style="border: 0px; background-color:white;">
                                                    <i class='fas fa-trash' style='font-size:20px;color:#f05537'></i>
                                                </button> --}}
                                                <img id="resumeImage" src="https://admin.trainingkerja.com/public/storage/6727b1318a81e.webp" 
                                                alt="Register Icon" style="max-width: 150px; height: auto; cursor: pointer; margin-left: 27px;">
                                            
                                                <button class=" btn-default edit-experience" 
                                                        data-id="{{ $experience->id }}"
                                                        data-position="{{ $experience->position }}"
                                                        data-company="{{ $experience->company }}"
                                                        data-start-date="{{ $experience->start_date ? $experience->start_date->format('Y-m-d') : '' }}"
                                                        data-end-date="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}"
                                                        data-is-current="{{ $experience->is_current ? '1' : '0' }}"
                                                        data-description="{{ $experience->description }}" 
                                                        style="border: 0px; background-color: white; margin-left: 150px;">
                                                    <i class='fas fa-edit' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                                <button type="button" class="btn-defaultt delete-experience" 
                                                            data-id="{{ $experience->id }}" style="border: 0px; background-color: white; margin-left: 5px;">
                                                    <i class='fas fa-trash' style='font-size:20px;color:#f05537'></i>
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

                        <div class="divider mt-5"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <h4 class="mb-20 mt-5"> Riwayat Pendidikan <button type="button" style="border: 0px; background-color:white;"  
                                    class="btn-default mb-20 mt-25" onclick="addEducation()">
                                    <i class='fas fa-plus-circle' style='font-size:25px;color:#f05537'></i>
                                </button></h4>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($educations as $education)
                                <div class="col-lg-6 col-md-6" id="educationList">
                                        <div class="card-grid-2 hover-up wow animate__ animate__fadeIn animated" data-wow-delay=".s" style="visibility: visible; animation-name: fadeIn;" data-id="{{ $education->id }}">
                                            <div class="mt-15" style="display: flex; justify-content: flex-end; gap: 10px;">
                                                {{-- <button class=" btn-default" onclick="editEducation({{ $education->id }})" style="border: 0px; background-color:white;">
                                                    <i class='fas fa-edit' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                                <button class="btn-defaultt" style="border: 0px; background-color:white;" onclick="deleteEducation({{ $education->id }})">
                                                    
                                                    <i class='fas fa-trash' style='font-size:20px;color:#f05537'></i>
                                                </button> --}}
                                                <img id="resumeImage" src="https://admin.trainingkerja.com/public/storage/6727b1318a81e.webp" 
                                                    alt="Register Icon" style="max-width: 150px; height: auto; cursor: pointer; margin-left: 27px;">
                                                
                                                <button class=" btn-default" onclick="editEducation({{ $education->id }})" style="border: 0px; background-color: white; margin-left: 150px;">
                                                    <i class='fas fa-edit' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                                <button class="btn-defaultt" style="border: 0px; background-color: white; margin-left: 5px;" onclick="deleteEducation({{ $education->id }})">
                                                    <i class='fas fa-trash' style='font-size:20px;color:#f05537'></i>
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

                        <div class="divider mt-5"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <h4 class="mb-20 mt-5">Lisensi & sertifikasi <button type="button" style="border: 0px; background-color:white;"  
                                    class="btn-default mb-20 mt-25" onclick="addCertification()">
                                    <i class='fas fa-plus-circle' style='font-size:25px;color:#f05537'></i>
                                </button>
                                
                            </div>
                        </div>
                        <div class="row">
                            @foreach($certifications as $certification)
                                <div class="col-lg-6 col-md-6" id="certificationList">
                                        <div class="card-grid-2 hover-up wow animate__ animate__fadeIn animated" data-wow-delay=".s" style="visibility: visible; animation-name: fadeIn;" data-id="{{ $certification->id }}">
                                            {{-- <div class="mt-15" style="display: flex; justify-content: flex-end; gap: 10px;">
                                                <button class=" btn-default" onclick="editCertification({{ $certification->id }})" style="border: 0px; background-color:white;">
                                                    
                                                    <i class='fas fa-edit' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                                <button class="btn-defaultt" style="border: 0px; background-color:white;" onclick="deleteCertification({{ $certification->id }})">
                                                    
                                                    <i class='fas fa-trash' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                            </div> --}}
                                            <div class="mt-15 d-flex align-items-center">
                                                <img id="resumeImage" src="https://admin.trainingkerja.com/public/storage/6727b1318a81e.webp" 
                                                    alt="Register Icon" style="max-width: 150px; height: auto; cursor: pointer; margin-left: 27px;">
                                                
                                                <button class=" btn-default" onclick="editCertification({{ $certification->id }})" style="border: 0px; background-color: white; margin-left: 150px;">
                                                    <i class='fas fa-edit' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                                <button class="btn-defaultt" style="border: 0px; background-color: white; margin-left: 5px;" onclick="deleteCertification({{ $certification->id }})">
                                                    <i class='fas fa-trash' style='font-size:20px;color:#f05537'></i>
                                                </button>
                                            </div>
                                        <div class="card-block-info">
                                           
                                            <div class="mt-10" style="color:black;font-family: 'Open Sans' ;font-weight:520;font-size: 26px;">
                                                {{ $certification->namesertifikat }}
                                            </div>
                                            <div class="mt-10">
                                                <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                    {{ $certification->issuing_organization }} -  Diterbitkan: {{ \Carbon\Carbon::parse($certification->issue_date)->format('M Y') }}
                                                    @if($certification->has_expiration && $certification->expiration_date)
                                                    {{-- <br>Kadaluarsa: {{ \Carbon\Carbon::parse($certification->expiration_date)->format('M Y') }} --}}
                                                    @endif </h6>
                                            </div>
                                            <div class="mt-10">
                                                <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-size: 16px;">
                                                   ID Kredensial: {{ $certification->credential_id }} </h6>
                                            </div>
                                            <div class="single-body">
                                                <div class="single-content">
                                                    <p id="descriptioncertification-{{ $certification->id }}" class="truncate">{{ $certification->descriptioncertifications }}</p>
                                                    <button id="toggleButton-{{ $certification->id }}" class="btn-more" style="display: none;">More</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="divider mt-5"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <h4 class="mb-20 mt-5">Skill
                                
                                    <button type="button" style="border: 0px; background-color:white;" class="btn-default mb-20 mt-25" data-bs-toggle="modal" data-bs-target="#skillconfirmModal">
                                        <i class='fas fa-plus-circle' style='font-size:25px;color:#f05537'></i>
                                    </button>
                                    

                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12 mb-60">
                                <div class="card-block-info">
                                    <div id="skillsList" class="mt-2"></div>
                                </div>
                            </div>
                            
                        </div>


                        <div class="divider mt-5"></div>
                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <h4 class="mb-20 mt-5">Upload Resume
                                
                                    <button type="button" style="border: 0px; background-color:white;" class="btn-default mb-20 mt-25" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                        <i class='fas fa-plus-circle' style='font-size:25px;color:#f05537'></i>
                                    </button>
                                    

                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12 mb-60">
                                <div class="card-grid-2 hover-up wow animate__ animate__fadeIn animated" data-wow-delay=".s" style="visibility: visible; animation-name: fadeIn;" >
                                    <div class="mt-15 d-flex align-items-center">
                                        <img id="resumeImage" src="https://admin.trainingkerja.com/public/storage/6727b1318a81e.webp" 
                                            alt="Register Icon" style="max-width: 150px; height: auto; cursor: pointer; margin-left: 27px;">
                                        
                                        <button id="downloadResume" class="btn-default" style="border: 0px; background-color: white; margin-left: 190px;">
                                            <i class='fas fa-download' style='font-size:20px;color:#f05537'></i>
                                        </button>
                                    </div>
                                    
                                    
                                    <div class="card-block-info">
                                        <div class="mt-10" style="color:black;font-family: 'Open Sans' ;font-weight:520;font-size: 26px;">
                                            <p id="resumeName"></p>
                                        </div>
                                    
                                    </div>
                                    
                                </div>

                            </div>
                            
                        </div>

                    
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                <div class="sidebar-shadow sidebar-news-small">
                    <h5 class="sidebar-title">Rekomendasi Training</h5>
                    <div class="post-list-small">
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-1.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>You Should Have This Info Before Job Interview</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_1.png">
                                        <span>Sarah</span>
                                    </div>
                                    <div class="date">
                                        <span>02 Oct</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-2.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>How To Create a Resume for a Job in Social</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_3.png">
                                        <span>Harding</span>
                                    </div>
                                    <div class="date">
                                        <span>17 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-3.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>10 Ways to Avoid a Referee Disaster Zone</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_5.png">
                                        <span>Steven</span>
                                    </div>
                                    <div class="date">
                                        <span>23 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-4.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>How To Set Work-Life Boundaries From Any Location</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_6.png">
                                        <span>Merias</span>
                                    </div>
                                    <div class="date">
                                        <span>14 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-5.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>How to Land Your Dream Marketing Job</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_7.png">
                                        <span>Rosie</span>
                                    </div>
                                    <div class="date">
                                        <span>12 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-shadow sidebar-news-small">
                    <h5 class="sidebar-title">Rekomendasi Job</h5>
                    <div class="post-list-small">
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-1.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>You Should Have This Info Before Job Interview</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_1.png">
                                        <span>Sarah</span>
                                    </div>
                                    <div class="date">
                                        <span>02 Oct</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-2.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>How To Create a Resume for a Job in Social</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_3.png">
                                        <span>Harding</span>
                                    </div>
                                    <div class="date">
                                        <span>17 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-3.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>10 Ways to Avoid a Referee Disaster Zone</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_5.png">
                                        <span>Steven</span>
                                    </div>
                                    <div class="date">
                                        <span>23 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-4.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>How To Set Work-Life Boundaries From Any Location</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_6.png">
                                        <span>Merias</span>
                                    </div>
                                    <div class="date">
                                        <span>14 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-small-item d-flex align-items-center">
                            <figure class="thumb mr-15">
                                <img src="assets/imgs/blog/thumb-5.png" alt="">
                            </figure>
                            <div class="content">
                                <h5>How to Land Your Dream Marketing Job</h5>
                                <div class="post-meta text-muted d-flex align-items-center mb-15">
                                    <div class="author d-flex align-items-center mr-20">
                                        <img alt="jobhub" src="assets/imgs/avatar/ava_7.png">
                                        <span>Rosie</span>
                                    </div>
                                    <div class="date">
                                        <span>12 Sep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addPersonalModal" tabindex="-1" aria-labelledby="addPersonalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPersonalModalLabel">Ubah informasi pribadi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personalForm">
                    @csrf
                    <input type="hidden" name="personal_id" id="personal_id">
                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="name" value="{{$userData->name}}"  name="name">
                    </div>
                    <div class="mb-3">
                        <label>last Name</label>
                        <input type="text" class="form-control" id="lastname" value="{{$userData->lastname}}"  name="lastname">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" value="{{$userData->password}}" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label>Upload Foto</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input readonly type="email" disabled class="form-control" value="{{$userData->email}}" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" value="{{$userData->phone}}" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label>Ringkasan pribadi</label>
                        <textarea name="description"  class="form-control" rows="3"> {{$userData->description}}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-default" id="saveSummary">Simpan</button>
            </div>
        </div>
    </div>
</div>

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
                <button type="button" class="btn btn-default" id="saveExperience">Simpan</button>
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
                <button type="button" class="btn btn-default" id="saveEducation">Simpan</button>
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
                        <input type="text" class="form-control" id="namesertifikat" name="namesertifikat" required>
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
                <button type="button" class="btn btn-default" id="saveCertification">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="skillconfirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Tambah keahlian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" id="skillInput" class="form-control" placeholder="cth. Membangun tim">
                    <button type="button" class="btn btn-default" id="addSkillBtn">Tambah</button>
                </div>
                <ul id="skillDropdown" class="dropdown-menu w-100" style="display: none; position: absolute;"></ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Resume</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="file" id="resumeFile" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-default" id="submitResumeBtn">Upload</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

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

        $('#modalTambah').on('shown.bs.modal', function () {
            $(this).find('form')[0].reset();  // Reset saat modal muncul
        });

        // Riwayat Pribadi

            
        $(document).on('click', '.edit-summary', function() {
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

        
        $('#addPersonalModal').on('hidden.bs.modal', function() {
            var modal = $(this);
            modal.find('#personal_id').val('');
            modal.find('form')[0].reset();
            modal.find('.end-date').prop('disabled', false);
            modal.find('.modal-title').text('Tambah Ringkasan Pribady');
        });

        
        $('#saveSummary').click(function() {
            var form = $('#personalForm')[0]; // Ambil elemen form asli
            var formData = new FormData(form);
            var personalId = $('#personal_id').val();

            var url = personalId 
                ? `/save-personal/${personalId}` 
                : '/save-personal';

            $.ajax({
                url: url,
                type: personalId ? 'PUT' : 'POST',
                data: formData,
                processData: false,  // **Wajib false agar FormData dikirim dengan benar**
                contentType: false,  // **Wajib false agar tidak ada header tambahan**
                success: function(response) {
                    // Tutup modal
                    $('#addPersonalModal').modal('hide');

                    // Reset form
                    $('#personalForm')[0].reset();

                    // Update atau tambahkan informasi personal ke list
                    var personalHtml = `
                        <div class="card mb-3 personal-card" data-id="${response.data.id}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="card-text">${response.data.description || ''}</p>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-link edit-experience" 
                                                data-id="${response.data.id}"
                                                data-description="${response.data.description || ''}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-link text-danger" 
                                                data-id="${response.data.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    if (personalId) {
                        // Update data yang sudah ada
                        $(`.personal-card[data-id="${personalId}"]`).replaceWith(personalHtml);
                    } else {
                        // Hapus pesan "No experience" jika ada
                        if ($('#personalList .alert').length) {
                            $('#personalList .alert').remove();
                        }
                        // Tambahkan data baru ke list
                        $('#personalList').prepend(personalHtml);
                    }

                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Informasi pribadi berhasil disimpan'
                    }).then(() => {
                      
                        window.location.href = '/profile';
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



        
        //end riwayat pribadi

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
                    }).then(() => {
                        // **Reload halaman setelah notifikasi ditutup**
                        window.location.href = '/profile';
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
                            
                            Swal.fire({
                            icon: 'success',
                            title: 'Terhapus',
                            text: 'Pengalaman kerja telah dihapus'
                            }).then(() => {
                                // **Reload halaman setelah notifikasi ditutup**
                                window.location.href = '/profile';
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


        window.addEducation = function () {
            $('#certificationModalLabel').text('Tambah Sertifikasi');
            $('#school_name').val(''); // Kosongkan ID agar ini mode tambah
            $('#degree').val('');
            $('#field_of_study').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            $('#is_current').val('');
            $('#description').val('');

            $('#expiration_date_group').hide(); // Sembunyikan field expiration date

            // Buka modal dengan Bootstrap
            var myModal = new bootstrap.Modal(document.getElementById('educationModal'));
            myModal.show();
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

        // Fungsi untuk membuka modal tambah sertifikasi
        window.addCertification = function () {
            $('#certificationModalLabel').text('Tambah Sertifikasi');
            $('#certificationId').val(''); // Kosongkan ID agar ini mode tambah
            $('#namesertifikat').val('');
            $('#issuing_organization').val('');
            $('#credential_id').val('');
            $('#issue_date').val('');
            $('#expiration_date').val('');
            $('#has_expiration').prop('checked', false);
            $('#descriptioncertifications').val('');

            $('#expiration_date_group').hide(); // Sembunyikan field expiration date

            // Buka modal dengan Bootstrap
            var myModal = new bootstrap.Modal(document.getElementById('certificationModal'));
            myModal.show();
        };


        window.editCertification = function (id) {
            const certification = @json($certifications->keyBy('id'));
            const certificationData = certification[id];

            if (!certificationData) {
                console.error('Certification data not found for id:', id);
                return;
            }

            $('#certificationModalLabel').text('Edit Sertifikasi');
            $('#certificationId').val(id);
            $('#namesertifikat').val(certificationData.namesertifikat || '');
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
                namesertifikat: $('#namesertifikat').val(),
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


        // cv

        // skill
        $("#skillInput").on("input", function () {
            var query = $(this).val().trim();
            if (query.length >= 2) {
                $.ajax({
                    url: "/skills/search",
                    type: "GET",
                    data: { term: query },
                    success: function (data) {
                        let dropdown = $("#skillDropdown");
                        dropdown.empty().show();

                        if (data.length > 0) {
                            data.forEach(function (item) {
                                dropdown.append(`<li class="dropdown-item" data-value="${item}">${item}</li>`);
                            });
                        } else {
                            dropdown.append(`<li class="dropdown-item disabled">Tidak ditemukan</li>`);
                        }
                    }
                });
            } else {
                $("#skillDropdown").hide();
            }
        });

        // Pilih skill dari dropdown
        $(document).on("click", "#skillDropdown li", function () {
            var selectedSkill = $(this).data("value");
            $("#skillInput").val(selectedSkill);
            $("#skillDropdown").hide();
        });

        // Tambah skill setelah klik "Tambah"
        $("#addSkillBtn").click(function () {
            var skillValue = $("#skillInput").val().trim();
            if (skillValue !== '') {
                $.post('/skills', { skill_name: skillValue, _token: "{{ csrf_token() }}" }, function (data) {
                    if (data && data.id) {
                        $("#skillsList").append(`
                            <span class="skill-tag badge bg-primary me-2" data-id="${data.id}">
                                ${data.skill_name} <span class="remove-skill" style="cursor:pointer;">&times;</span>
                            </span>
                        `);
                        $("#skillInput").val('');
                        $("#skillDropdown").hide();
                        $("#skillconfirmModal").modal("hide");
                    }
                }).fail(function () {
                    alert("Gagal menyimpan skill. Coba lagi!");
                });
            }
        });

        // Hapus skill
        $(document).on("click", ".remove-skill", function () {
            var skillId = $(this).parent().data("id");
            var element = $(this).parent();

            $.ajax({
                url: '/skills/' + skillId,
                type: 'DELETE',
                data: { _token: "{{ csrf_token() }}" },
                success: function () {
                    element.remove();
                }
            });
        });

        // Bersihkan input saat modal ditutup
        $("#skillconfirmModal").on("hidden.bs.modal", function () {
            $("#skillInput").val('');
            $("#skillDropdown").hide();
        });

        // Load existing skills saat halaman dibuka
        function loadSkills() {
            $.get('/skills', function (skills) {
                $('#skillsList').html('');
                skills.forEach(function (skill) {
                    $('#skillsList').append(`
                        <span class="skill-tag badge me-2 text-small" data-id="${skill.id}" style="background-color: #f05537;color:white">
                            ${skill.skill_name} <span class="remove-skill" style="cursor:pointer;color:white">&times;</span>
                        </span>
                    `); 
                });
            });
        }

        loadSkills();
        

        
        // Upload Resume

            loadResume();

            // Upload Resume
            $("#submitResumeBtn").click(function() {
                var formData = new FormData();
                var file = $("#resumeFile")[0].files[0];

                if (!file) {
                    alert("Pilih file resume terlebih dahulu!");
                    return;
                }

                formData.append("resume", file);
                formData.append("_token", "{{ csrf_token() }}");

                $.ajax({
                    url: "/resume",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert("Resume berhasil diunggah!");
                        $("#uploadModal").modal('hide');
                        loadResume();
                    },
                    error: function() {
                        alert("Gagal mengunggah resume!");
                    }
                });
            });

            // Hapus Resume
            $("#deleteResumeBtn").click(function() {
                $.ajax({
                    url: "/resume",
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function() {
                        alert("Resume berhasil dihapus!");
                        loadResume();
                    },
                    error: function() {
                        alert("Gagal menghapus resume!");
                    }
                });
            });

            // Load Resume
            function loadResume() {
                $.get("/resume", function(data) {
                    if (data) {
                        $("#resumeName").text(data.file_name);
                        $("#downloadResume").off("click").on("click", function() {
                            window.open("/storage/" + data.file_path, "_blank"); // Buka di tab baru
                        });
                    } else {
                        $("#resumeName").text("Belum ada resume yang diunggah.");
                        $("#downloadResume").prop("disabled", true);
                    }
                });
            }


    });
</script>

@endsection