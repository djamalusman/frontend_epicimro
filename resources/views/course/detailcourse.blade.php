@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}

        .copy-button:hover {
            background-color: #45a049;
        }
        .popup {
            display: none; /* Initially hidden */
            position: absolute;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            top: 485px !important; /* Position it directly below the button */
            left: 0; /* Align with the left edge of the button */
            width: max-content; /* Adjust width to fit content */
        }
        .popup.show {
            display: block;
        }


    .custom-image {
        width: 170px; /* Ubah sesuai kebutuhan */
        height: 50px; /* Pertahankan rasio aspek */
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
        clear: both; /* Untuk mengatur konten setelah gambar */
        overflow: hidden; /* Mengatur perbaikan layout jika gambar terlalu besar */
    }
 /* Responsive iframe container */
 .iframe-container {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    margin-bottom: -20px; /* Atur jarak di bawah iframe */
}

.iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 10px; /* Untuk membuat sudut tumpul */
}
    /* Button styles */
    .btn-default {
        background-color: #8e7dff; /* Similar to your button color */
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-default:hover {
        background-color: #6a59cc; /* Darker shade on hover */
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
    bottom: 10px;  /* Position the tabs near the bottom of the image */
    left: 50%;     /* Center the tabs horizontally */
    transform: translateX(-50%); /* Adjust the center alignment */
    display: flex;
    gap: 10px; /* Reduced gap between tabs */
    padding: 10px;
    /* background-color: rgba(255, 255, 255, 0.7); Semi-transparent white background */
    border-radius: 20px; /* Rounded corners */
}

/* Tab styling with black border */
.tab {
    color: #333;
    cursor: pointer;
    padding: 5px 0px;  /* Increase padding for larger tab buttons */
    font-weight: bold;
    /* border-radius: 20px;  Rounded corners for each tab */
    border: 2px solid black;  /* Black border around each tab */
    transition: background-color 0.3s ease, border-color 0.3s ease;  /* Smooth transition for background and border color */
    background-color: #f0f0f0; /* Light grey background for inactive tabs */
    text-align: center; /* Center text inside each tab */
    width: 280px;
}

/* Active tab styling with black border */
.tab.active {
    background-color: #f39c12; /* Active tab color (yellow) */
    color: #fff; /* White text for active tab */
    border-color: #f39c12; /* Active tab's border color */
}

/* Hover effect for tabs */
.tab:hover {
    background-color: #e67e22; /* Darker shade for hover effect */
    color: #fff; /* White text on hover */
    border-color: #e67e22; /* Change border color on hover */
}

/* Tab content section */
.tab-content {
    margin-top: 20px;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    /* Adjust position for smaller screens */
    .tabs-container {
        bottom: 5px; /* Adjust position for smaller screens */
        padding: 8px;
        max-width: 85%; /* Adjust tab width */
    }

    /* Override default values for mobile */
    :root {
        --tab-font-size: 10px;   /* Smaller font size on mobile */
        --tab-padding: 8px 15px; /* Adjust padding for smaller screens */
    }

    .tab {
        font-size: var(--tab-font-size);  /* Apply adjusted font size */

    }

    .tab.active {
        background-color: #f0a500; /* Active tab color */
        color: white;
    }
}


</style>
    <section class="section-box">
        <div class="box-head-single">
            <div class="container">
                <h1><b>{{$getdataDetail->traning_name}}</b></h1>
            </div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">

                    <div class="course-detail-container">
                        <!-- Gambar di atas -->
                        <div class="course-image">
                            <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($imagetraining->nama ?? '')) }}" alt="Course Image">

                            <!-- Tabs inside the image, positioned at the bottom -->
                            <div class="tabs-container">
                                <div class="tab" data-id="1">About Training</div>
                                <div class="tab active" data-id="2">Trainer</div>
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
                        <iframe src="{{$getdataDetail->yotube}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>

                    <div class="sidebar-shadow">

                        <div class="text-start mt-20">
                            <input type="text" hidden id="textToCopy" value="https://trainingkerja.com/detail-course/{{base64_encode($getdataDetail->id)}}" readonly>
                            <a href="{{$getdataDetail->link_pendaftaran}}" class="btn btn-default mr-10"style="font-size:15px;">Apply now</a>
                            <a href="#" class="btn btn-default mr-10" onclick="copyToClipboard(event)"style="font-size:15px;">Share</a>

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
                                        <strong class="small-heading">{{$getdataDetail->category}}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-edit mr-5 text-grey-6"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Certificate type</span>
                                        <strong class="small-heading">{{$getdataDetail->cetificate_type}}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Durasi Training</span>
                                        <strong class="small-heading">{{ $getdataDetail->training_duration}}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class=""><img src="https://trainingkerja.com/assets/imgs/jobs/logos/coins.png" style="width: 25px; height :25px;"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Registration fee</span>
                                        <strong class="small-heading">{{$getdataDetail->registrationfee}}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-edit mr-5 text-grey-6"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Type Training</span>
                                        <strong class="small-heading">{{$getdataDetail->typeonlineofline}}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Location</span>
                                        <strong class="small-heading">{{$getdataDetail->provinsi}} - {{$getdataDetail->lokasi}} </strong>
                                    </div>
                                </li>


                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Training start date</span>
                                        <strong class="small-heading">{{ \Carbon\Carbon::parse($getdataDetail->startdate)->format('d M Y') }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Training end date</span>
                                        <strong class="small-heading">{{ \Carbon\Carbon::parse($getdataDetail->enddate)->format('d M Y') }}</strong>
                                    </div>
                                </li>


                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ambil courseId dari elemen atau backend (contoh, pastikan courseId benar)
            const courseId = '{{ base64_encode($getdataDetail->id) }}';

            // Event listener untuk tab
            $('.tab').on('click', function () {
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
                    error: function (error) {
                        // Tangani error jika AJAX gagal
                        console.error('Error:', error);
                        $('#tabContentContainer').html('<p>Data tidak ada</p>');
                    }
                });
            });

            // Klik tab pertama secara otomatis saat halaman dimuat
            $('.tab.active').click();
        });


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
