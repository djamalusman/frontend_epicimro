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
        min-height: 50px; /* Adjust this value based on your layout */
        display: flex;
        align-items: baseline; /* Aligns the text from the bottom */
    }

    /* Limit card title to 2 lines and show ellipsis if overflow */
    .card-title {
        min-height: 50px;
        display: flex;
        align-items: baseline;
        font-family: 'Montserrat';
        font-weight: bold;
        font-size: 20px;
        line-height: 1.2; /* Line height to control spacing between lines */
        max-height: 2.4em; /* Limiting to 2 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits text to 2 lines */
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

</style>

    <div class="card-grid-container">
        @foreach($data as $value)

        <div class="card-grid-2 hover-up">
            <div class="text-center card-grid-2-image">
                <a href="/detail-course/{{$value->id}}">
                    <div class="imgGrid-container">
                        <figure>
                            <a href="/detail-course/{{base64_encode($value->id)}}">
                                <img class="imgGrid" src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->image_path ?? '')) }}" />
                            </a>
                        </figure>
                    </div>
                </a>
            </div>
            <div class="card-block-info">

                <div class="card-title-certificate">
                    <i class="fa-solid fa-graduation-cap text-black"></i> &nbsp;&nbsp;&nbsp; <h6 style="font-size: 16px;color:black" >{{$value->cetificate_type}}</h6>
                </div>
                <div class="card-title mt-10">
                    <a href="/detail-course/{{base64_encode($value->id)}}">{{$value->traning_name}}</a>
                </div>

                <div class="mt-10">
                    <h6 class="mt-5" sDDfont-family: 'Montserrat';font-weight;font-size: 14px;">{{$value->category}}</h6>
                    <h5 class=" mt-10" style="color:blueviolet;font-family: 'Montserrat';font-weight;font-size: 17px;">{{$value->company_name}}</h5>
                </div>
                <div class="mt-10">
                    <span class="fi-rr-marker" style="color:blueviolet;"> {{$value->nama_provinsi}},{{$value->lokasi}}</span>
                </div>
                <div class="mt-10">
                    <span class="fi-rr-clock">  {{ \Carbon\Carbon::parse($value->startdate)->format('d M Y') }}</span>
                </div>
                <div class="card-2-bottom mt-10">
                    <h6 style="color:#black;font-family: 'Montserrat';font-weight;font-size: 18px;">{{$value->registrationfee}}</h6>
                </div>
                <div class="mt-15">
                    <a href="/detail-course/{{base64_encode($value->id)}}">
                        <h6 style="color:black;font-family: 'Montserrat';font-weight;font-size: 18px;">{{$value->namaonlineofline}}</h6>
                    </a>
                </div>
                <div class="card-2-bottom mt-5">
                    <div class="text-end">
                        @if ($value->link_pendaftaran == null)
                            <button class="btn btn-border wow animate__ animate__fadeInUp hover-up mt-15 animated"
                                    data-wow-delay=".1s"
                                    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;"
                                    onclick="handleRegisterClick()">Register</button>
                        @else
                            <button class="btn btn-border wow animate__ animate__fadeInUp hover-up mt-15 animated"
                                    data-wow-delay=".1s"
                                    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;"
                                    onclick="window.location.href='{{$value->link_pendaftaran}}'">Register</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>