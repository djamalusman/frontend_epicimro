@extends('layouts.app')
@section('title')
@endsection
@section('content')
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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

        .imgGrid-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            /* Tambahkan overlay transparan untuk efek poster */
            border-radius: 12px;
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

        .uniform-image-container {
            /* width: 100%; */
            height: 150px;
            /* Atur tinggi tetap untuk gambar */
            overflow: hidden;
            /* Sembunyikan bagian gambar yang melampaui ukuran ini */
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            /* Tambahkan border-radius untuk sudut gambar */
        }

        .uniform-image-container img {
            /* width: 100%; */
            height: 100%;
            object-fit: cover;
            /* Memastikan gambar mengisi seluruh area tanpa mengubah rasio aslinya */
        }

        .social-icon {
            font-size: 24px;
            color: #333;
            margin-right: 10px;
            text-decoration: none;
        }

        .card-grid-container-news {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card-grid-2-image {
            overflow: hidden;
            position: relative;
        }

        .card-grid-2-image a {
            display: block;
            width: 100%;
        }

        .card-grid-2-image img {
            max-width: 100%;
            /* height: auto; */
        }

        .card-grid-2-images {
            /* flex: 1 1 50%; */
            padding-right: 1px;
            /* line-height: 10px; */
        }

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

        .card-block-info-news {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .card-title-category-news {
            min-height: 30px;
            display: flex;
            align-items: baseline;
        }

        .card-title-news {
            min-height: 50px;
            display: flex;
            align-items: baseline;
            font-family: 'Montserrat';
            font-weight: bold;
            font-size: 22px;
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
        }
    </style>
    <div class="breacrumb-cover">
        <div class="container">
            <ul class="breadcrumbs">
                <li>
                    <h6></h6>
                </li>
            </ul>
        </div>
    </div>
    <div class="post-loop-grid">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 float-right">
                    <div class="sidebar-shadow sidebar-news-small">
                        <h5 class="sidebar-title">Upcoming Training</h5>
                        <div class="post-list-small" id="training-list"></div>
                    </div>
                    <div class="sidebar-shadow sidebar-news-small">
                        <div class="post-list-small">
                            @foreach ($datayotubeDtNew as $valyotube)
                                @if ($valyotube->id_category == 30)
                                    <iframe src="{{ $valyotube->url }}" frameborder="0" width="100%" height="auto"
                                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            @foreach ($galerry as $valgallery)
                                @if ($valgallery->id_category == 32)
                                    <figure>
                                        <div class="">
                                            <img alt="jobhub" class="imgGrid"
                                                src="{{ asset('https://admin.trainingkerja.com/public//storage/' . ($valgallery->file ?? '')) }}">
                                        </div>
                                    </figure>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="single-body">
                        <div class="single-content">
                            <h4 style="font-weight: bold;">{{ $getdataDetail->title }}</h4>

                            <img alt="jobhub"
                                src="{{ asset('https://admin.trainingkerja.com/public//storage/' . ($getdataDetail->file ?? '')) }}" />

                            <p style="text-align: justify:!important"><?php echo $getdataDetail->description; ?> </p>
                        </div>
                    </div>
                    <div class="single-body float-left">
                        <div class="single-content">
                            Share to:
                            <a href="#" id="share-facebook" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" id="share-twitter" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" id="share-linkedin" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" id="share-whatsapp" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="footer-social">

                        </div>
                    </div>

                </div>
                <div class="related-posts mt-50">
                    <h4 class="mb-30">Another Article :</h4>
                    <div class="box-swiper">
                        <div class="swiper-container swiper-group-3">
                            <div class="swiper-wrapper pb-70 pt-5">

                                @foreach ($anotherarticle as $item)
                                    <div class="swiper-slide">

                                        <div class="card-grid-container-news">
                                            <div class="card-grid-2 hover-up">

                                                <div class="text-center card-grid-2-image">
                                                    <a
                                                        href="/detail-news/{{ base64_encode($item->id) }}/{{ Str::slug($item->title) }}">
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
                                                    <div class="card-title-category-news">
                                                        <div class="col-md-8">
                                                            {{ $item->category }}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span
                                                                class="card-time">{{ \Carbon\Carbon::parse($item->implementation_date)->format('d M Y') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-title-news mt-5">
                                                        <a
                                                            href="/detail-news/{{ base64_encode($item->id) }}/{{ Str::slug($item->title) }}">{{ $item->title }}</a>
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

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('share-whatsapp').addEventListener('click', function(e) {
            e.preventDefault();
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent("<?php echo $getdataDetail->title; ?>");
            window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
        });

        document.getElementById('share-facebook').addEventListener('click', function(e) {
            e.preventDefault();
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            window.open(`https://www.facebook.com/sharer.php?u=${url}&t=${title}`, '_blank');
        });

        document.getElementById('share-twitter').addEventListener('click', function(e) {
            e.preventDefault();
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent(document.title);
            window.open(`https://twitter.com/share?url=${url}&text=${text}`, '_blank');
        });

        document.getElementById('share-linkedin').addEventListener('click', function(e) {
            e.preventDefault();

            // Log the current URL to ensure it's correct
            console.log("Current URL:", window.location.href);

            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            const summary = encodeURIComponent('<?php echo $getdataDetail->title; ?>');

            // Open LinkedIn share window
            window.open(
                `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}&summary=${summary}`,
                '_blank'
            );
        });


        $(document).ready(function() {
            // Mengambil data upcoming trainings
            $.ajax({
                url: '/fetch-upcoming-jobs-sidebar',
                method: 'GET',
                success: function(response) {
                    $('#training-list').html(response);
                }
            });

            // Mengambil data news
            // $.ajax({
            //     url: '/fetch-upcoming-news',
            //     method: 'GET',
            //     success: function(response) {
            //         $('#news-list').html(response);
            //     }
            // });
        });
    </script>
@endsection
