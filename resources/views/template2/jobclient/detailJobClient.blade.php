@extends('template2.layouts.app')
@section('title')
    Detail apply Job
@endsection
@section('content')
    @push('page-specific-css')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('assets2/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets2/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets2/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    @endpush
    <section class="section">
          <div class="section-header">
            <h1>Detail Apply Job Vacancy</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Apply</a></div>
              <div class="breadcrumb-item"><a href="#">Job Vacancy</a></div>
              <div class="breadcrumb-item">Detail Apply Job Vacancy</div>
            </div>
          </div>

          <div class="section-body">
            <div class="card-header" style="background:rgb(255, 255, 255) ">
              <div class="d-flex align-items-center">
                  <img src="{{ asset('http://admin.trainingkerja.com/public/storage/' . ($data['getdtApplyJob']->file  ?? '')) }}"
                      alt="Logo" style="width: 255px; height: 105px; margin-right: 10px;">
                  <div>
                      <h2 class="mb-0">{{ $data['getdtApplyJob']->job_title }}</h2>
                      <small>{{ $data['getdtApplyJob']->companyName }}</small>
                      <br>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                          Lihat deskripsi Training
                      </button>
                  </div>
              </div>
            </div>
          </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Surat Lamaran</label>
                      <textarea id="summernote" class="summernote-simple">{{ $data['getdtApplyJob']->cover_letter }}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Cv</label></br>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{$data['getdtApplyJob']->cv_path}}" placeholder="" aria-label="">
                        <div class="input-group-append">
                          <a href="{{ asset('storage/' . $data['getdtApplyJob']->cv_path) }}" target="_blank" class="btn btn-primary" type="button" rel="noopener noreferrer"> View</a>
                          
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Gaji yang diharapkan</label>
                      <select class="form-control" disabled="">
                        <option>{{ $data['getdtApplyJob']->salary }}</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pendidikan</label>
                      <select class="form-control" disabled="">
                        <option>{{ $data['getdtApplyJob']->education }}</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pengalaman Kerja</label>
                      <select class="form-control" disabled="">
                        <option>{{ $data['getdtApplyJob']->name_experience_level }}</option>
                      </select>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Posisi pekerjaan</label>
                      <input type="text" value="{{ $data['getdtApplyJob']->positionWork }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Nama Perusahaan</label>
                      <input type="text" value="{{ $data['getdtApplyJob']->companyName }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Mulai Bekerja</label>
                      <input type="text" value="{{ $data['getdtApplyJob']->startDateWork }}" readonly class="form-control">
                    </div>
                    @if($data['getdtApplyJob']->stillWork != null && $data['getdtApplyJob']->stillWork != "")
                        <div class="form-group">
                            <label>Status Bekerja</label>
                            <input type="text" value="Masih Bekerja" readonly class="form-control">
                        </div>
                    @else
                        <div class="form-group">
                            <label>Berakhir Bekerja</label>
                            <input type="text" value="{{ $data['getdtApplyJob']->endDateWork }}" readonly class="form-control">
                        </div>
                    @endif

                    <div class="form-group">
                      <label>Keahlian Anda</label>
                        <textarea id="summernotesklill" class="summernote-simple">{{ $data['getdtApplyJob']->writeskill }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <<br>
                  <div class="modal-body">
                      <h5>Jobs description :</h5>
                      <?php echo $data['getdtApplyJob']->job_description; ?>
                      <br>
                      <h5>Skill requirement :</h5>
                      <?php echo $data['getdtApplyJob']->skill_requirment; ?>
                  </div>

              </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script type="text/javascript">
         $(document).ready(function() {
                $('#summernote').summernote({
                    toolbar: false, // Hilangkan toolbar
                    airMode: false, // Pastikan air mode dimatikan
                    disableDragAndDrop: true, // Nonaktifkan drag & drop
                    height: 160, // Sesuaikan tinggi editor
                    callbacks: {
                        onInit: function() {
                            $('#summernote').next('.note-editor').find('.note-editable').attr('contenteditable', false); // Nonaktifkan editing
                        }
                    }
                });
                $('#summernotesklill').summernote({
                    toolbar: false, // Hilangkan toolbar
                    airMode: false, // Pastikan air mode dimatikan
                    disableDragAndDrop: true, // Nonaktifkan drag & drop
                    height: 160, // Sesuaikan tinggi editor
                    callbacks: {
                        onInit: function() {
                            $('#summernotesklill').next('.note-editor').find('.note-editable').attr('contenteditable', false); // Nonaktifkan editing
                        }
                    }
                });
          });


      </script>
    @push('page-specific-scripts')
    
        <script type="text/javascript">
            window.history.forward(1);
        </script>
    @endpush
@endsection
