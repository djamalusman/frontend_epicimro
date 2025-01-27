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
            <h1>Data Apply Job Vacancy</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Apply</a></div>
                <div class="breadcrumb-item"><a href="#">Job Vacancy</a></div>
                <div class="breadcrumb-item">Data Job</div>
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
                                            <th>Company Name</th>
                                            <th>Title Job</th>
                                            <th>Cv</th>
                                            <th>Status</th>
                                            <th>Created date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['getdtApplyJob'] as $job)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $job->companyName }}</td>
                                            <td>{{ $job->job_title }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $job->cv_path) }}" target="_blank" rel="noopener noreferrer"> <div class="badge badge-primary">View</div></a>
                                            </td>
                                            <td>
                                                <div class="badge badge-primary">Completed</div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($job->updated_at)->format('y-m-d') }}</td>
                                            <td> <a href="{{ route('jobclinetdetail', base64_encode($job->id)) }}" class="btn btn-primary">Detail</a></td>
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
