
    @foreach ($data as $value)

        <div class="card-job hover-up wow animate__animated animate__fadeIn">
            <div class="card-job-top">
                <div class="card-job-top--image">
                    <a href="/detail-job/{{base64_encode($value->id)}}">
                        <figure>
                            <img class="imgGrid" src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->file ?? '')) }}" />
                        </figure>
                    </a>
                </div>
                <div class="card-job-top--info">

                    <h6 class="card-job-top--info-heading"><a href="/detail-job/{{base64_encode($value->id)}}">{{ $value->job_title }}</a></h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="/detail-job/{{base64_encode($value->id)}}"> <span class="card-job-top--type-job text-sm"style="font-size: 15px"><h5> {{$value->companyName}}</h5></span></a>

                        </div>

                    </div>
                </div>
                <div class="card-job-top--info">
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="card-job-top--type-job text-sm fi-rr-briefcase "> {{$value->nama_status}}</span>
                            <span class="card-job-top--type-job text-sm fi-rr-briefcase"> {{$value->sector}}</i></span>
                            <span class="card-job-top--type-job text-sm fa fa-graduation-cap "> {{$value->education}}</span>
                            <span class="card-job-top--type-job text-sm"><i class="fi-rr-clock"> </i>{{$value->name_experience_level}}</span>
                            <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i> {{$value->namaprovinsi}}, {{$value->lokasi}}</span>


                        </div>
                    </div>
                </div>
                <div class="card-job-top--info">
                    <div class="row">
                        <div class="col-lg-12">
{{--                            <span class="card-job-top--post-time text-sm"><i class="fi-rr-clock"></i>Posted at : {{ \Carbon\Carbon::parse($value->posted_date)->format('d M Y') }}</span>--}}
                            <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i> {{$value->work_location}}</span>
                            <span class="card-job-top--post-time text-sm"><i class="fi-rr-clock"></i>Closed at : {{ \Carbon\Carbon::parse($value->close_date)->format('d M Y') }}</span>


                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endforeach