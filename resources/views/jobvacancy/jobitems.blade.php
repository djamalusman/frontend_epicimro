<!-- resources/views/courses/_course_items.blade.php -->
@foreach($courses as $course)
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card shadow h-100">
            <!-- Image -->
            <img src="https://admin.trainingkerja.com/public/storage/{{ $course->file ?? '' }}" class="card-img-top" alt="course image">
            <!-- Card body -->
            <div class="card-body pb-0">
                <!-- Badge and favorite -->
                <ul class="list-inline mb-0">
                    <li ><h6>{{ $course->vacancy_name }}</h6></li>
                </ul>
                <ul class="list-inline mb-0">
                    <li ><h6>{{ $course->location }}</h6></li>
                </ul>
                <ul class="list-inline mb-0">
                    <a href="#" class="badge bg-purple bg-opacity-10 text-purple">{{ $course->status_vacancy }}</a>
                    
                </ul>
                <!-- Title -->
                
            </div>
            <!-- Card footer -->
            <div class="card-footer pt-0 pb-3">
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-1"></i>{{ $course->duration }}</span>
                    <span class="h6 fw-light mb-0"><i class="fas fa-table text-orange me-1"></i>{{ $course->lectures }} lectures</span>
                </div>
            </div>
        </div>
    </div>
@endforeach
