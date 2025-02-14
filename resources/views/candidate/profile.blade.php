@extends('layouts.app')

@section('title', 'Profile Candidate')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Profile Candidate</h4>
                </div>
                <div class="card-body">
                    <!-- Informasi Pribadi -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <img src="{{ $user->photo ? asset($user->photo) : asset('assets/images/default-avatar.png') }}" 
                                 class="img-fluid rounded-circle" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-9">
                            <h5>{{ $user->name }} {{ $user->lastname }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                            <p>{{ $user->bio ?? 'No bio available' }}</p>
                        </div>
                    </div>

                    <!-- Pengalaman Kerja -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pengalaman Kerja</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                                <i class="fas fa-plus"></i> Tambah Pengalaman
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="experienceList">
                                @if($experiences->isEmpty())
                                    <div class="alert alert-info">
                                        Belum ada pengalaman kerja yang ditambahkan.
                                    </div>
                                @else
                                    @foreach($experiences as $experience)
                                        <div class="card mb-3 experience-card" data-id="{{ $experience->id }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h5 class="card-title mb-1">{{ $experience->position }}</h5>
                                                        <h6 class="card-subtitle mb-2">
                                                            <a href="#" class="text-muted text-decoration-none">{{ $experience->company }}</a>
                                                        </h6>
                                                        <p class="card-text text-muted mb-2" style="font-size: 0.9rem;">
                                                            {{ $experience->start_date ? $experience->start_date->format('M Y') : '-' }} - 
                                                            {{ $experience->is_current ? 'Saat ini' : ($experience->end_date ? $experience->end_date->format('M Y') : '-') }}
                                                            @if($experience->start_date)
                                                                @php
                                                                    $endDate = $experience->is_current ? now() : ($experience->end_date ?? now());
                                                                    $diff = $experience->start_date->diff($endDate);
                                                                    $years = $diff->y;
                                                                    $months = $diff->m;
                                                                    $duration = [];
                                                                    if($years > 0) $duration[] = $years . ' tahun';
                                                                    if($months > 0) $duration[] = $months . ' bulan';
                                                                @endphp
                                                                ({{ implode(' ', $duration) }})
                                                            @endif
                                                        </p>
                                                        @if($experience->description)
                                                            <p class="card-text">{{ $experience->description }}</p>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-link edit-experience" 
                                                                data-id="{{ $experience->id }}"
                                                                data-position="{{ $experience->position }}"
                                                                data-company="{{ $experience->company }}"
                                                                data-start-date="{{ $experience->start_date ? $experience->start_date->format('Y-m-d') : '' }}"
                                                                data-end-date="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}"
                                                                data-is-current="{{ $experience->is_current ? '1' : '0' }}"
                                                                data-description="{{ $experience->description }}">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-link text-danger delete-experience" 
                                                                data-id="{{ $experience->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Pendidikan -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pendidikan</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#educationModal">
                                <i class="fas fa-plus"></i> Tambah Pendidikan
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="educationList">
                                @foreach($educations as $education)
                                <div class="education-item mb-3" data-id="{{ $education->id }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="mb-1">{{ $education->school_name }}</h5>
                                            <p class="mb-1">{{ $education->degree }} - {{ $education->field_of_study }}</p>
                                            <p class="text-muted">
                                                {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - 
                                                {{ $education->is_current ? 'Sekarang' : \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                                            </p>
                                            @if($education->description)
                                            <p>{{ $education->description }}</p>
                                            @endif
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-primary" onclick="editEducation({{ $education->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteEducation({{ $education->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Sertifikasi -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sertifikasi</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#certificationModal">
                                <i class="fas fa-plus"></i> Tambah Sertifikasi
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="certificationList">
                                @foreach($certifications as $certification)
                                <div class="certification-item mb-3" data-id="{{ $certification->id }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="mb-1">{{ $certification->name }}</h5>
                                            <p class="mb-1">{{ $certification->issuing_organization }}</p>
                                            <p class="text-muted">
                                                Diterbitkan: {{ \Carbon\Carbon::parse($certification->issue_date)->format('M Y') }}
                                                @if($certification->has_expiration && $certification->expiration_date)
                                                <br>Kadaluarsa: {{ \Carbon\Carbon::parse($certification->expiration_date)->format('M Y') }}
                                                @endif
                                            </p>
                                            @if($certification->credential_id)
                                            <p class="mb-1">ID Kredensial: {{ $certification->credential_id }}</p>
                                            @endif
                                            @if($certification->description)
                                            <p>{{ $certification->description }}</p>
                                            @endif
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-primary" onclick="editCertification({{ $certification->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteCertification({{ $certification->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengalaman -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceModalLabel">Tambah Pengalaman Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="experienceForm">
                    @csrf
                    <input type="hidden" name="experience_id" id="experience_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Posisi</label>
                                <input type="text" name="position" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Perusahaan</label>
                                <input type="text" name="company" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control end-date">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input current-job" id="currentJob">
                                    <label class="form-check-label" for="currentJob">Masih Bekerja</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Deskripsi Pekerjaan</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveExperience">Simpan</button>
            </div>
        </div>
    </div>
</div>
 <!-- Modal Pendidikan -->
 <div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educationModalLabel">Tambah Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="educationForm">
                    <input type="hidden" id="educationId">
                    <div class="mb-3">
                        <label for="school_name" class="form-label">Nama Sekolah/Universitas</label>
                        <input type="text" class="form-control" id="school_name" name="school_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="degree" class="form-label">Gelar</label>
                        <input type="text" class="form-control" id="degree" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="field_of_study" class="form-label">Bidang Studi</label>
                        <input type="text" class="form-control" id="field_of_study" name="field_of_study" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_current" name="is_current">
                            <label class="form-check-label" for="is_current">
                                Masih Bersekolah
                            </label>
                        </div>
                    </div>
                    <div class="mb-3" id="end_date_group">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveEducation()">Simpan</button>
            </div>
        </div>
    </div>
  </div>

                    <!-- Modal Sertifikasi -->
<div class="modal fade" id="certificationModal" tabindex="-1" aria-labelledby="certificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificationModalLabel">Tambah Sertifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="certificationForm">
                    <input type="hidden" id="certificationId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Sertifikasi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="issuing_organization" class="form-label">Organisasi Penerbit</label>
                        <input type="text" class="form-control" id="issuing_organization" name="issuing_organization" required>
                    </div>
                    <div class="mb-3">
                        <label for="credential_id" class="form-label">ID Kredensial (Opsional)</label>
                        <input type="text" class="form-control" id="credential_id" name="credential_id">
                    </div>
                    <div class="mb-3">
                        <label for="issue_date" class="form-label">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="has_expiration" name="has_expiration">
                            <label class="form-check-label" for="has_expiration">
                                Memiliki Tanggal Kadaluarsa
                            </label>
                        </div>
                    </div>
                    <div class="mb-3" id="expiration_date_group">
                        <label for="expiration_date" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveCertification()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Handle "Masih Bekerja" checkbox
    $('.current-job').change(function() {
        var endDateInput = $('.end-date');
        if (this.checked) {
            endDateInput.val('').prop('disabled', true);
        } else {
            endDateInput.prop('disabled', false);
        }
    });

    // Handle edit button click
    $(document).on('click', '.edit-experience', function() {
        var btn = $(this);
        var modal = $('#addExperienceModal');
        
        // Set form values
        modal.find('#experience_id').val(btn.data('id'));
        modal.find('input[name="position"]').val(btn.data('position'));
        modal.find('input[name="company"]').val(btn.data('company'));
        modal.find('input[name="start_date"]').val(btn.data('start-date'));
        
        // Handle current job and end date
        var isCurrent = btn.data('is-current') == '1';
        modal.find('.current-job').prop('checked', isCurrent);
        
        var endDateInput = modal.find('input[name="end_date"]');
        if (isCurrent) {
            endDateInput.val('').prop('disabled', true);
        } else {
            endDateInput.val(btn.data('end-date')).prop('disabled', false);
        }
        
        modal.find('textarea[name="description"]').val(btn.data('description'));
        
        // Update modal title
        modal.find('.modal-title').text('Edit Pengalaman Kerja');
        
        // Show modal
        modal.modal('show');
    });

    // Reset modal on close
    $('#addExperienceModal').on('hidden.bs.modal', function() {
        var modal = $(this);
        modal.find('#experience_id').val('');
        modal.find('form')[0].reset();
        modal.find('.end-date').prop('disabled', false);
        modal.find('.modal-title').text('Tambah Pengalaman Kerja');
    });

    // Form submission
    $('#saveExperience').click(function() {
        var form = $('#experienceForm');
        var formData = new FormData(form[0]);
        var experienceId = $('#experience_id').val();
        
        // Handle current job checkbox
        if ($('.current-job').is(':checked')) {
            formData.append('is_current', '1');
            formData.set('end_date', '');
        }

        var url = experienceId 
            ? `/profile/experience/${experienceId}` 
            : '/profile/experience';

        $.ajax({
            url: url,
            type: experienceId ? 'PUT' : 'POST',
            data: Object.fromEntries(formData),
            success: function(response) {
                // Close modal
                $('#addExperienceModal').modal('hide');
                
                // Reset form
                form[0].reset();
                $('.end-date').prop('disabled', false);
                
                // Format dates for display
                var startDate = new Date(response.data.start_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                var endDate = response.data.is_current ? 'Saat ini' : 
                             (response.data.end_date ? new Date(response.data.end_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) : '-');
                
                // Update atau tambah experience ke list
                var experienceHtml = `
                    <div class="card mb-3 experience-card" data-id="${response.data.id}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title mb-1">${response.data.position}</h5>
                                    <h6 class="card-subtitle mb-2">
                                        <a href="#" class="text-muted text-decoration-none">${response.data.company}</a>
                                    </h6>
                                    <p class="card-text text-muted mb-2" style="font-size: 0.9rem;">
                                        ${startDate} - ${endDate}
                                    </p>
                                    <p class="card-text">${response.data.description || ''}</p>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-link edit-experience" 
                                            data-id="${response.data.id}"
                                            data-position="${response.data.position}"
                                            data-company="${response.data.company}"
                                            data-start-date="${response.data.start_date}"
                                            data-end-date="${response.data.end_date || ''}"
                                            data-is-current="${response.data.is_current ? '1' : '0'}"
                                            data-description="${response.data.description || ''}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-link text-danger delete-experience" 
                                            data-id="${response.data.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                if (experienceId) {
                    // Update existing card
                    $(`.experience-card[data-id="${experienceId}"]`).replaceWith(experienceHtml);
                } else {
                    // Remove "No experience" message if present
                    if ($('#experienceList .alert').length) {
                        $('#experienceList .alert').remove();
                    }
                    // Add new card
                    $('#experienceList').prepend(experienceHtml);
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pengalaman kerja berhasil disimpan'
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menyimpan data'
                });
            }
        });
    });

    // Handle delete experience
    $(document).on('click', '.delete-experience', function() {
        const id = $(this).data('id');
        const card = $(this).closest('.experience-card');
        
        Swal.fire({
            title: 'Anda yakin?',
            text: "Pengalaman kerja ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/profile/experience/delete/${id}`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        card.fadeOut(300, function() {
                            $(this).remove();
                            if ($('#experienceList .experience-card').length === 0) {
                                $('#experienceList').html(`
                                    <div class="alert alert-info">
                                        Belum ada pengalaman kerja yang ditambahkan.
                                    </div>
                                `);
                            }
                        });
                        
                        Swal.fire(
                            'Terhapus!',
                            'Pengalaman kerja telah dihapus.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Gagal menghapus pengalaman kerja.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Education Functions
    function openEducationModal() {
        $('#educationModalLabel').text('Tambah Pendidikan');
        $('#educationForm')[0].reset();
        $('#educationId').val('');
        $('#educationModal').modal('show');
    }

    function editEducation(id) {
        const education = @json($educations->keyBy('id'));
        const educationData = education[id];
        
        $('#educationModalLabel').text('Edit Pendidikan');
        $('#educationId').val(id);
        $('#school_name').val(educationData.school_name);
        $('#degree').val(educationData.degree);
        $('#field_of_study').val(educationData.field_of_study);
        $('#start_date').val(educationData.start_date);
        $('#end_date').val(educationData.end_date);
        $('#is_current').prop('checked', educationData.is_current);
        $('#description').val(educationData.description);
        
        if (educationData.is_current) {
            $('#end_date_group').hide();
        } else {
            $('#end_date_group').show();
        }
        
        $('#educationModal').modal('show');
    }

    function saveEducation() {
        const id = $('#educationId').val();
        const formData = {
            school_name: $('#school_name').val(),
            degree: $('#degree').val(),
            field_of_study: $('#field_of_study').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
            is_current: $('#is_current').is(':checked'),
            description: $('#description').val()
        };
        
        const url = id ? `/education/${id}` : '/education';
        const method = id ? 'PUT' : 'POST';
        
        $.ajax({
            url: url,
            method: method,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#educationModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message
                }).then(() => {
                    window.location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.error || 'Terjadi kesalahan'
                });
            }
        });
    }

    function deleteEducation(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pendidikan akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/education/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.error || 'Terjadi kesalahan'
                        });
                    }
                });
            }
        });
    }

    // Certification Functions
    function openCertificationModal() {
        $('#certificationModalLabel').text('Tambah Sertifikasi');
        $('#certificationForm')[0].reset();
        $('#certificationId').val('');
        $('#certificationModal').modal('show');
    }

    function editCertification(id) {
        const certification = @json($certifications->keyBy('id'));
        const certificationData = certification[id];
        
        $('#certificationModalLabel').text('Edit Sertifikasi');
        $('#certificationId').val(id);
        $('#name').val(certificationData.name);
        $('#issuing_organization').val(certificationData.issuing_organization);
        $('#credential_id').val(certificationData.credential_id);
        $('#issue_date').val(certificationData.issue_date);
        $('#expiration_date').val(certificationData.expiration_date);
        $('#has_expiration').prop('checked', certificationData.has_expiration);
        $('#description').val(certificationData.description);
        
        if (certificationData.has_expiration) {
            $('#expiration_date_group').show();
        } else {
            $('#expiration_date_group').hide();
        }
        
        $('#certificationModal').modal('show');
    }

    function saveCertification() {
        const id = $('#certificationId').val();
        const formData = {
            name: $('#name').val(),
            issuing_organization: $('#issuing_organization').val(),
            credential_id: $('#credential_id').val(),
            issue_date: $('#issue_date').val(),
            expiration_date: $('#expiration_date').val(),
            has_expiration: $('#has_expiration').is(':checked'),
            description: $('#description').val()
        };
        
        const url = id ? `/certification/${id}` : '/certification';
        const method = id ? 'PUT' : 'POST';
        
        $.ajax({
            url: url,
            method: method,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#certificationModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message
                }).then(() => {
                    window.location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.error || 'Terjadi kesalahan'
                });
            }
        });
    }

    function deleteCertification(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data sertifikasi akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/certification/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.error || 'Terjadi kesalahan'
                        });
                    }
                });
            }
        });
    }

    // Event Handlers
    $(document).ready(function() {
        $('#is_current').change(function() {
            if (this.checked) {
                $('#end_date_group').hide();
                $('#end_date').val('');
            } else {
                $('#end_date_group').show();
            }
        });
        
        $('#has_expiration').change(function() {
            if (this.checked) {
                $('#expiration_date_group').show();
            } else {
                $('#expiration_date_group').hide();
                $('#expiration_date').val('');
            }
        });
    });
});
</script>
@endsection