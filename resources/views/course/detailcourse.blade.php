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

                    <div class="content-single">

                        {{-- @foreach ($listfiles as $valFile)
                            <div class="image-container">
                                <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($valFile->nama ?? '')) }}" class="custom-image" />
                            </div>
                            @break
                        @endforeach<br> --}}
                        <h2><b>Training requirements</b></h2>
                        @php $counter = 1; @endphp
                        @foreach($listpersyaratan as $persyaratan)
                            <p style="border: 0px; margin: 6px; padding: 0px; vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; list-style-type: decimal;">{{ $counter }}. {{ $persyaratan->nama }}</p>
                            @php $counter++; @endphp
                        @endforeach

                        <h2 class="mt-20"><b>Training material</b></h2>
                        @php $counterm = 1; @endphp
                        @foreach($listmateri as $materi)
                            <p style="border: 0px; margin: 6px; padding: 0px; vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; list-style-type: decimal;">{{ $counterm }}. {{ $materi->nama }}</p>
                            @php $counterm++; @endphp
                        @endforeach

                        <h2 class="mt-20"><b>Facility</b></h2>
                            @php $counterf = 1; @endphp
                            @foreach($listfasilitas as $fasilitas)
                                <p style="border: 0px; margin: 6px; padding: 0px; vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; list-style-type: decimal;">{{ $counterf }}. {{ $fasilitas->nama }}</p>
                                @php $counterf++; @endphp
                            @endforeach
                    </div>
                    <div class="single-apply-jobs">
                        <div class="row align-items-center">

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


    <script>
        // var myIndex = 0;
        // carousel();

        // function carousel() {
        //   var i;
        //   var x = document.getElementsByClassName("mySlides");
        //   for (i = 0; i < x.length; i++) {
        //     x[i].style.display = "none";
        //   }
        //   myIndex++;
        //   if (myIndex > x.length) {myIndex = 1}
        //   x[myIndex-1].style.display = "block";
        //   setTimeout(carousel, 2000); // Change image every 2 seconds
        // }
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
    {{-- <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
          showDivs(slideIndex += n);
        }

        function showDivs(n) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          if (n > x.length) {slideIndex = 1}
          if (n < 1) {slideIndex = x.length}
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";
          }
          x[slideIndex-1].style.display = "block";
        }
    </script> --}}


@endsection
