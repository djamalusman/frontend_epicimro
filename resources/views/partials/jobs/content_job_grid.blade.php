<style>

    /* Container grid */
    .card-grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    /* Ensures all card titles have the same height */
    .card-title-job-status {
        min-height: 30px;
        display: flex;
        align-items: baseline;
    }

    /* Modifikasi card-title-job-title agar hanya menampilkan maksimal 2 baris dan ellipsis jika lebih */
    .card-title-job-title {
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

    .card-title-job-title-location {
        min-height: 50px;
        display: flex;
        align-items: baseline;
    }

    .card-block-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
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
                                    <img style="height:220px;" class="imgGrid" src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->file ?? '')) }}" />
                                </a>
                            </figure>
                        </div>
                    </a>
                </div>

                <div class="card-block-info">

                    <div class="card-title-job-status">
                        <div class="col-md-1">
                            <span class="fi-rr-briefcase"></span>
                        </div>
                        <div class="col-md-3">
                            <h6 style="color:black;font-family: 'Montserrat';font-weight;font-size: 18px;">{{$value->nama_status}}</h6>
                        </div>
                    </div>
                    <div class="card-title-job-title mt-5">
                        <a href="/detail-job/{{ base64_encode($value->id)}}/{{Str::slug($value->job_title)}}">{{$value->job_title}}</a>
                    </div>

                    <div class="card-title-job-location mt-15">
                        <h6 style="font-family: 'Montserrat';font-weight;font-size: 15px;">
                            <span class="fi-rr-marker" style="color:blueviolet"> {{$value->work_location}}</span>
                        </h6>
                    </div>

                    <div class="mt-10">
                        <a href="/detail-job/{{base64_encode($value->id)}}" class="mt-10">
                            <span style="font-size: 25px"><b style="color:black;font-size: 15px;">{{$value->companyName}}</b></span>
                        </a>
                    </div>
                    <div class="mt-10">
                        <span class="fi-rr-briefcase" style="color:blueviolet"> {{$value->sector}}</span>
                    </div>
                    <div class="mt-10">
                        <span class="fa fa-graduation-cap"></span> {{$value->education}}
                    </div>
                    <div class="mt-10">
                        <span class="fi-rr-clock"> {{$value->name_experience_level}} Tahun</span>
                    </div>
                    <div class="mt-10">
                        <span class="fi-rr-marker"> {{$value->namaprovinsi}}</span>
                    </div>
                    <div class="mt-10">
                        <span class="card-text-price" style="color:black">Salary Range Est.  IDR {{$value->salary}}<span>/{{$value->fee}}</span> </span>
                    </div>

                    <div class="card-2-bottom mt-10">
                        <div class="row">
                            <div class="col-lg-12 col-12 text-end">
                                <span class="fi-rr-clock"> Closed at : {{ \Carbon\Carbon::parse($value->close_date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
