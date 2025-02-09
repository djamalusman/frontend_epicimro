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

        /* .testimonial-videos {

                height: 100%;
            } */

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

       

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }



        .social-links {
            display: flex;
        }

        .social-links a {
            width: 80px;
            height: 80px;
            text-align: center;
            text-decoration: none;
            color: #4723e6;
            box-shadow: 0 0 20px 10px rgba(0, 0, 0, 0.05);
            margin: 0 5px;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            transition: transform 0.5s;
        }

        .social-links a .fab {
            font-size: 30px;
            line-height: 80px;
            position: relative;
            z-index: 10;
            transition: color 0.5s;
        }

        .social-links a::after {
            content: '';
            width: 100%;
            height: 100%;
            top: -90px;
            left: 0;
            background: #000;
            background: linear-gradient(-45deg, #ed1c94, #ffec17);
            position: absolute;
            transition: 0.5s;
        }

        .social-links a:hover::after {
            top: 0;
        }

        .social-links a:hover .fab {
            color: #fff;
        }

        .social-links a:hover {
            transform: translateY(-10px);
        }
    </style>
    <section class="section-box">
        <div class="banner-hero hero-1">
            <div class="banner-inner">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="block-banner">
                            <span
                                class="text-small-primary text-small-primary--disk text-uppercase wow animate__animated animate__fadeInUp"
                                hidden>Best jobs place</span>
                            <h3 class="heading-banner wow animate__animated animate__fadeInUp">{{ $dataTk->item_title }}</h3>
                            <div class="banner-description mt-30 wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s"><?php echo $dataTk->item_body; ?></div>
                            <div class="form-find mt-60 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                                <form method="GET" action="{{ route('job-list') }}">
                                    <input type="text" class="form-input input-keysearch mr-10" name="jobtitle"
                                        placeholder="Job title, Company... " />
                                    <select class="form-input mr-10 select-active" name="provinsi">
                                        <option value="">Location</option>
                                        @foreach ($getDtProvinsi as $value)
                                            <option value="{{ $value->idprovinsi }}">{{ $value->namaprovinsi }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-default btn-find">Find now</button>
                                </form>
                            </div>
                            <div class="list-tags-banner mt-60 wow animate__animated animate__fadeInUp" data-wow-delay=".3s"
                                hidden>
                                <strong hi>Popular Searches:</strong>
                                <a href="#">Designer</a>, <a href="#">Developer</a>, <a href="#">Web</a>,
                                <a href="#">Engineer</a>, <a href="#">Senior</a>,
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-imgs">
                            <img alt="jobhub"
                                src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($dataTk->item_file ?? '')) }}"
                                class="img-responsive shape-1" />
                            <div hidden>
                                <span class="union-icon"><img alt="jobhub" src="assets/imgs/banner/union.svg"
                                        class="img-responsive shape-3" /></span>
                                <span class="congratulation-icon"><img alt="jobhub"
                                        src="assets/imgs/banner/congratulation.svg" class="img-responsive shape-2" /></span>
                                <span class="docs-icon"><img alt="jobhub" src="assets/imgs/banner/docs.svg"
                                        class="img-responsive shape-2" /></span>
                                <span class="course-icon"><img alt="jobhub" src="assets/imgs/banner/course.svg"
                                        class="img-responsive shape-3" /></span>
                                <span class="web-dev-icon"><img alt="jobhub" src="assets/imgs/banner/web-dev.svg"
                                        class="img-responsive shape-3" /></span>
                                <span class="tick-icon"><img alt="jobhub" src="assets/imgs/banner/tick.svg"
                                        class="img-responsive shape-3" /></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-box wow animate__animated animate__fadeIn mt-70">
        <div class="container">
            <div class="box-swiper">
                <div class="swiper-container swiper-group-6">
                    <div class="swiper-wrapper pb-70 pt-5">
                        @foreach ($sponsor as $values)
                            <div class="swiper-slide hover-up">
                                <div class="item-logo"><a href="{{ $values->url }}"><img class="imgGrid"
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
    <section class="section-box" hidden>
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp">Upcoming Browse Training By
                        Category</h2>
                    <p class="text-md-lh28 color-black-5 wow animate__animated animate__fadeInUp">Find the type of work
                        you need, clearly defined and ready to start. Work begins as soon as you purchase and provide
                        requirements.</p>
                </div>
                <div class="col-lg-5 text-lg-end text-start wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <a href="job-grid-2.html" class="mt-sm-15 mt-lg-30 btn btn-border icon-chevron-right">Browse all</a>
                </div>
            </div>
            <div class="row mt-70">
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp">
                        <div class="text-center">
                            <a href="job-grid.html">
                                <figure><img alt="jobhub" src="assets/imgs/theme/icons/marketing.svg" /></figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">Marketing & Communication</a>
                        </h5>
                        <p class="text-center text-stroke-40 mt-20">156 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="text-center">
                            <a href="job-grid.html">
                                <figure><img alt="jobhub" src="assets/imgs/theme/icons/content-writer.svg" /></figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">Content <br>Writer</a></h5>
                        <p class="text-center text-stroke-40 mt-20">268 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 wow animate__animated animate__fadeInUp"
                    data-wow-delay=".2s">
                    <div class="card-grid hover-up">
                        <div class="text-center">
                            <a href="job-grid.html">
                                <figure><img src="assets/imgs/theme/icons/marketing-director.svg" alt="jobhub" />
                                </figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">Marketing <br>Director</a></h5>
                        <p class="text-center text-stroke-40 mt-20">145 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <div class="text-center">
                            <a href="job-grid.html">
                                <figure><img src="assets/imgs/theme/icons/system-analyst.svg" alt="jobhub" /></figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">System <br>Analyst</a></h5>
                        <p class="text-center text-stroke-40 mt-20">236 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp">
                        <div class="text-center">
                            <a href="job-grid.html">
                                <figure><img src="assets/imgs/theme/icons/business-development.svg" alt="jobhub" />
                                </figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">Digital<br> Designer</a></h5>
                        <p class="text-center text-stroke-40 mt-20">56 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="text-center">
                            <a href="job-grid.html">
                                <figure><img src="assets/imgs/theme/icons/proof-reading.svg" alt="jobhub" /></figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">Market <br>Research</a></h5>
                        <p class="text-center text-stroke-40 mt-20">168 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="text-center card-img">
                            <a href="job-grid.html">
                                <figure>
                                    <img src="assets/imgs/theme/icons/testing.svg" alt="jobhub" />
                                </figure>
                            </a>
                        </div>
                        <h5 class="text-center mt-20 card-heading"><a href="job-grid.html">Human<br> Resource</a></h5>
                        <p class="text-center text-stroke-40 mt-20">628 Available Vacancy</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card-grid hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <div class="text-center mt-15">
                            <h3>18,265+</h3>
                        </div>
                        <p class="text-center mt-30 text-stroke-40">Jobs are waiting for you</p>
                        <div class="text-center mt-30">
                            <div class="box-button-shadow"><a href="job-grid.html" class="btn btn-default">Explore
                                    more</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box  mt-md-40">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp">Upcoming Training</h2>
                    <p class="text-md-lh28 color-black-5wow animate__animated animate__fadeInUp" data-wow-delay=".1s">6
                        new
                        opportunities posted today!</p>
                </div>
                <div class="col-lg-6 col-md-5 text-lg-end text-start">
                    <a href="{{ route('course-grid') }}"
                        class="btn btn-border icon-chevron-right wow animate__animated animate__fadeInUp hover-up mt-15"
                        data-wow-delay=".1s">View more</a>
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
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp">Upcoming Jobs</h2>
                    <p class="text-md-lh28 color-black-5wow animate__animated animate__fadeInUp" data-wow-delay=".1s">6
                        new
                        opportunities posted today!</p>
                </div>
                <div class="col-lg-6 col-md-5 text-lg-end text-start">
                    <a href="{{ route('job-grid') }}"
                        class="btn btn-border icon-chevron-right wow animate__animated animate__fadeInUp hover-up mt-15"
                        data-wow-delay=".1s">View more</a>
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


    <section class="section-box mt-20 mt-md-50">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7 col-md-7">
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp hover-up" data-wow-delay=".1s">
                        News</h2>
                    <p class="text-md-lh28 color-black-5 wow animate__animated animate__fadeInUp hover-up"
                        data-wow-delay=".1s">Latest News & Events</p>
                </div>
                <div class="col-lg-5 col-md-5 text-lg-end text-start">
                    <a href="{{ route('news-list') }}"
                        class="btn btn-border icon-chevron-right wow animate__animated animate__fadeInUp hover-up mt-15"
                        data-wow-delay=".1s">View more</a>
                </div>
            </div>
            <div class="row mt-20">
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3">
                        <div class="swiper-wrapper pb-70 pt-5">
                            @foreach ($news as $item)
                                <div class="swiper-slide">
                                    <div class="card-grid-3 hover-up">

                                        <div class="text-center card-grid-3-image">
                                            <a href="/detail-news/{{ base64_encode($item->id) }}">
                                                <div class="imgGrid-container">
                                                    <figure><img class="imgGrid"
                                                            src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($item->file ?? '')) }}" />
                                                    </figure>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-block-info mt-10">

                                            <div class="row">
                                                <div class="col-lg-6 col-6 text-start">
                                                    <span>{{ $item->category }}</span>
                                                </div>
                                                <div class="col-lg-6 col-6 text-end">
                                                    <span><span
                                                            class="card-time">{{ \Carbon\Carbon::parse($item->implementation_date)->format('d M Y') }}</span></span>
                                                </div>
                                            </div>
                                            <h5 class="mt-15 heading-md "><a
                                                    href="/detail-news/{{ base64_encode($item->id) }}">{{ $item->title }}</a>
                                            </h5>
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
                <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp hover-up" data-wow-delay=".1s">
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
    </section>




    <section class="section-box mt-40">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-4">
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp">Video</h2>
                </div>

            </div>
            <div class="mt-20">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="row">
                            @foreach ($yotube as $valyotube)
                                @if ($valyotube->id_category == 30)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card-grid-2-images">
                                            <a href="video-page.html">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" height="240px;" width="420px;"
                                                        src="{{ $valyotube->url }}"
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
    </section>

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
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
    </script>
@endsection
