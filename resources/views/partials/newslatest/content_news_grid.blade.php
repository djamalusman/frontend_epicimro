@foreach ($data as $value)
 <div class="col-lg-4 col-md-6">
    <div class="card-grid-2 hover-up wow animate__animated animate__fadeIn" data-wow-delay=".0s">
        <div class="text-center card-grid-2-image">
            <a href="job-single.html">
                <figure><img alt="jobhub" src="assets/imgs/jobs/job-1.png" /></figure>
            </a>
            <label class="btn-urgent"> {{$value->jenisBerita}}</label>
        </div>
        <div class="card-block-info">
            <div class="mt-15">
                    <a href="/detail-news/{{$value->id}}" >
                        <span>{{$value->title}}</span>
                    </a>
            </div>
            <div class="mt-15">
                <span class="card-time">Posted at : {{ \Carbon\Carbon::parse($value->implementation_date)->format('d M Y') }}</span>
            </div>
            
        </div>
    </div>
</div>
@endforeach
