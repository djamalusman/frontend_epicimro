@extends('layouts.app')
@section('title', 'Posting Training')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 Bootstrap Theme -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

@section('content')
<style>
.dropdown-menu {
    max-height: 300px;
    overflow-y: auto;
}

.list-group-item {
    cursor: pointer;
}
</style>
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
                            Data Training
                        </div>
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('get-view-store-traningcourse',  ['id' => base64_encode($id)])}}" class="btn btn-default">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a id="filterButton" class="btn btn-default">
                                        <i class="fa fa-filter" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <table id="side-list-visi-misi" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        
                                        <th>Nama Training</th>
                                        <th>Category</th>
                                        <th>Nama Sertifikat</th>
                                        <th>Tanggal Mulai dan Selesai</th>
                                        <th>Type</th>
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
</section>

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
                    <label for="traningNameSelect">Training Name</label>
                    <select id="traningNameSelect" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="categorySelect">Category</label>
                    <select id="categorySelect" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="certificateTypeSelect">Certificate Type</label>
                    <select id="certificateTypeSelect" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="typeonlineoflineSelect">Type</label>
                    <select id="typeonlineoflineSelect" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusSelect">Status</label>
                    <select id="statusSelect" class="form-control">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    $('#side-list-visi-misi').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
    
    if ($.fn.DataTable) {
        console.log('DataTables is loaded and available.');
        var table = $('#side-list-visi-misi').DataTable(); // Initialize once

        // Example of reinitialization (if needed)
        table.destroy(); // Destroy the existing DataTable instance
        $('#side-list-visi-misi').DataTable(); // Reinitialize
    } else {
        console.error('DataTables is not loaded.');
    }
});
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
    $('#filterButton').on('click', function() {
        $('#filterModal').modal('show');
    });

    $('#filterModal').on('shown.bs.modal', function() {
        
        $('#traningNameSelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#categorySelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#certificateTypeSelect').select2({
            dropdownParent: $('#filterModal')
        });
        $('#typeonlineoflineSelect').select2({
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
        var companyName = $('#companyNameSelect').val();
        var traningName = $('#traningNameSelect').val();
        var category = $('#categorySelect').val();
        var certificateType = $('#certificateTypeSelect').val();
        var typeonlineofline = $('#typeonlineoflineSelect').val();
        var status = $('#statusSelect').val();

        // Load table data based on selected filter
        loadTableData({
            company_name: companyName,
            traning_name: traningName,
            category: category,
            cetificate_type: certificateType,
            typeonlineofline: typeonlineofline,
            status_training: status
        });

        $('#filterModal').modal('hide'); // Hide the modal
        resetSelectOptions(); // Reset select options to "All"
    }

    // Function to reset select options to "All"
    function resetSelectOptions() {
      
        $('#traningNameSelect').val('');
        $('#categorySelect').val('');
        $('#certificateTypeSelect').val('');
        $('#typeonlineoflineSelect').val('');
        $('#statusSelect').val('');
    }

    // Function to populate dropdown list
    function loadDropdownData() {
        $.ajax({
            url: '/get-datacourse-filters', // URL endpoint to fetch data
            type: 'GET',
            success: function(data) {
                var traningNameSelect = $('#traningNameSelect');
                var categorySelect = $('#categorySelect');
                var certificateTypeSelect = $('#certificateTypeSelect');
                var typeonlineoflineSelect = $('#typeonlineoflineSelect');
                var statusSelect = $('#statusSelect');

                traningNameSelect.empty(); // Clear existing items
                categorySelect.empty(); // Clear existing items
                certificateTypeSelect.empty(); // Clear existing items
                typeonlineoflineSelect.empty(); // Clear existing items
                statusSelect.empty(); // Clear existing items

                // Append "All" option to the select elements
                traningNameSelect.append('<option value="">All</option>');
                categorySelect.append('<option value="">All</option>');
                certificateTypeSelect.append('<option value="">All</option>');
                typeonlineoflineSelect.append('<option value="">All</option>');
                statusSelect.append('<option value="">All</option>');

                // Using Sets to store unique items
                var uniqueTraningNames = new Set();
                var uniqueCategories = new Set();
                var uniqueCetificateTypes = new Set();
                var uniqueTypeonlineofline = new Set();
                var uniqueStatus = new Set();

                $.each(data, function(key, value) {
                    uniqueTraningNames.add(value.traning_name);
                    uniqueCategories.add(value.category);
                    uniqueCetificateTypes.add(value.cetificate_type);
                    uniqueTypeonlineofline.add(value.typeonlineofline);
                    uniqueStatus.add(value.status_training);
                });

                // Function to append unique items to the select elements
                function appendUniqueItems(set, selectElement) {
                    set.forEach(function(item) {
                        selectElement.append('<option value="' + escapeHtml(item) + '">' + escapeHtml(item) + '</option>');
                    });
                }

                // Append unique items for each attribute to the select elements
                appendUniqueItems(uniqueTraningNames, traningNameSelect);
                appendUniqueItems(uniqueCategories, categorySelect);
                appendUniqueItems(uniqueCetificateTypes, certificateTypeSelect);
                appendUniqueItems(uniqueTypeonlineofline, typeonlineoflineSelect);
                appendUniqueItems(uniqueStatus, statusSelect);
            },
            error: function() {
                console.log("Error fetching data.");
            }
        });
    }

    // Function to load table data
    function loadTableData(filterValues) {
        $.ajax({
            url: '/get-data-course',
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
                    value.status == '4' ? '<span class="btn btn-tags-sm mb-10 mr-5">Kadaluarsa</span>' :
                    '<span class="badge badge-dark">Unknown Status</span>';
                    table.row.add([
                        key + 1,
                        value.traning_name,
                        value.category,
                        value.cetificate_type,
                        formatDateRange(value.startdate, value.enddate),
                        value.typeonlineofline,
                        statusBadge,
                        `
                                <div class="container mt-1">
                                    <div class="row button-container">
                                        <div class="col-4 text-left mb-3">
                                            <a type="button" style="color:Green" href="/edit-traningcourse/${btoa(value.id)}"title="Edit Course" >
                                                <i class="fa fa-bars"></i>
                                            </a>
                                        </div>
                                        <div class="col-4 text-left mb-3">
                                            <a type="button" style="color:Blue" onclick="copyDataToModal('${value.id}')" href="#" title="Copy Course">
                                                <i class="fa fa-clipboard"></i>
                                            </a>
                                        </div>
                                        <div class="col-4 text-left mb-3">
                                             <a type="button" href="#" style="color:red" onclick="stopPrompt('${value.id}')"title="Stop Course">
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

    //loadResume();
    // Initialize DataTable
    $('#side-list-visi-misi').DataTable();
});



    $('input[type="file"]').change(function(e) {
        console.log('Picture Changed');
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        const [file] = $(this)[0].files;
        if (file) {
            $(".simulasi-gambar-" + this.id).attr("src", URL.createObjectURL(file));
        }
        $(this).next(".custom-file-label").html(files.join(", "));
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
        var url = "{{ route('stop-data-course',':id') }}";
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
