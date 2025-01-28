@extends('template2.layouts.app') @section('title')
    Training
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
            <h1>Data Registrasi Training</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Apply</a></div>
                <div class="breadcrumb-item"><a href="#">Training Course</a></div>
                <div class="breadcrumb-item">Data Registrasi Training</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Nama Training</th>
                                            <th>Status</th>
                                            <th>Tanggal di buat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['getdtTraining'] as $training)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $training->company_name }}</td>
                                            <td>{{ $training->traning_name }}</td>
                                            <td>
                                                @if ($training->statuspayment == 0)
                                                    <div class="badge badge-primary">Menunggu Pembayaran</div>
                                                @else
                                                    <div class="badge badge-primary">Pembayaran Berhasil</div>
                                                @endif
                                                
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($training->updated_at)->format('y-m-d') }}</td>
                                                <td>
                                                     <a href="{{ route('trainingpayment', base64_encode($training->id)) }}" class="btn btn-primary">Pembayaran</a>&nbsp;&nbsp; 
                                                     <a href="{{ route('trainingclinetdetail', base64_encode($training->id)) }}" class="btn btn-primary">Detail</a>
                                                 </td>
                                           
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('page-specific-scripts')
        <script type="text/javascript">
            window.history.forward(1);
        </script>
    @endpush
@endsection
