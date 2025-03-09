@extends('layouts.app')
@section('title')
    HOME
@endsection

@section('meta')
    <!-- Meta Tags -->

    <meta name="description"
        content="Pusat training dan lowongan kerja sektor Industri, EPC, Fabrikasi, Inspeksi, Operation, Maintenance, Repair, & Overhaul">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Kerjateknik Academy" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://kerjateknik.id" />
    <meta property="og:image" content="https://kerjateknik.id/assets/imgs/theme/kerjateknik.png" />
    <meta property="og:description"
        content="Kerjateknik Academy: Pusat training dan lowongan kerja sektor Industri, EPC, Fabrikasi, Inspeksi, Operation, Maintenance, Repair, & Overhaul" />

    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kerjateknik Academy">
    <meta name="twitter:description"
        content="Kerjateknik Academy: Pusat training dan lowongan kerja sektor Industri, EPC, Fabrikasi, Inspeksi, Operation, Maintenance, Repair, & Overhaul">
    <meta name="twitter:image" content="https://kerjateknik.id/assets/imgs/theme/kerjateknik.png">
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
        

        /* Menyusun gaya untuk card dan gambarnya */
        .card-grid-2 {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 1px 10px #00505e;
            margin-bottom: 30px;
        }


        .card-grid-22 {
            position: relative;
            overflow: hidden;
            /* border-radius: 8px; */
            margin-bottom: 30px;
        }

        .card-grid-2-image {
            overflow: hidden;
            position: relative;
        }

        .card-grid-2-image a {
            display: block;
            width: 100%;
        }

        .imgGrid-container {
            position: relative;
            width: 100%;
            padding-top: 60%;
            /* Mengatur rasio aspek gambar (60% untuk rasio 16:9) */
        }

        .imgGrid-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Memastikan gambar menutupi area tanpa mengubah rasio aslinya */
            border-radius: 8px 8px 0 0;
            /* Agar sudut atas gambar melengkung sesuai card */
        }

        .card-block-info {
            padding: 20px;
        }

        /* Sesuaikan ukuran gambar jika diperlukan */
        .card-grid-2-image img {
            max-width: 100%;
            /* height: auto; */
        }


        .card-grids-2 {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-grid-2-images {
            /* flex: 1 1 50%; */
            padding-right: 1px;
            /* line-height: 10px; */
        }

        .card-block-infos {
            flex: 1 1 50%;
            display: flex;
            align-items: center;
            /* Vertically center the text within its container */
        }


        .testimonial-texts {
            font-size: 14px;
            text-align: justify;
            padding: 15px;
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-grids-2 {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-grid-2-images,
            .card-block-infos {
                flex: 1 1 100%;
                padding-right: 0;
            }

            .testimonial-texts {
                font-size: 14px;
                text-align: justify;
            }
        }

        @media (max-width: 576px) {
            .testimonial-texts {
                font-size: 12px;
            }
        }

        .text-two-lines {
            display: -webkit-box;
            /* Menggunakan flexbox untuk mendukung multiline */
            -webkit-line-clamp: 1;
            /* Membatasi jumlah baris menjadi 2 */
            -webkit-box-orient: vertical;
            /* Mengatur orientasi box menjadi vertikal */
            overflow: hidden;
            /* Menyembunyikan teks yang melampaui dua baris */
            text-overflow: ellipsis;
            /* Menambahkan ellipsis (...) di akhir teks yang terpotong */
            white-space: normal;
            /* Mengizinkan teks untuk wrap */
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        /* Banner */

        * {
            box-sizing: border-box;
        }

        .banner-wrapper {
            position: relative;
            max-width: 1327px;
            /* max-height: 377px; */
            margin: auto;
            overflow: hidden;
            border-radius: 0px;
            /* box-shadow: 0 1px 10px #00505e; */

        }

        .slides-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
            /* Adjust to allow sliding of each individual image */
        }

        .slide {
            min-width: 100%;
            /* Each slide takes 100% of the wrapper */
            position: relative;
            overflow: hidden;
            /* Menghindari gambar keluar dari batas slide */
            transition: opacity 0.5s ease-in-out;
        }

        .CoverPhoto {
            width: 100%;
            transition: transform 0.5s ease;
            /* Transisi halus untuk efek zoom */
        }

        .slide:hover .CoverPhoto {
            transform: scale(1.1);
            /* Efek zoom in saat hover */
        }

        .slide.zoom-out .CoverPhoto {
            transform: scale(0.9);
            /* Efek zoom out jika diperlukan */
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
            /* Add background for better visibility */
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .dots {
            text-align: center;
            padding: 10px;
        }

        .dot {
            cursor: pointer;.imgGrid-container img
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .activeb {
            background-color: orange;
        }

        .dot:hover {
            background-color: orange;
        }

        @media (max-width: 768px) {
            .banner-wrapper {
                max-width: 100%;
                height: auto;
            }

            .prev,
            .next {
                font-size: 14px;
                padding: 10px;
            }

            .dots {
                padding: 5px;
            }

            .dot {
                height: 10px;
                width: 10px;
            }
        }

        /* Untuk layar yang lebih kecil lagi, seperti ponsel ukuran kecil */
        @media (max-width: 480px) {

            .prev,
            .next {
                font-size: 12px;
                padding: 8px;
            }

            .CoverPhoto {
                border-radius: 4px;
            }

            .dot {
                height: 8px;
                width: 8px;
            }
        }


        .card-grid-container-news {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        /* Ensures all card titles have the same height */
        .card-title-category-news {
            min-height: 30px;
            display: flex;
            align-items: baseline;
        }

        /* Modifikasi card-title-news agar hanya menampilkan maksimal 2 baris dan ellipsis jika lebih */
        .card-title-news {
            min-height: 50px;
            display: flex;
            align-items: baseline;
            font-family: 'Montserrat';
            /* font-weight: bold; */
            font-size: 20px;
            line-height: 1.2;
            /* Line height to control spacing between lines */
            max-height: 2.4em;
            /* Limiting to 2 lines */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Limits text to 2 lines */
            -webkit-box-orient: vertical;
            color: white;
        }



        .card-block-info-news {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .upcomingtraininghover {
            color: black;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Animasi transisi */
        }

        .upcomingtraininghover:hover {
            color: #ff873e;
            /* Warna teks saat hover */
        }

        .upcomingjobhome {
            color: black;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Animasi transisi */
        }

        .upcomingjobhome:hover {
            color: #ff873e;
            /* Warna teks saat hover */
        }


        .newshomehover {
            color: black;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Animasi transisi */
        }

        .newshomehover:hover {
            color: #ff873e;
            /* Warna teks saat hover */
        }

        .ourgalleryhover {
            color: black;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Animasi transisi */
        }

        .ourgalleryhover:hover {
            color: #ff873e;
            /* Warna teks saat hover */
        }

        .ourvideohover {
            color: black;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Animasi transisi */
        }

        .ourvideohover:hover {
            color: #ff873e;
            /* Warna teks saat hover */
        }

        .ourpartnethover {
            color: black;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Animasi transisi */
        }

        .ourpartnethover:hover {
            color: #ff873e;
            /* Warna teks saat hover */
        }

        .swiper-pagination {
            bottom: 10px;
            /* Position the pagination */
        }
        .swiper-pagination-youtube {
            bottom: 10px;
            /* Position the pagination */
        }

        .swiper-pagination-gallery {
            bottom: 10px;
            color: #ff873e;
            /* Position the pagination */
        }
        .custom-bullet {
            background: #d3d3d3;
            /* Light gray color for inactive dots */
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin: 0 5px;
            opacity: 0.5;
            transition: opacity 0.3s;
        }

        .custom-bullet-active {
            background: #ff7f50;
            /* Orange color for active dot */
            opacity: 1;
        }

        .btn-defaults {
            background-color: #f05537;

            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            text-decoration: none;
            /* font-weight: bold; */
            margin-right: 10px;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <section class="section-box mt-60">
        <div class="block-banner">
            <div class="banner-wrapper">
                <div class="slides-container" id="slides">
                    @foreach ($home as $valhome)
                        <div class="slide">
                            <!--<img alt="jobhub" class="CoverPhoto"src="{{ asset('http://127.0.0.1:8081/storage/' . ($valhome->file ?? '')) }}">-->
                            <img alt="jobhub"
                                class="CoverPhoto"src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($valhome->file ?? '')) }}">
                        </div>
                    @endforeach
                </div>

                <!-- Navigation buttons -->
                <a hidden class="prev" onclick="moveSlides(-1)">&#10094;</a>
                <a hidden ="next" onclick="moveSlides(1)">&#10095;</a>

                <!-- Dots for navigation -->
                <div class="dots">
                    <span class="dot" onclick="currentSlide(0)"></span>
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                </div>
            </div>

        </div>
    </section>




    <section class="section-box  md-50 mt-50">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <h2 class="section-title mb-1 wow animate__animated animate__fadeInUp upcomingtraininghover">Upcoming
                        Training</h2>
                </div>
                <div class="col-lg-6 col-md-5 text-lg-end text-start">

                    <button class="btn btn-defaults wow animate__ animate__fadeInUp hover-up mt-15 animated"
                        data-wow-delay=".1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;font-size:14px;"
                        onclick="window.location.href='{{ route('course-grid') }}'">View
                        more</button>
                </div>
            </div>
            <div class="mt-20 mt-md-70">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="row" id="training-list">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-40">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <h2 class="section-title mb-1 wow animate__animated animate__fadeInUp upcomingtraininghover">Upcoming
                        Jobs</h2>
                </div>
                <div class="col-lg-6 col-md-5 text-lg-end text-start">

                    <button class="btn btn-defaults wow animate__ animate__fadeInUp hover-up mt-15 animated"
                        data-wow-delay=".1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;font-size:14px;"
                        onclick="window.location.href='{{ route('job-grid') }}'">View
                        more</button>
                </div>
            </div>
            <div class="mt-20">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="row" id="jobs-list">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>




    <div class="section-box wow animate__animated animate__fadeIn mt-70">
        <div class="container">
            <div class="col-lg-7 col-md-7">
                <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp ourpartnethover">Our Partner</h2>
            </div>
            <div class="box-swiper">
                <div class="swiper-container swiper-group-6">
                    <div class="swiper-wrapper pb-70 pt-5">
                        @foreach ($sponsor as $values)
                            <div class="swiper-slide hover-up">
                                <div class="item-logo">
                                    <a href="{{ $values->url }}"><img alt="jobhub"
                                            src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($values->file ?? '')) }}" /></a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <section class="section-box mt-20 mt-md-50">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7 col-md-7">
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp newshomehover">News</h2>
                </div>
                <div class="col-lg-5 col-md-5 text-lg-end text-start">

                    <button class="btn btn-default wow animate__ animate__fadeInUp hover-up mt-15 animated"
                        data-wow-delay=".1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;font-size:14px;"
                        onclick="window.location.href='{{ route('news-list') }}'">View
                        more</button>
                </div>
            </div>
            <div class="row mt-20">
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3">
                        <div class="swiper-wrapper pb-70 pt-5">
                            @foreach ($news as $item)
                                <div class="swiper-slide">

                                    <div class="card-grid-container-news">
                                        <div class="card-grid-2 hover-up">

                                            <div class="text-center card-grid-2-image">
                                                <a href="/detail-news/{{ base64_encode($item->id) }}">
                                                    <div class="imgGrid-container">
                                                        <figure>
                                                            <a
                                                                href="/detail-news/{{ base64_encode($item->id) }}/{{ Str::slug($item->title) }}">
                                                                <img class="imgGrid"
                                                                    src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($item->file ?? '')) }}" />
                                                            </a>
                                                        </figure>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="card-block-info-news">
                                                <div class="card-title-news mt-5">
                                                    <a
                                                        href="/detail-news/{{ base64_encode($item->id) }}/{{ Str::slug($item->title) }}">{{ $item->title }}</a>
                                                </div>

                                                <div class="card-title-category-news mt-10">

                                                    <div class="col-md-8" style="color:black">
                                                        {{ $item->category }}
                                                    </div>

                                                    <div class="col-md-4" style="color:black">
                                                        <span
                                                            class="card-time">{{ \Carbon\Carbon::parse($item->implementation_date)->format('d M Y') }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination swiper-pagination3"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="section-box mt-20 mt-md-0">
        <div class="container">
            <div class="col-lg-7 col-md-7">
                <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp ourgalleryhover">Our Gallery</h2>
            </div>
            <div class="row mt-20">
                <div class="box-swiper">
                    <div class="swiper-container gallery swiper-group-3">
                        <div class="swiper-wrapper pb-70 pt-5">
                            <div class="swiper-wrapper"> 
                                <!-- Slide akan ditambahkan dengan JavaScript -->
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--     
    <section class="section-box mt-20 mt-md-0">
        <div class="container">
            <div class="col-lg-7 col-md-7">
                <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp ourgalleryhover">Video</h2>
            </div>
            <div class="row mt-20">
                <div class="box-swiper">
                    <div class="swiper-container youtube swiper-group-3">
                        <div class="swiper-wrapper pb-70 pt-5">
                            <div class="swiper-wrapper"> 
                                <!-- Slide akan ditambahkan dengan JavaScript -->
                            </div>
                        </div>
                        <div class="swiper-pagination-youtube"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <script>
        
        $(document).ready(function () {
            // Inisialisasi Swiper untuk Gallery
            let swiperGallery = new Swiper('.swiper-container.gallery', {
                slidesPerView: 3,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination-gallery',
                    clickable: true,
                },
                lazy: true,
            });

            // let swiperYoutube = new Swiper('.swiper-container.youtube', {
            //     slidesPerView: 3,
            //     spaceBetween: 10,
            //     loop: true,
            //     autoplay: {
            //         delay: 3000,
            //         disableOnInteraction: false,
            //     },
            //     pagination: {
            //         el: '.swiper-pagination-youtube',
            //         clickable: true,
            //     },
            //     lazy: true,
            // });


            // Load data setelah Swiper diinisialisasi
            loadGallery(swiperGallery);
            //loadYoutube(swiperYoutube);
        });


        function loadGallery(swiperGallery) {
            $.getJSON(`/gallery?page=1`, function (data) {
                if (!data.length) {
                    console.log("Gallery data is empty.");
                    return;
                }

                data.forEach(function (item) {
                    let slide = `
                        <div class="swiper-slide">
                            <div class="card-grid-69 hover-up">
                                <div class="box-image-findgalery box-image-galery ml-0">
                                    <figure>
                                        <div class="imgGrid-container">
                                            <img alt="gallery" class="imgGrid swiper-lazy"
                                                data-src="https://admin.trainingkerja.com/public/storage/${item.file}"
                                                loading="lazy">
                                        </div>
                                    </figure>
                                    <a href="https://admin.trainingkerja.com/public/storage/${item.file}"
                                        class="btn-play-galery popup-youtube"></a>
                                </div>
                            </div>
                        </div>`;

                    swiperGallery.appendSlide(slide);
                });

                swiperGallery.update(); // Update Swiper setelah slide ditambahkan
                swiperGallery.lazy.load(); // Paksa lazy load jika perlu
            }).fail(function () {
                console.log("Failed to load gallery data.");
            });
        }

        // function loadYoutube(swiperYoutube) {
        //     $.getJSON(`/youtube?page=1`, function (data) {
        //         if (!data.length) {
        //             console.log("YouTube data is empty.");
        //             return;
        //         }

        //         data.forEach(function (item) {
        //             let slide = `
        //                 <div class="swiper-slide">
        //                     <div class="card-grid-69 hover-up">
        //                         <iframe class="embed-responsive-item"
        //                                 height="240px" width="420px"
        //                                 src="${item.url}"
        //                                 allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        //                                 allowfullscreen>
        //                         </iframe>
        //                     </div>
        //                 </div>`;

        //             swiperYoutube.appendSlide(slide);
        //         });

        //         swiperYoutube.update();
        //         swiperYoutube.lazy.load();
        //     }).fail(function () {
        //         console.log("Failed to load YouTube data.");
        //     });
        // }




        $(document).ready(function() {
            

            // Mengambil data upcoming trainings
            $.ajax({
                url: '/fetch-upcoming-trainings',
                method: 'GET',
                success: function(response) {
                    $('#training-list').html(response);
                }
            });

            // Mengambil data upcoming job
            $.ajax({
                url: '/fetch-upcoming-jobvacancy',
                method: 'GET',
                success: function(response) {
                    $('#jobs-list').html(response);
                }
            });
            // Mengambil data upcoming news
            $.ajax({
                url: '/fetch-upcoming-news',
                method: 'GET',
                success: function(response) {
                    $('#news-list').html(response);
                }
            });

        });

        let currentIndex = 0;
        const slides = document.getElementById('slides');
        const totalSlides = slides.children.length;

        // Function to move the slides
        function moveSlides(direction) {
            currentIndex += direction;

            // If index exceeds the last slide, go back to the first slide
            if (currentIndex >= totalSlides) {
                currentIndex = 0;
            }

            // If index is less than the first slide, go to the last slide
            if (currentIndex < 0) {
                currentIndex = totalSlides - 1;
            }

            // Move slides by changing transform property
            const newTranslateValue = -currentIndex * 100; // Percentage based on current slide
            slides.style.transform = `translateX(${newTranslateValue}%)`;

            // Update the dots
            updateDots();
        }

        // Update active dot based on current slide
        function updateDots() {
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, index) => {
                dot.classList.remove('activeb');
                if (index === currentIndex) {
                    dot.classList.add('activeb');
                }
            });
        }

        // Function to directly go to a specific slide
        function currentSlide(index) {
            currentIndex = index;
            moveSlides(0); // Move to the specified slide
        }

        // Auto slide every 3 seconds
        setInterval(() => {
            moveSlides(1); // Move to next slide automatically
        }, 5000);

        // Initialize dots
        updateDots();
    </script>
@endsection
