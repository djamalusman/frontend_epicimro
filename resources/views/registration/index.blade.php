@extends('template1.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <main class="main">
        <section class="section-box mt-50 mb-70 bg-patern">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="content-job-inner">
                            <div class="mt-40 pr-50 text-md-lh28 wow animate__animated animate__fadeInUp">
                                <h1>JOIN US</h1>
                            </div>
                            <div class="mt-40 pr-50 text-md-lh28 wow animate__animated animate__fadeInUp">
                                <h1>BECOME A TRAINER</h1>
                            </div>
                            <div class="mt-40">
                                <div class="box-button-shadow wow animate__animated animate__fadeInUp"><a
                                        href="{{ $register->item_link }}" target="_blank"
                                        class="btn btn-default">REGISTER</a></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="box-image-job">
                            <figure class=" wow animate__animated animate__fadeIn"><img alt="jobhub"
                                    src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($register->item_file_2 ?? '')) }}" />
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
