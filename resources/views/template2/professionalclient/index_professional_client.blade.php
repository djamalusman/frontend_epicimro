@extends('template2.layouts.app') @section('title')
    Profesional Patner
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
            <h1>Profesional Patner</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Apply</a></div>
                <div class="breadcrumb-item"><a href="#">Training Profesional</a></div>
                <div class="breadcrumb-item">Profesional Patner</div>
            </div>
        </div>

        <div class="section-body">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-footer text-right">
                                <a href="{{'/viewstoreproftrainer'}}" class="btn btn-primary">Cretae</a>
                                <button hidden class="btn btn-primary" type="reset">Filter</button>
                              </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Profesional Patner</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Background Pendidikan</th>
                                            <th>Jenjang Pendidikan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    function loadData() {
        $.ajax({
            url: '/get-tasksprofTraining', // URL API dari Laravel
            method: 'GET', // Metode HTTP GET
            dataType: 'json', // Format data JSON
            success: function(response) {
                $('#table-1 tbody').empty(); // Kosongkan tabel sebelum mengisi ulang

                if (response.data && response.data.length > 0) {
                    $.each(response.data, function(index, task) {
                        var row = '<tr>';
                        row += '<td class="text-center">' + (index + 1) + '</td>'; // Menampilkan nomor urut
                        row += '<td>' + (task.namarof_training ?? '-') + '</td>';
                        row += '<td>' + (task.name ?? '-') + ' ' + (task.lastname ?? '-') + '</td>';
                        
                        row += '<td>' + (task.email ?? '-') + '</td>';
                        row += '<td>' + (task.phone ?? '-') + '</td>';
                        row += '<td>' + (task.namabgroudneducation ?? '-') + '</td>';
                        row += '<td>' + (task.namaeducation ?? '-') + '</td>';
                        row += '<td>';
                        row += '<a href="/vieweditprof/' + task.idproftraining + '" class="btn btn-primary btn-sm">Edit</a>';
                        row += '</td>';
                        row += '</tr>';

                        $('#table-1 tbody').append(row);
                    });
                } else {
                    $('#table-1 tbody').append('<tr><td colspan="7" class="text-center">No data available</td></tr>');
                }
            },
            error: function() {
                alert('Gagal memuat data');
            }
        });
    }

    // Memuat data pertama kali saat halaman dibuka
    loadData();
});

    </script>
    @push('page-specific-scripts')
        <script type="text/javascript">
            window.history.forward(1);
        </script>
    @endpush
@endsection
