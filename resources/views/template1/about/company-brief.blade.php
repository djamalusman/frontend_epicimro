@extends('template1.layouts.app')
@section('title')
    HOME
@endsection

@section('content')
    <style>
        /* Menyusun gaya untuk card dan gambarnya */
        .card-grid-2 {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            height: auto;
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

        .testimonial-videos {
            width: 210%;
            /* height: 100%; */
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
    <div class="archive-header pt-50 pb-50 ">
        <div class="container">
            <h3 class="mb-30  w-75 mx-auto">
                <h4 class="mt-2 mb-0 display-5">{{ $dataItem->side_list }}</h4>
            </h3>

        </div>
    </div>
    <div class="post-loop-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-7">
                    <div class="single-body">
                        <figure class="mb-30">
                            <img src="https://admin.trainingkerja.com/public/storage/{{ $dataItem->item_file ?? '' }}"
                                class="card-img-top" alt="course image" width="140px">
                        </figure>
                        <div class="single-content">
                            <?php echo $dataItem->item_body; ?>
                        </div>



                    </div>
                </div>
                <div class="row mt-30">
                    <div class="container">
                        <div class="col-lg-7 col-md-7">
                            <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp hover-up"
                                data-wow-delay=".1s">
                                Our Gallery</h2>
                        </div>
                        <div class="row mt-20">
                            <div class="box-swiper">
                                <div class="swiper-container swiper-group-3">
                                    <div class="swiper-wrapper pb-70 pt-5">
                                        @foreach ($galerry as $valgallery)
                                            @if ($valgallery->id_category == 31)
                                                <div class="swiper-slide">
                                                    <div class="card-grid-69 hover-up">
                                                        <div class="box-image-findgalery box-image-galery ml-0">
                                                            <figure>
                                                                <div class="imgGrid-container">
                                                                    <img alt="jobhub" class="imgGrid"
                                                                        src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($valgallery->file ?? '')) }}">
                                                                </div>
                                                            </figure>
                                                            <a href="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($valgallery->file ?? '')) }}"
                                                                class="btn-play-galery popup-youtube"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination swiper-pagination3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-4">
                                <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp">Video</h2>
                            </div>

                        </div>
                        <div class="mt-20">
                            <div class="tab-content" id="myTabContent-1">
                                <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                                    aria-labelledby="tab-one-1">
                                    <div class="row">
                                        @foreach ($yotube as $valyotube)
                                            @if ($valyotube->id_category == 30)
                                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                                    <div class="card-grid-2-images">
                                                        <a href="video-page.html">
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <iframe class="embed-responsive-item" height="240px;"
                                                                    width="420px;" src="{{ $valyotube->url }}"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen>
                                                                </iframe>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section-box mt-50 mb-60" hidden>
        <div class="container">
            <div class="box-newsletter">
                <h5 class="text-md-newsletter">Sign up to get</h5>
                <h6 class="text-lg-newsletter">the latest jobs</h6>
                <div class="box-form-newsletter mt-30">
                    <form class="form-newsletter">
                        <input type="text" class="input-newsletter" value=""
                            placeholder="contact.alithemes@gmail.com" />
                        <button class="btn btn-default font-heading icon-send-letter">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="box-newsletter-bottom">
                <div class="newsletter-bottom"></div>
            </div>
        </div>
    </section>
@endsection
