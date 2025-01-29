@extends('template2.layouts.app')
@section('title')
    Job
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
          <h1>Profile</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
          </div>
        </div>
        <div class="section-body">
          <h2 class="section-title">Hi, {{$data['getdtUserClient']->name}} {{$data['getdtUserClient']->lastname}}</h2>
          <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
              <div class="card profile-widget">
                <div class="profile-widget-header">                     
                  {{-- <img alt="image" src="{{ asset('assets2/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                   <img src="{{ asset('http://127.0.0.1:8000/public/storage/' . ($getdataDetail->file ?? '')) }}"> --}}
                   <img id="user-photo" src="{{ asset('assets2/img/avatar/avatar-1.png') }}" alt="User Photo" width="150">

                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Job</div>
                        <div class="profile-widget-item-value">{{$data['applyJobCount']}}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Training</div>
                        <div class="profile-widget-item-value">{{$data['applyTrainingCount']}}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Total</div>
                        <div class="profile-widget-item-value">{{$data['totalTransaksi']}}</div>
                      </div>
                  </div>
                </div>
                <div class="profile-widget-description">
                  <div class="profile-widget-name">{{$data['getdtUserClient']->name}} {{$data['getdtUserClient']->lastname}} <div class="text-muted d-inline font-weight-normal"></div></div>
                  <?php echo $data['getdtUserClient']->bio; ?>
                </div>
                
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
              <div class="card">
                <form method="post" class="needs-validation" novalidate="" id="editProfileForm">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">applyJobCount
                        <div class="form-group col-md-6 col-12">
                          <label>First Name</label>
                          <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Last Name</label>
                          <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>
                      </div>
                      <div class="row">                               
                        <div class="form-group col-md-6 col-12">
                          <label>Password</label>
                          <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Upload Foto</label>
                          <input type="file" name="photo" class="form-control">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Email</label>
                          <input type="email" disabled class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Phone</label>
                          <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Bio</label>
                          <textarea class="form-control summernote-simple" id="bio" name="bio"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                  
              </div>
            </div>
          </div>
        </div>
      </section>
      <script>
        document.getElementById("editProfileForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch('{{ route("updatedtuser") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Profile updated successfully!");
                    getData(); // Ambil data terbaru
                } else {
                    alert(data.message); // Jika tidak ada perubahan, tampilkan pesan
                }
            })
            .catch(error => console.error("Error:", error));
        });

        
        // Fungsi untuk mengambil data terbaru
        function getData() {
            fetch('{{ route("getdtuserclient") }}') // Ambil data dari API
                .then(response => response.json()) // Ubah ke JSON
                .then(data => {
                    // Isi form dengan data dari server
                    document.getElementById("firstname").value = data.firstname || "";
                    document.getElementById("lastname").value = data.lastname || "";
                    document.getElementById("email").value = data.email || "";
                    document.getElementById("phone").value = data.phone || "";
                    // document.getElementById("bio").value = data.bio || "";
                    document.getElementById("password").value = data.password || "";
                    let bioElement = document.getElementById("bio");
                    if (bioElement) {
                        bioElement.value = data.bio || ""; // Set nilai dalam textarea
                    }

                    // Jika menggunakan Summernote, gunakan API Summernote untuk mengisi bio
                    if ($('.summernote-simple').length > 0) {
                        $('.summernote-simple').summernote('code', data.bio || "");
                    }
                    // Update gambar profil
                    let userPhoto = document.getElementById("user-photo");
                    if (userPhoto) {
                        userPhoto.src = data.photo; // Set URL gambar
                    }
                })
                .catch(error => console.error("Error fetching data:", error)); // Handle error
        }

        // Panggil getData saat halaman pertama kali dimuat
        document.addEventListener("DOMContentLoaded", function() {
            getData();
        });

        </script>
        
    @push('page-specific-scripts')
        <script type="text/javascript">
            window.history.forward(1);
        </script>
    @endpush
@endsection
