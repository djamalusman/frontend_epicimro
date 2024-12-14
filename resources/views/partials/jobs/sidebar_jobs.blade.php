
    @foreach($trainings as $training)
        <div class="post-list-small-item d-flex" style="border-bottom: 1px solid #e0e0e0; padding-bottom: 15px; margin-bottom: 15px;">
            <figure class="thumb mr-15" style="margin-right: 15px;">
                <a href="/detail-course/{{base64_encode($training->id)}}">
                    <img src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($training->image_path ?? '')) }}"
                    alt="" style="width: 120px; height: 80px; border-radius: 4px;">
                </a>
            </figure>

            <div class="content">
                <a href="/detail-course/{{base64_encode($training->id)}}">
                    <h5 style="font-size: 17px; font-weight: bold; color: #333;">{{$training->traning_name}}</h5>
                </a>
                <div class="post-meta text-muted d-flex justify-content-between align-items-center mb-15" style="font-size: 13px;">
                    <div class="author d-flex align-items-center">
                        <span>{{$training->category}}</span>
                    </div>
                    <div class="date">
                        <span>{{$training->registrationfee}}</span>
                    </div>
                </div>
                <div class="post-meta text-muted d-flex justify-content-between align-items-center" style="font-size: 13px;">
                    <div class="author d-flex align-items-center">
                        <span>Posting at: {{ \Carbon\Carbon::parse($training->startdate)->format('d M Y') }}</span>
                    </div>
                    <div class="date">
                        <span>{{$training->typeonlineofline}}</span>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
