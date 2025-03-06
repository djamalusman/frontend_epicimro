@extends('layouts.app')
@section('title', 'Posting Job')

<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">



@section('content')
<section class="section-box">
    <div class="box-head-single box-head-single-candidate">
        <div class="container">
            @foreach($personalsummarys as $personalsummary)
            <div class="heading-image-rd online">
                <a href="#">
                    <figure>
                        <img src="{{ asset('/storage/' . ($personalsummary->photo ?? '')) }}">
                    </figure>
                </a>
            </div>
                <div class="heading-main-info">
                    <h4 class="mb-20 mt-25">{{ $personalsummary->name }} {{ $personalsummary->lastname }}

                    </h4>
                    <div class="head-info-profile">
                        <span class="text-small mr-20"><i class="fi-rr-marker text-mutted"></i>{{$personalsummary->provinsi_name}},{{$personalsummary->company_address}}</span>
                        <span class="text-small mr-20"><i class="fi fi-rr-envelope"></i> {{ $personalsummary->email }}</span>
                        <span class="text-small"><i class="fi-rr-phone-call text-mutted"></i> {{ $personalsummary->phone }}</span>

                    </div>
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Figma</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Adobe XD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">App</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Digital</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section-box mt-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="content-single">
                    <div class="card">
                        <div class="card-header">
                            Data Job
                        </div>
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto">
                                    <a type="button" href="{{ route('get-view-store-jobvacancy',  ['id' => base64_encode($id)])}}" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a type="button" id="filterButton" class="btn btn-default"><i class="fa fa-filter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <br>
                            <table id="side-list-visi-misi" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jobs Title</th>
                                        <th>Employment Status</th>
                                        <th>Work Location</th>
                                        <th>Sector</th>
                                        <th>Education</th>
                                        <th>Experience Level</th>
                                        <th>Tanggal Publish</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi melalui AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <br>

            </div>

            <!-- Sidebar -->

        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="jobTitleSelect">Job title</label>
                        <select id="jobTitleSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employmentSelect">Employee Status</label>
                        <select id="employmentSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="workLocationSelect">Work Location</label>
                        <select id="workLocationSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectorSelect">Sector</label>
                        <select id="sectorSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="educationSelect">Education</label>
                        <select id="educationSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="experienceLevelSelect">Experience Level</label>
                        <select id="experienceLevelSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusSelect">Status</label>
                        <select id="statusSelect" class="form-control">
                            <!-- Options will be appended here -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="applyFilter">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('/') }}dist/js/main.js"></script>
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    function escapeHtml(unsafe) {
        if (typeof unsafe !== 'string') {
            return '';
        }
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function formatDateRange(postedDateStr, closeDateStr) {
        if (!postedDateStr || !closeDateStr) return '';

        var postedParts = postedDateStr.split(' ')[0].split('-');
        var closeParts = closeDateStr.split(' ')[0].split('-');

        var startDate = new Date(postedParts[0], postedParts[1] - 1, postedParts[2]);
        var endDate = new Date(closeParts[0], closeParts[1] - 1, closeParts[2]);

        var startDay = startDate.getDate();
        var endDay = endDate.getDate();
        var month = startDate.toLocaleString('default', { month: 'long' });

        return startDay + '-' + endDay + ' ' + month;
    }
    function formatDate(dateStr) {
        if (!dateStr) return '';

        var parts = dateStr.split(' ')[0].split('-');
        var date = new Date(parts[0], parts[1] - 1, parts[2]);

        var day = date.getDate();
        var month = date.toLocaleString('default', { month: 'long' });
        var year = date.getFullYear();

        return day + ' ' + month + ' ' + year;
    }

    $(document).ready(function() {
        // Initialize dropdown data and table data on page load
        loadDropdownData();
        loadTableData();

        // Show modal on filter button click
        $('#filterButton').on('click', function() {
            $('#filterModal').modal('show');
        });


        $('#filterModal').on('shown.bs.modal', function() {
        $('#jobTitleSelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#employmentSelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#workLocationSelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#sectorSelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#educationSelect').select2({
            dropdownParent: $('#filterModal')
        });

        $('#experienceLevelSelect').select2({
            dropdownParent: $('#filterModal')
        });

        $('#statusSelect').select2({
            dropdownParent: $('#filterModal')
        });
    });

        // Handle apply filter button click
        $('#applyFilter').on('click', function() {
            applyFilterAndReset();
        });

        // Reset select options when modal is hidden
        $('#filterModal').on('hidden.bs.modal', function () {
            resetSelectOptions();
        });

        // Function to apply filter and reset modal
        function applyFilterAndReset() {
            var job_title = $('#jobTitleSelect').val();
            var employees_status = $('#employmentSelect').val();
            var m_work_location = $('#workLocationSelect').val();
            var sector = $('#sectorSelect').val();
            var m_education = $('#educationSelect').val();
            var experience_level = $('#experienceLevelSelect').val();
            var status = $('#statusSelect').val();
            // Load table data based on selected filter
            loadTableData({
                job_title: job_title,
                category: category,
            });

            $('#filterModal').modal('hide'); // Hide the modal
            resetSelectOptions(); // Reset select options to "All"
        }

        // Function to reset select options to "All"
        function resetSelectOptions() {
            $('#jobTitleSelect').val('');
            $('#employmentSelect').val('');
            $('#workLocationSelect').val('');
            $('#sectorSelect').val('');
            $('#educationSelect').val('');
            $('#experienceLevelSelect').val('');
            $('#statusSelect').val('');
        }

        // Function to populate dropdown list
        function loadDropdownData() {
            $.ajax({
                url: '/get-filters-job', // URL endpoint to fetch data
                type: 'GET',
                success: function(data) {
                    var job_titleSelect = $('#jobTitleSelect');
                    var employee_Select = $('#employmentSelect');
                    var workLocation_Select = $('#workLocationSelect');
                    var sector_Select = $('#sectorSelect');
                    var education_Select = $('#educationSelect');
                    var experienceLevel_Select = $('#experienceLevelSelect');
                    var status_Select = $('#statusSelect');

                    job_titleSelect.empty(); // Clear existing items
                    employee_Select.empty(); // Clear existing items
                    workLocation_Select.empty(); // Clear existing items
                    sector_Select.empty(); // Clear existing items
                    education_Select.empty(); // Clear existing items
                    experienceLevel_Select.empty(); // Clear existing items
                    status_Select.empty(); // Clear existing items

                    // Append "All" option to the select elements
                    job_titleSelect.append('<option value="">All</option>');
                    employee_Select.append('<option value="">All</option>');
                    workLocation_Select.append('<option value="">All</option>');
                    sector_Select.append('<option value="">All</option>');
                    education_Select.append('<option value="">All</option>');
                    experienceLevel_Select.append('<option value="">All</option>');
                    status_Select.append('<option value="">All</option>');

                    // Using Sets to store unique items
                    var uniqueJobtitle = new Set();
                    var uniqueEmployee = new Set();
                    var uniqueWorkLocation = new Set();
                    var uniqueSector = new Set();
                    var uniquEeducation = new Set();
                    var uniquEexperienceLevel = new Set();
                    var uniqueStatus = new Set();
                    $.each(data, function(key, value) {
                        uniqueJobtitle.add(value.job_title);
                        uniqueEmployee.add(value.employees_status);
                        uniqueWorkLocation.add(value.m_work_location);
                        uniqueSector.add(value.sector);
                        uniquEeducation.add(value.m_education);
                        uniquEexperienceLevel.add(value.experience_level);
                        uniqueStatus.add(value.status);
                    });

                    // Function to append unique items to the select elements
                    function appendUniqueItems(set, selectElement) {
                        set.forEach(function(item) {
                            selectElement.append('<option value="' + escapeHtml(item) + '">' + escapeHtml(item) + '</option>');
                        });
                    }

                    // Append unique items for each attribute to the select elements
                    appendUniqueItems(uniqueJobtitle, job_titleSelect);
                    appendUniqueItems(uniqueEmployee, employee_Select);
                    appendUniqueItems(uniqueWorkLocation, workLocation_Select);
                    appendUniqueItems(uniqueSector, sector_Select);
                    appendUniqueItems(uniquEeducation, education_Select);
                    appendUniqueItems(uniquEexperienceLevel, experienceLevel_Select);
                    appendUniqueItems(uniqueStatus, status_Select);
                },
                error: function() {
                    console.log("Error fetching data.");
                }
            });
        }

        // Function to load table data
        function loadTableData(filterValues) {
            $.ajax({
                url: '/get-data-job',
                type: 'GET',
                data: filterValues,
                success: function(data) {
                    var table = $('#side-list-visi-misi').DataTable();
                    table.clear().draw();

                    $.each(data, function(key, value) {
                        var statusBadge =
                            value.status == '1' ? '<span class="btn btn-tags-sm mb-10 mr-5">Publish</span>' :
                            value.status == '2' ? '<span class="btn btn-tags-sm mb-10 mr-5">Pending</span>' :
                            value.status == '3' ? '<span class="btn btn-tags-sm mb-10 mr-5">Non Publish</span>' :
                            value.status == '4' ? '<span class="btn btn-tags-sm mb-10 mr-5">Kadaluarsa</span>' : '';

                        table.row.add([
                            key + 1,
                            value.job_title,
                            value.employees_status,
                            value.work_location,
                            value.sector,
                            value.education,
                            value.experience_level,
                            formatDateRange(value.posted_date, value.close_date),
                            statusBadge,
                            `
                            <div class="container mt-1">
                                <div class="row button-container">
                                    <div class="col-4 text-left mb-3">
                                        <a type="button" style="color:Green" href="/edit-jobvacancy/${btoa(value.id)}" title="Edit Course">
                                            <i class="fa fa-bars"></i>
                                        </a>
                                    </div>

                                    <div class="col-4 text-left mb-3">
                                        <a type="button" href="#" style="color:red" onclick="stopPrompt('${value.id}')" title="Stop Course">
                                            <i class="fa fa-stop"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            `
                        ]).draw(false);
                    });
                },
                error: function() {
                    console.log("Error fetching table data.");
                }
            });
        }


        // Initialize DataTable
        $('#side-list-visi-misi').DataTable();
    });


    function saveSelectedValue() {
        var selectElement = document.getElementById('sideLists');
        var selectedValue = selectElement.options[selectElement.selectedIndex].value;
        document.getElementById('side_list1').value = selectedValue;
        document.getElementById('side_list_en1').value = selectedValue;
    }


    function copyDataToModal(id) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        var url = "{{ route('copy-training-course-list',':id') }}";
        url = url.replace(":id", id);
        $.ajax({
            url: url,
            type: "GET",
            processData: false,
            contentType: false,
            success: function(data) {
                data = JSON.parse(data);
                if (data["status"] == "success") {
                    $("#edit-data-list-item").html(data["output"]);
                    $("#edit-item").modal("toggle");
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data["message"],
                    });
                }
            },
            error: function(reject) {
                Toast.fire({
                    icon: "error",
                    title: "Something went wrong",
                });
            },
        });
    }

    function stopPrompt(id) {
        var url = "{{ route('stop-data-job',':id') }}";
        url = url.replace(":id", id);

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        Swal.fire({
            title: "Stop data?",
            showCancelButton: true,
            confirmButtonText: "Stop",
            confirmButtonColor: "#d33",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: url,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data["status"] == "success") {
                            Toast.fire({
                                icon: "success",
                                title: data["message"],
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: data["message"],
                            });
                        }
                    },
                    error: function(reject) {
                        Toast.fire({
                            icon: "error",
                            title: "Something went wrong",
                        });
                    },
                });
            }
        });
    }

</script>

@endsection
