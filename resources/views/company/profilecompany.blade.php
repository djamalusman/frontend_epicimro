@extends('layouts.app')

@section('title', 'Profile Company')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 Bootstrap Theme -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />


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
                        <button class="btn-default edit-summary" 
                            data-id="{{ $personalsummary->id }}"
                            data-name="{{ $personalsummary->name }}"
                            data-lastname="{{ $personalsummary->lastname }}"
                            data-email="{{ $personalsummary->email }}"
                            data-password="{{ null}}"
                            data-phone="{{ $personalsummary->phone }}"
                            data-description="{{ $personalsummary->description }}" 
                            data-descriptionaddress="{{ $personalsummary->company_address }}"
                            data-provinsi-id="{{ $personalsummary->provinsi_id }}" 
                            data-sector-id="{{ $personalsummary->sector_id }}"
                            style="border: 0px; background-color:white;">
                            <i class='fas fa-edit' style='font-size:25px;color:#f05537'></i>
                        </button>
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
            <div class="divider"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="content-single">

                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <h4 class="mb-20 mt-25">Tentang Perusahaan</h4>
                            </div>
                        </div>
                        <p>
                            {{$userData->description}}
                        </p>

                        
                </div>
                
                <div class="single-recent-jobs">
                    <h4 class="heading-border"><span>News</span></h4>
                    <div class="list-recent-jobs">
                        <div class="card-job hover-up wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/digital.png"></figure>
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
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub"></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-job hover-up wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/n-digital.png"></figure>
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
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub"></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-job hover-up wow animate__animated animate__fadeInUp" style="visibility: hidden; animation-name: none;">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/n-digital2.png"></figure>
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
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub"></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-job hover-up wow animate__animated animate__fadeInUp" style="visibility: hidden; animation-name: none;">
                            <div class="card-job-top">
                                <div class="card-job-top--image">
                                    <figure><img alt="jobhub" src="assets/imgs/page/job/digital.png"></figure>
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
                                        <span><img src="assets/imgs/theme/icons/shield-check.svg" alt="jobhub"></span>
                                        <span class="ml-5"><img src="assets/imgs/theme/icons/bookmark.svg" alt="jobhub"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-20">
                            <a href="job-grid.html" class="btn btn-default">Explore more</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                <div class="sidebar-shadow sidebar-news-small">
                    <h5 class="sidebar-title">Posting Training</h5>
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
                    <h5 class="sidebar-title"> Posting Job</h5>
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
                <form id="personalForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="personal_id" id="personal_id">
                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="name"  name="name">
                    </div>
                    <div class="mb-3">
                        <label>Alamat perusahan</label>
                        <textarea name="descriptionaddress"  class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control"  id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label>Upload Foto</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input readonly type="email" disabled class="form-control"  id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="provinsi">Provinsi</label>
                        <select id="provinsi" name="provinsi_id" class="form-control select2">
                            <option value="" disabled {{ old('provinsi_id', $selectedProvinceId ?? '') == '' ? 'selected' : '' }}>Pilih Provinsi</option>
                            @foreach($provinces as $provinsi)
                                <option value="{{ $provinsi->id }}" {{ old('provinsi_id', $selectedProvinceId ?? '') == $provinsi->id ? 'selected' : '' }}>
                                    {{ $provinsi->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="sector">Sektor</label>
                        <select id="sector" name="sector_id" class="form-control select2">
                            <option value="" disabled {{ old('sector_id', $selectedSectorId ?? '') == '' ? 'selected' : '' }}>Pilih Sektor</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}" {{ old('sector_id', $selectedSectorId ?? '') == $sector->id ? 'selected' : '' }}>
                                    {{ $sector->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label>Tentang perusahan</label>
                        <textarea name="description"  class="form-control" rows="3"></textarea>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


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

    });

    $(document).ready(function() {
        

        // Riwayat Pribadi

            
        $('.select2').select2({
            theme: 'bootstrap4',  // Gunakan tema Bootstrap
            placeholder: "Pilih opsi",
            allowClear: true
        });


        $(document).on('click', '.edit-summary', function() {
        var btn = $(this);
        var modal = $('#addPersonalModal');

        var selectedProvinsi = btn.data('provinsi-id') || null; 
        var selectedSector = btn.data('sector-id') || null; 
        // Set form values
        modal.find('#personal_id').val(btn.data('id') || '');
        modal.find('input[name="name"]').val(btn.data('name') || '');
        modal.find('textarea[name="descriptionaddress"]').val(btn.data('descriptionaddress') || '');
        modal.find('input[name="password"]').val(btn.data('password') || '');
        modal.find('input[name="email"]').val(btn.data('email') || '');
        modal.find('input[name="phone"]').val(btn.data('phone') || '');
        modal.find('textarea[name="description"]').val(btn.data('description') || '');
        
        // Set selected Provinsi dan Sector jika ada
        $('#provinsi').val(selectedProvinsi).trigger('change'); 
        $('#sector').val(selectedSector).trigger('change');


        // Update modal title
        modal.find('.modal-title').text('Ubah informasi perusahan');

        // Show modal
        modal.modal('show');
    });

    // Ketika modal ditutup, hapus data kosong
    $('#addPersonalModal').on('hidden.bs.modal', function() {
        var modal = $(this);

        // Reset semua input, textarea, dan select
        modal.find('#personal_id').val('');
        modal.find('input, textarea').val(''); 
        
        // Reset Select2
        modal.find('#provinsi, #sector').val(null).trigger('change');

        // Reset judul modal
        modal.find('.modal-title').text('Tambah Ringkasan Pribadi');
    });


        
    $('#saveSummary').click(function() {
            var form = $('#personalForm')[0]; // Ambil elemen form
            var formData = new FormData(form);
            var personalId = $('#personal_id').val();

            if (personalId) {
                formData.append('_method', 'PUT'); // Tambahkan _method untuk Laravel
            }

            $.ajax({
                url: personalId ? `/save-company-profile/${personalId}` : '/save-company-profile',
                type: 'POST', // Selalu gunakan POST, karena kita sudah menambahkan _method
                data: formData,
                processData: false, 
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Pastikan CSRF token terkirim
                },
                success: function(response) {
                    $('#addPersonalModal').modal('hide');
                    $('#personalForm')[0].reset();

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
                                        <button type="button" class="btn btn-link text-danger delete-personal" 
                                                data-id="${response.data.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    if (personalId) {
                        $(`.personal-card[data-id="${personalId}"]`).replaceWith(personalHtml);
                    } else {
                        if ($('#personalList .alert').length) {
                            $('#personalList .alert').remove();
                        }
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

        // Riwayat Pendidikan

    });
</script>

@endsection