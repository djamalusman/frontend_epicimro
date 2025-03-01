@foreach ($data as $value)
    <!-- Item job -->
    <div class="card-job hover-up wow animate__animated animate__fadeIn">
        <div class="card-job-top">
            <div class="card-job-top--image">
                <figure> <img class="imgGrid" src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->image_path ?? '')) }}" /></figure>
            </div>
            <div class="card-job-top--info">
                <h6 class="card-job-top--info-heading"><a href="/detail-course/{{base64_encode($value->id)}}">{{$value->traning_name}}</a></h6>
                <div class="row  mt-10" >
                    <div class="col-lg-7" style="font-size:15px; ">
                        <span class="card-job-top--type-job text-sm"> {{$value->category}} | {{$value->typeonlineofline}}</span>
                        <span class="card-job-top--type-job text-sm fa fa-graduation-cap "> {{$value->cetificate_type}}</span>
                        <span class="card-job-top--type-job text-sm"><i class="fi-rr-marker"></i> {{$value->nama_provinsi}}, {{$value->lokasi}}</span>
                        <span class="card-job-top--type-job text-sm"><i class="fi-rr-clock"></i>Closed at : {{ \Carbon\Carbon::parse($value->enddate)->format('d M Y') }}</span>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <br>
                        <br>
                        <span class="card-job-top--price">{{$value->registrationfee}}<span></span></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End item job -->
@endforeach
