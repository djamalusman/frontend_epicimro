<style>
    /* Container grid */
    .card-grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    /* Ensures all card titles have the same height */
    .card-title {
        min-height: 50px;
        /* Adjust this value based on your layout */
        display: flex;
        align-items: baseline;
        /* Aligns the text from the bottom */
    }

    /* Limit card title to 2 lines and show ellipsis if overflow */
    .card-title {
        min-height: 50px;
        display: flex;
        align-items: baseline;
        font-family: 'Open Sans';
        font-weight: bold;
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
    }

    .card-block-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
    }


    .card-title-certificate {
        min-height: 30px;
        display: flex;
        align-items: baseline;
    }

    /* .btn-default {
        background-color: #8e7dff;

        color: white;

        line-height: 1px;
    } */
</style>

<div class="card-grid-container">
    @foreach ($data as $value)
        <div class="card-grid-2 hover-up">
            <div class="text-center card-grid-2-image">
                <a href="/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}">
                    <div class="imgGrid-container">
                        <figure>
                            @if ( $value->fileold !="frontend")
                                <a href="/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}">
                                    <img class="imgGrid"
                                    src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->image_path ?? '')) }}" />
                            
                                </a>
                            @else
                            <a href="/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}">
                              
                                <img src="{{ asset('/storage/' . ($value->image_path ?? '')) }}">
                        
                            </a>
                            
                            @endif
                            
                        </figure>
                    </div>
                </a>
            </div>
            <div class="card-block-info">



                <div class="mt-10" style="color:black">
                    <span class="fa fa-graduation-cap"></span> &nbsp;&nbsp;{{ $value->cetificate_type }}
                </div>
                <div class="card-title mt-10 text-light"
                    style="font-family: 'Open Sans'; font-weight: 520; font-size: 16px;">
                    <a
                        href="/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}">{{ $value->traning_name }}</a>
                </div>

                <div class="mt-10" style="color:black;font-family: 'Open Sans' ;font-weight:520;font-size: 16px;">
                    {{ $value->company_name }}
                </div>

                <div class="mt-10">
                    <h6 class="mt-5" style="color:black;font-family: 'Open Sans';font-weight;font-size: 16px;">
                        {{ $value->category }}</h6>

                </div>

                {{-- <div class="mt-10" style="color:black;font-family: 'Open Sans'; font-weight; font-size: 16px;">
                    <span class="fi-rr-marker"> &nbsp;&nbsp;{{ $value->nama_provinsi }}</span>
                </div> --}}
                <div class="mt-10">
                    <span class="fi-rr-marker" style="color:rgb(0, 0, 0);">
                        &nbsp;&nbsp;{{ $value->nama_provinsi }},{{ $value->lokasi }}</span>
                </div>
                <div class="mt-10">
                    <span class="fi-rr-clock" style="color:black;">
                        &nbsp;&nbsp;{{ \Carbon\Carbon::parse($value->startdate)->format('d M Y') }}</span>
                </div>
                <div class="card-2-bottom mt-10" hidden>
                    <h6 style="color:black;font-family: 'Open Sans';font-weight;font-size: 16px;">
                        {{ $value->registrationfee }}</h6>
                </div>
                <div class="mt-15" hidden>
                    <a href="/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}">
                        <h6 style="color:black;font-family: 'Open Sans';font-weight;font-size: 16px;">
                            {{ $value->namaonlineofline }}</h6>
                    </a>
                </div>
                <div class="card-2-bottom mt-5">
                    <div class="text-end">

                        @if ($value->link_pendaftaran == null)
                            <button class="btn btn-default wow animate__ animate__fadeInUp hover-up mt-15 animated"
                                data-wow-delay=".1s"
                                style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;font-size:14px;"
                                onclick="window.location.href='/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}'">View
                                more</button>
                        @else
                            <button class="btn btn-default wow animate__ animate__fadeInUp hover-up mt-15 animated"
                                data-wow-delay=".1s"
                                style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;font-size:14px;"
                                onclick="window.location.href='/detail-course/{{ base64_encode($value->id) }}/{{ Str::slug($value->traning_name) }}'">View
                                more</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
