@foreach($news as $item)
    <div class="swiper-slide">
        <div class="card-grid-3 hover-up">
            <div class="text-center card-grid-3-image">
                <a href="blog-single.html">
                    <img class="imgGrid" src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->image_path ?? '')) }}" />
                </a>
            </div>
            <div class="card-block-info mt-10">

                <div class="row">
                    <div class="col-lg-6 col-6 text-start">
                        <span>{{$item->category}}</span>
                    </div>
                    <div class="col-lg-6 col-6 text-end">
                        <span><span class="card-time">{{ \Carbon\Carbon::parse($item->implementation_date)->format('d M Y') }}</span></span>
                    </div>
                </div>
                <h5 class="mt-15 heading-md"><a href="blog-single.html">{{$item->title}}</a></h5>
            </div>
        </div>
    </div>
@endforeach
