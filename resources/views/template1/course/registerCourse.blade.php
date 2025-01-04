@extends('template1.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')

@section('Meta')
    <meta property="og:url" content="{{ url()->current() }}" />
    <title>{{ $meta['title'] ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $meta['description'] ?? 'Default Description' }}">
    <meta property="og:url" content="{{ $meta['url'] ?? url()->current() }}" />
    <meta property="og:image" content="{{ $meta['image'] ?? asset('default-image.jpg') }}" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $meta['url'] }}" />
    <meta property="og:image" content="{{ $meta['image'] }}" />
    <meta property="og:description" content="{{ $meta['description'] }}" />

    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">
    <meta name="twitter:image" content="{{ $meta['image'] }}">
@endsection
{{--
<section class="section-box">
    <div class="box-head-single">
        <div class="container">
            <h3 style="font-size: 34px!important;"><b>{{ $getdataDetail->traning_name }}</b></h3>
        </div>
    </div>
</section> --}}
<section class="section-box text-center">
    <div class="box-head-single bg-2">
        <div class="container">
            <h3 style="font-size: 34px!important;"><b>{{ $getdataDetail->traning_name }}</b></h3>
        </div>
    </div>
</section>

<section class="section-box mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="course-detail-container">
                    <!-- Gambar di atas -->
                    <section class="section-box mt-50">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12 mx-auto">

                                    <div class="job-overview">
                                        <div class="col-md-8">
                                            {{-- <div class="sidebar-icon-item"><i class="fi-rr-edit"></i></div> --}}
                                            <div class="sidebar-text-info ml-10">
                                                <span class="text-description mb-10">Nama</span>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    required placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-15">

                                            <div class="sidebar-text-info ml-10">
                                                {{-- <div class="sidebar-icon-item"><i class="fi-rr-phone-call"></i></div> --}}
                                                <span class="text-description mb-10">No HP</span>
                                                <input type="text" name="nohp" id="nohp" class="form-control"
                                                    required placeholder="No HP">
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-15">
                                            {{-- <div class="sidebar-icon-item"><i class="fi fi-rr-envelope"></i></div> --}}
                                            <div class="sidebar-text-info ml-10">
                                                <span class="text-description mb-10">Email</span>
                                                <input type="text" name="email" id="email" class="form-control"
                                                    required placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-15">
                                            {{-- <div class="sidebar-icon-item"><i class="fa fa-graduation-cap"></i>
                                            </div> --}}
                                            <div class="sidebar-text-info ml-10">
                                                <span class="text-description mb-10">Background Pendidikan</span>
                                                <select id="backgroundEducation" name="backgroundEducation"
                                                    class="form-control">
                                                    <option value="">Select an option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-15">
                                            {{-- <div class="sidebar-icon-item"><i class="fa fa-graduation-cap"></i>
                                            </div> --}}
                                            <div class="sidebar-text-info ml-10">
                                                <span class="text-description mb-10">Background Pendidikan(Lainnya)
                                                </span>
                                                <textarea rows="4" cols="50"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-50">
                                            <div class="col-lg-6 col-md-12">
                                                <a href="#" class="btn btn-default mr-10">Apply now</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Tab content -->
                    <div id="tabContentContainer" class="tab-content">
                        <p>Konten untuk tab Trainer akan muncul di sini.</p>
                    </div>
                    <!-- Tab content -->
                    <div id="tabContentContainer" class="tab-content">
                        <p>Konten untuk tab Trainer akan muncul di sini.</p>
                    </div>
                </div>





            </div>


        </div>
    </div>
</section>
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Silahkan share ke akun media sosial
                    anda.</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid p-2 py-0 pb-3">
                    <div class="row p-0 p-md-2 py-0 py-md-0">
                        <div class="col-12 text-center">

                            <div class="text-center">
                                <div>{!! $share_buttons !!}</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Trigger AJAX when the page loads or on an event
        $.ajax({
            url: '/get-backgroundeducation', // The route to fetch data
            method: 'GET', // HTTP method
            dataType: 'json', // Response type
            success: function(response) {
                // Check if the response contains data
                if (response && response.length > 0) {
                    // Iterate through the data and append options
                    response.forEach(function(item) {
                        $('#backgroundEducation').append(
                            `<option value="${item.id_background_education }">${item.nama_bgrd_edu}</option>`
                        );
                    });
                } else {
                    $('#mySelect').append('<option value="">No options available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    });
</script>


@endsection
