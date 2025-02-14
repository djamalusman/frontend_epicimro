<style>
    /* Styling untuk card layout */
    .card-grid-2 {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Ensures all cards have the same height */
    }

    /* Gambar dalam card */
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
        /* Rasio aspek 16:9 untuk gambar */
    }

    .imgGrid-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
        /* Sudut gambar melengkung agar sesuai dengan kartu */
    }

    /* Konten di dalam card */
    .card-block-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Judul berita dengan batasan 2 baris */
    .card-news-title {
        min-height: 50px;
        display: flex;
        align-items: baseline;
        font-family: 'Montserrat';
        font-weight: bold;
        font-size: 22px;
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

    /* Gaya untuk link jenis berita */
    .keep-reading a {
        font-size: 14px;
        color: rgb(255, 255, 255);
        border: 1px solid #f05537;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .keep-reading a:hover {
        background-color: #f05537;
        color: #fff;
    }

    .btn-defaults {
        background-color: #f05537;
        font-size: 12px;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        text-decoration: none;
        /* font-weight: bold; */
        margin-right: 10px;
    }
</style>

@foreach ($data as $value)
    <div class="col-lg-4 mb-30">
        <div class="card-grid-2 hover-up wow animate__animated animate__fadeIn" data-wow-delay=".0s">
            <div class="card-grid-2-image">
                <a href="/detail-news/{{ base64_encode($value->id) }}/{{ Str::slug($value->title) }}">
                    <div class="imgGrid-container">
                        <img class="imgGrid"
                            src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($value->file ?? '')) }}" />
                    </div>
                </a>
            </div>
            <div class="card-block-info">
                <div class="card-news-title">
                    <a
                        href="/detail-news/{{ base64_encode($value->id) }}/{{ Str::slug($value->title) }}">{{ $value->title }}</a>
                </div>
                <div class="card-2-bottom mt-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-start mt-20">
                            <a href="/detail-news/{{ base64_encode($value->id) }}/{{ Str::slug($value->title) }}"
                                class="btn btn-defaults" style="color: #fff">{{ $value->jenisBerita }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
