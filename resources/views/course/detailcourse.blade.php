@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .mySlides {
            display: none;
        }

        .copy-button:hover {
            background-color: #45a049;
        }

        .popup {
            display: none;
            /* Initially hidden */
            position: absolute;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            top: 485px !important;
            /* Position it directly below the button */
            left: 0;
            /* Align with the left edge of the button */
            width: max-content;
            /* Adjust width to fit content */
        }

        .popup.show {
            display: block;
        }


        .custom-image {
            width: 170px;
            /* Ubah sesuai kebutuhan */
            height: 50px;
            /* Pertahankan rasio aspek */
            /* margin: 10px; Atur margin sesuai keinginan */
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        /* Jika ingin mengatur gambar ke tengah (opsional) */
        .centered-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .image-container {
            clear: both;
            /* Untuk mengatur konten setelah gambar */
            overflow: hidden;
            /* Mengatur perbaikan layout jika gambar terlalu besar */
        }

        /* Responsive iframe container */
        .iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin-bottom: -20px;
            /* Atur jarak di bawah iframe */
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            /* Untuk membuat sudut tumpul */
        }

        /* Button styles */
        .btn-defaults {
            background-color: #f05537;

            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            text-decoration: none;
            /* font-weight: bold; */
            margin-right: 10px;
        }

        .btn-default:hover {
            background-color: #6a59cc;
            /* Darker shade on hover */
        }

        /* Sidebar item styles */


        .text-description {
            color: #888;
            font-size: 14px;
        }

        .small-heading {
            font-size: 16px;
            font-weight: bold;
        }

        /* Gambar */
        .course-image {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Container for the course details */
        .course-detail-container {
            position: relative;
            width: 100%;
        }

        /* Image container */
        .course-image {
            position: relative;
            width: 100%;
            height: auto;
        }

        .course-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Container for the course details */
        .course-detail-container {
            position: relative;
            width: 100%;
        }

        /* Image container */
        .course-image {
            position: relative;
            width: 100%;
            height: auto;
        }

        .course-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Tabs container positioned at the bottom of the image */
        .tabs-container {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 18px;
            padding: 10px;
            border-radius: 20px;
        }

        /* Tab styling with black border */
        .tab {
            color: #333;
            cursor: pointer;
            padding: 5px 0px;
            /* Increase padding for larger tab buttons */
            font-weight: bold;
            /* border-radius: 20px;  Rounded corners for each tab */
            /* border: 2px solid black; */
            /* Black border around each tab */
            transition: background-color 0.3s ease, border-color 0.3s ease;
            /* Smooth transition for background and border color */
            background-color: #f0f0f0;
            /* Light grey background for inactive tabs */
            text-align: center;
            /* Center text inside each tab */
            width: 280px;
        }

        /* Active tab styling with black border */
        .tab.active {
            background-color: #f39c12;
            /* Active tab color (yellow) */
            color: #fff;
            /* White text for active tab */
            border-color: #f39c12;
            /* Active tab's border color */
        }

        /* Hover effect for tabs */
        .tab:hover {
            background-color: #e67e22;
            /* Darker shade for hover effect */
            color: #fff;
            /* White text on hover */
            border-color: #e67e22;
            /* Change border color on hover */
        }

        /* Tab content section */
        .tab-content {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {

            /* Adjust position for smaller screens */
            .tabs-container {
                bottom: 5px;
                /* Adjust position for smaller screens */
                padding: 8px;
                max-width: 85%;
                /* Adjust tab width */
            }

            /* Override default values for mobile */
            :root {
                --tab-font-size: 10px;
                /* Smaller font size on mobile */
                --tab-padding: 8px 15px;
                /* Adjust padding for smaller screens */
            }

            .tab {
                font-size: var(--tab-font-size);
                /* Apply adjusted font size */

            }

            .tab.active {
                background-color: #f0a500;
                /* Active tab color */
                color: white;
            }
        }

        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding: 10px 20px;
            border: 0px solid #ccc;
            margin: 1px;
            font-size: 30px;
            color: #000000
                /* background-color: #ffffff; */
        }
        .button-group {
        display: flex;
        gap: 10px; /* Memberikan jarak antar tombol */
        align-items: center;
    }

    .btn-defaults {
        background-color: #f05537;
        border: none;
        padding: 10px 15px;
        color: white;
        font-size: 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-defaults:hover {
        background-color: #f05537;
    }
    </style>
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

<section class="section-box">
    <div class="box-head-single">
        <div class="container">
            <h3 style="font-size: 34px!important;"><b>{{ $getdataDetail->traning_name }}</b></h3>
        </div>
    </div>
</section>

<section class="section-box mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">

                <div class="course-detail-container">
                    <!-- Gambar di atas -->
                    <div class="course-image">
                        {{-- <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($imagetraining->nama ?? '')) }}"
                            alt="Course Image"> --}}
                            @if ( $imagetraining->fileold !="frontend")
                                
                                    <img class="imgGrid"
                                    src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($imagetraining->nama ?? '')) }}" />
                            
                            @else
                            
                            
                                <img src="{{ asset('/storage/' . ($imagetraining->nama ?? '')) }}">
                        
                            
                            @endif
                    </div>
                    <div class="course-image">
                        <br>
                        <br>
                        <div class="tabs-container">
                            <div class="tab active" data-id="1">About Training</div>
                            <div class="tab" data-id="2">Trainer</div>
                            <div class="tab" data-id="3">Career</div>
                        </div>
                    </div>
                    <!-- Tab content -->
                    <div id="tabContentContainer" class="tab-content">
                        <p>Konten untuk tab Trainer akan muncul di sini.</p>
                    </div>
                </div>





            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                <div class="iframe-container">
                    <!-- Responsive iframe container -->
                    <iframe src="{{ $getdataDetail->yotube }}" frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <div class="sidebar-shadow">

                    <div class="text-start mt-20">
                            <div class="button-group">
                                    @if (session('email') && $role !='company')
                                            {{-- <a href="{{ route('registertraining', ['id' => base64_encode($getdataDetail->id)]) }}"
                                                target="_blank" class="btn btn-defaults mr-10"
                                                style="font-size:15px;color:white">Register now</a> --}}
                                                @if ($getdtApplyTraining != null || $getdtApplyTraining != "")
                                                    <a href="#" class="btn btn-defaults">Success Register</a>
                                                @else
                                                    <form id="courseForm" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" value="{{ base64_encode($getdataDetail->idcompany) }}" name="idcompany" id="idcompany">
                                                        <input type="hidden" value="{{ base64_encode($getdataDetail->id) }}" name="idtraining" id="idtraining">
                                                        <button type="submit" class="btn btn-defaults">Register now</button>
                                                    </form>
                                                @endif
                                    @else
                                        @if ($role == 'company')
                                            <a href="#" class="btn btn-defaults mr-10"
                                                style="font-size:15px;color:white">Register now</a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-defaults mr-10"
                                                style="font-size:15px;color:white">Register now</a> 
                                        @endif       
                                        
                                    @endif
                                    <button class="btn btn-defaults" data-bs-toggle="modal" data-bs-target="#shareModal">
                                        Share Link
                                    </button>
                            </div>
                            <div id="popup" class="popup">
                                <p>Tautan telah disalin</p>
                            </div>


                    </div>


                    <div class="sidebar-list-job">
                        <ul>
                            <li>
                                <div class="sidebar-icon-item"> <i class="fi-rr-edit mr-5 text-grey-6"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Category</span>
                                    <strong class="small-heading">{{ $getdataDetail->category }}</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-edit mr-5 text-grey-6"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Certificate type</span>
                                    <strong class="small-heading">{{ $getdataDetail->cetificate_type }}</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Durasi Training <strong
                                            class="small-heading">{{ $getdataDetail->training_duration }}</strong></span>

                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class=""><img
                                            src="https://trainingkerja.com/assets/imgs/jobs/logos/coins.png"
                                            style="width: 25px; height :25px;"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Registration fee</span>
                                    <strong class="small-heading">{{ $getdataDetail->registrationfee }}</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-edit mr-5 text-grey-6"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Type Training</span>
                                    <strong class="small-heading">{{ $getdataDetail->typeonlineofline }}</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Location</span>
                                    <strong class="small-heading">{{ $getdataDetail->provinsi }} -
                                        {{ $getdataDetail->lokasi }} </strong>
                                </div>
                            </li>


                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Training start date</span>
                                    <strong
                                        class="small-heading">{{ \Carbon\Carbon::parse($getdataDetail->startdate)->format('d M Y') }}</strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                <div class="sidebar-text-info">
                                    <span class="text-description">Training end date</span>
                                    <strong
                                        class="small-heading">{{ \Carbon\Carbon::parse($getdataDetail->enddate)->format('d M Y') }}</strong>
                                </div>
                            </li>


                        </ul>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
            $('#courseForm').on('submit', function(event) {
                event.preventDefault(); // Mencegah reload halaman

                let formData = new FormData(this); // Ambil data form

                $.ajax({
                    url: "{{ route('storeTrainingClient') }}",
                    method: "POST",
                    data: formData,
                    processData: false, // Jangan ubah data
                    contentType: false, // Jangan set contentType
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload(); // Refresh halaman jika berhasil
                        } else {
                            alert('Error: ' + response.error); // Tampilkan pesan error khusus
                        }
                    },
                    error: function(xhr) {
                        let response = xhr.responseJSON;
                        if (response && response.message) {
                            alert('Gagal: ' + response.message); // Menampilkan pesan error dari server
                        } else {
                            alert('Terjadi kesalahan saat mengirim data.');
                        }
                    }
                });
            });
        });
    $(document).ready(function() {
        // Ambil courseId dari elemen atau backend (contoh, pastikan courseId benar)
        const courseId = '{{ base64_encode($getdataDetail->id) }}';

        // Event listener untuk tab
        $('.tab').on('click', function() {
            // Hapus kelas active dari semua tab
            $('.tab').removeClass('active');

            // Tambahkan kelas active pada tab yang diklik
            $(this).addClass('active');

            // Ambil ID tab
            const tabId = $(this).data('id');
            console.log(tabId);

            // AJAX request untuk mendapatkan konten berdasarkan tabId
            $.ajax({
                url: `/detail-course-content/${courseId}/${tabId}`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Update konten tab sesuai dengan respons
                        $('#tabContentContainer').html(response.content);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    // Tangani error jika AJAX gagal
                    console.error('Error:', error);
                    $('#tabContentContainer').html('<p>Data tidak ada</p>');
                }
            });
        });

        // Klik tab pertama secara otomatis saat halaman dimuat
        $('.tab.active').click();
    });

    function copyToClipboard() {
        const shareUrl = "{{ url()->current() }}"; // URL halaman artikel
        navigator.clipboard.writeText(shareUrl) // Salin URL ke clipboard
            .then(() => {
                alert('Link berhasil disalin ke clipboard!');
            })
            .catch(err => {
                console.error('Error copying text: ', err);
            });
    }



    function copyToClipboard(event) {
        event.preventDefault(); // Prevent default link behavior

        // Get the text field
        var copyText = document.getElementById("textToCopy").value;
        var popup = document.getElementById("popup");

        // Use the Clipboard API to copy text
        navigator.clipboard.writeText(copyText).then(function() {
            // Show the popup
            popup.classList.add("show");

            // Position the popup
            var button = event.target; // Get the clicked button
            var rect = button.getBoundingClientRect(); // Get button's position
            popup.style.top = (rect.bottom + window.scrollY) + 'px'; // Position below the button
            popup.style.left = (rect.left + window.scrollX) + 'px'; // Align with the button

            // Hide the popup after 3 seconds
            setTimeout(function() {
                popup.classList.remove("show");
            }, 3000); // 3000 milliseconds = 3 seconds
        }).catch(function(error) {
            console.error('Gagal menyalin teks: ', error);
        });
    }
</script>



@endsection
