@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <section class="section-box-2">
        <div class="box-head-single none-bg">
            <div class="container">
                <h4>There Are {{ $CountJob }} Jobs<br />Here For you!</h4>
                <div class="row mt-15 mb-40">
                    <div class="col-lg-7 col-md-9">
                        <span class="text-mutted" style="color: black">Discover your next career move, freelance gig, or
                            internship</span>
                    </div>
                    <div class="col-lg-5 col-md-3 text-lg-end text-start">
                        <ul class="breadcrumbs mt-sm-15">
                            <li><a href="#">Recent Jobs</a></li>
                            <li>Jobs listing</li>
                        </ul>
                    </div>
                </div>
                <div class="box-shadow-bdrd-15 box-filters">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="box-search-job">
                                <form class="form-search-job">
                                    <input type="text" id="filterJobtitle" class="input-search-job"
                                        placeholder="Search  Job title" />
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex job-fillter">
                                <div class="d-block d-lg-flex">
                                    <div class="dropdown">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="employeeStatusSelect" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="provinsiSelect" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-marker"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="salaryRangeSelectTop" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-dollar" hidden></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-button-find">
                                    <button id="applyFilterBtn" class="btn btn-border float-right">Find Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-10">
        <div class="container">
            <div class="row flex-row-reverse">
                <!-- Item Training & News -->


                <!-- Page content -->
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">
                        <div class="box-filters-job mt-15 mb-10">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="showing"></div>
                                </div>
                                <div class="col-lg-7 text-lg-end mt-sm-15">
                                    <div class="display-flex2">
                                        <div class="dropdown dropdown-sort">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownSort"
                                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                                                <span id="currentSort">Newest Post</span> <i
                                                    class="fi-rr-angle-small-down"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                                                <li><a class="dropdown-item" href="#" data-sort="newest">Newest
                                                        Post</a></li>
                                                <li><a class="dropdown-item" href="#" data-sort="oldest">Oldest
                                                        Post</a></li>
                                                <li><a class="dropdown-item" href="#" data-sort="rating">Rating
                                                        Post</a></li>
                                            </ul>
                                        </div>
                                        <div class="box-view-type">
                                            <a href="{{ route('job-list') }}" class="view-type" hidden><img
                                                    src="assets/imgs/theme/icons/icon-grid.svg" alt="jobhub" /></a>
                                            <a href="{{ route('job-grid') }}" class="view-type"><img
                                                    src="assets/imgs/theme/icons/icon-list.svg" alt="jobhub" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row list-recent-jobs">

                        </div>

                        <!-- pagination -->
                        <div class="paginations">
                            <ul class="pager">

                            </ul>
                        </div>
                        <!-- End pagination -->

                    </div>
                </div>
                <!-- End page content -->

                <!-- Filter -->
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <h5 class="sidebar-title">Filters</h5>
                        <div class="sidebar-filters">
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Location</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control form-icons" id="filterLocation"
                                        placeholder="Location" />
                                    <i class="fi-rr-marker"></i>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Employment Status</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox">
                                        <div id="filterEmployeeStatus">
                                            <!-- Pratinjau filter akan ditampilkan di sini -->
                                        </div>
                                    </ul>
                                </div>
                            </div>

                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Experience Level</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox">
                                        <div id="filterexperiencelevel">
                                            <!-- Pratinjau filter akan ditampilkan di sini -->
                                        </div>

                                    </ul>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Placement</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox">
                                        <div id="filterPlacement">
                                            <!-- Pratinjau filter akan ditampilkan di sini -->
                                        </div>

                                    </ul>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Salary Range</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select id="salaryRangeSelect" class="form-control form-icons select-active">
                                        <!-- Options will be loaded here via AJAX  -->
                                    </select>
                                    <i class="fi-rr-dollar" hidden></i>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Date</h5>
                                <div class="form-group">
                                    <input type="text" id="datesearchJob" placeholder="Select Date Range">

                                </div>
                            </div>
                            <div class="buttons-filter">
                                <button id="applyFilterBtnBottom" class="btn btn-border">Apply filter</button>
                                <button id="resetFilterBtn" class="btn btn-border">Reset filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter -->

            </div>
        </div>
    </section>

    <section class="section-box mt-50 mb-60" hidden>
        <div class="container">
            <div class="box-newsletter">
                <h5 class="text-md-newsletter">Sign up to get</h5>
                <h6 class="text-lg-newsletter">the latest jobs</h6>
                <div class="box-form-newsletter mt-30">
                    <form class="form-newsletter">
                        <input type="text" class="input-newsletter" value=""
                            placeholder="contact.alithemes@gmail.com" />
                        <button class="btn btn-default font-heading icon-send-letter">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="box-newsletter-bottom">
                <div class="newsletter-bottom"></div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr for Date Range with Optional Single Date
        const dateRangePicker = flatpickr("#datesearchJob", {
            mode: "range", // Enable range mode for date range selection
            dateFormat: "Y-m-d", // Date format
            onClose: function(selectedDates) {
                const dateInput = document.getElementById("datesearchJob");

                // Set the value of the input based on the number of dates selected
                if (selectedDates.length === 1) {
                    const startDate = selectedDates[0];
                    dateInput.value = flatpickr.formatDate(startDate, "Y-m-d");
                } else if (selectedDates.length === 2) {
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];

                    // Validate if end date is before start date
                    if (endDate < startDate) {
                        alert("End date cannot be earlier than start date.");
                        dateRangePicker.clear(); // Clear the date range picker if invalid
                    } else {
                        // Set the value of the input to the selected date range in "Y-m-d to Y-m-d" format
                        dateInput.value =
                            flatpickr.formatDate(startDate, "Y-m-d") + " to " +
                            flatpickr.formatDate(endDate, "Y-m-d");
                    }
                } else {
                    dateInput.value = ""; // Clear input if no dates selected
                }
            }
        });

        // Optional: Prevent form submission if date range is invalid
        document.getElementById("dateForm").addEventListener("submit", function(event) {
            const selectedDates = dateRangePicker.selectedDates;

            // If two dates are selected, validate start and end dates
            if (selectedDates.length === 2) {
                const startDate = selectedDates[0];
                const endDate = selectedDates[1];

                if (endDate < startDate) {
                    alert("End date cannot be earlier than start date.");
                    event.preventDefault(); // Prevent form submission if invalid
                }
            }
            // No action needed if no dates or only one date is selected
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('filterLocation');

            // Check if input element exists
            if (input) {
                // Function to format input as currency
                function formatCurrency(value) {
                    // Remove all non-numeric characters
                    value = value.replace(/\D/g, '');

                    // Format the number with commas
                    return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }

                // Event listener to format input on change
                input.addEventListener('input', function(e) {
                    // Get the input value and format it
                    const formattedValue = formatCurrency(e.target.value);
                    // Set the formatted value back to input
                    e.target.value = formattedValue;
                });

                // Optional: Restrict input to numeric values only
                input.addEventListener('keypress', function(e) {
                    if (e.key < '0' || e.key > '9') {
                        e.preventDefault();
                    }
                });
            } else {
                console.error('Element with id "filterLocation" not found');
            }
        });

        $(document).ready(function() {
            // Mengambil data upcoming trainings
            $.ajax({
                url: '/fetch-upcoming-jobs-sidebar',
                method: 'GET',
                success: function(response) {
                    $('#training-list').html(response);
                }
            });

            // Mengambil data news
            // $.ajax({
            //     url: '/fetch-upcoming-news',
            //     method: 'GET',
            //     success: function(response) {
            //         $('#news-list').html(response);
            //     }
            // });
        });

        $(document).ready(function() {

            console.log('Document ready'); // Debugging line
            PreviewemployeeStatus();
            PriviewfilterPlacement();
            filterExperienceLevel();
            loadSalaryRanges();
            loadEmployeeStatusTop();
            loadProvinsisTop();
            loadSalaryRangesTop();
            //filterEducation();
            let currentSort = 'newest'; // Default sorting

            function loadContent(page = 1, filters = {}, sortBy = currentSort) {
                $.ajax({
                    url: '/get-content-job-grid',
                    method: 'GET',
                    data: {
                        page: page,
                        ...filters,
                        sortBy: sortBy
                    },
                    success: function(response) {
                        //console.log('Success response:', response); // Debugging line
                        $('.content-page .list-recent-jobs').html(response.content);
                        $('.content-page .paginations').html(response.pagination);
                        $('.content-page .showing').html(response.showing);
                        $('.content-page .sort-and-view').html(response.sort_and_view);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Test function call directly
            loadContent(); // Test if the function works when called directly

            // Event handler for sorting
            $(document).on('click', '.dropdown-menu a', function(e) {
                e.preventDefault();
                currentSort = $(this).data('sort');
                $('#currentSort').text($(this).text()); // Update button text with selected sort
                console.log('Sort by selected:', currentSort); // Debugging line
                const filters = {
                    // jobtype: $('#filterJobtype').val(),
                    datesearchJob: $('#datesearchJob').val(),
                    location: $('#filterLocation').val(),
                    jobtitle: $('#filterJobtitle').val(),
                    placement: $('.filterPlacement:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    employestatus: $('.filterEmployeeStatus:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    salaryRange: $('#salaryRangeSelect').val(),
                    employeeStatusSelect: $('#employeeStatusSelect').val(),
                    provinsi: $('#provinsiSelect').val(),
                    salaryRangeTop: $('#salaryRangeSelectTop').val(),
                };
                loadContent(1, filters, currentSort); // Fetch content with new sort
            });

            $(document).on('click', '.pager-number', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager number clicked, page:', page); // Debugging line
                const filters = {
                    datesearchJob: $('#datesearchJob').val(),
                    //jobtype: $('#filterJobtype').val(),
                    location: $('#filterLocation').val(),
                    jobtitle: $('#filterJobtitle').val(),
                    placement: $('.filterPlacement:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    employestatus: $('.filterEmployeeStatus:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    salaryRange: $('#salaryRangeSelect').val(),
                    employeeStatusSelect: $('#employeeStatusSelect').val(),
                    provinsi: $('#provinsiSelect').val(),
                    salaryRangeTop: $('#salaryRangeSelectTop').val(),
                };
                loadContent(page, filters, currentSort); // Fetch content with current sort
            });

            $(document).on('click', '.pager-prev', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager prev clicked, page:', page); // Debugging line
                if (page) {
                    const filters = {
                        datesearchJob: $('#datesearchJob').val(),
                        // jobtype: $('#filterJobtype').val(),
                        location: $('#filterLocation').val(),
                        jobtitle: $('#filterJobtitle').val(),
                        placement: $('.filterPlacement:checked').map(function() {
                            return $(this).val();
                        }).get(),
                        employestatus: $('.filterEmployeeStatus:checked').map(function() {
                            return $(this).val();
                        }).get(),
                        experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                            return $(this).val();
                        }).get(),
                        salaryRange: $('#salaryRangeSelect').val(),
                        employeeStatusSelect: $('#employeeStatusSelect').val(),
                        provinsi: $('#provinsiSelect').val(),
                        salaryRangeTop: $('#salaryRangeSelectTop').val(),
                    };
                    loadContent(page, filters, currentSort); // Fetch content with current sort
                }
            });

            $(document).on('click', '.pager-next', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager next clicked, page:', page); // Debugging line
                if (page) {
                    const filters = {
                        datesearchJob: $('#datesearchJob').val(),
                        //jobtype: $('#filterJobtype').val(),
                        location: $('#filterLocation').val(),
                        jobtitle: $('#filterJobtitle').val(),
                        placement: $('.filterPlacement:checked').map(function() {
                            return $(this).val();
                        }).get(),
                        employestatus: $('.filterEmployeeStatus:checked').map(function() {
                            return $(this).val();
                        }).get(),
                        experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                            return $(this).val();
                        }).get(),
                        salaryRange: $('#salaryRangeSelect').val(),
                        employeeStatusSelect: $('#employeeStatusSelect').val(),
                        provinsi: $('#provinsiSelect').val(),
                        salaryRangeTop: $('#salaryRangeSelectTop').val(),
                    };
                    loadContent(page, filters, currentSort); // Fetch content with current sort
                }
            });

            $('#applyFilterBtn').on('click', function() {
                const filters = {
                    datesearchJob: $('#datesearchJob').val(),
                    //jobtype: $('#filterJobtype').val(),
                    location: $('#filterLocation').val(),
                    jobtitle: $('#filterJobtitle').val(),
                    placement: $('.filterPlacement:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    employestatus: $('.filterEmployeeStatus:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    salaryRange: $('#salaryRangeSelect').val(),
                    employeeStatusSelect: $('#employeeStatusSelect').val(),
                    provinsi: $('#provinsiSelect').val(),
                    salaryRangeTop: $('#salaryRangeSelectTop').val(),
                };
                console.log('Apply filter button clicked'); // Debugging line
                loadContent(1, filters, currentSort); // Fetch content with filters and current sort
            });
            $('#applyFilterBtnBottom').on('click', function() {
                const filters = {
                    datesearchJob: $('#datesearchJob').val(),
                    //jobtype: $('#filterJobtype').val(),
                    location: $('#filterLocation').val(),
                    jobtitle: $('#filterJobtitle').val(),
                    placement: $('.filterPlacement:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    employestatus: $('.filterEmployeeStatus:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                        return $(this).val();
                    }).get(),
                    salaryRange: $('#salaryRangeSelect').val(),
                    employeeStatusSelect: $('#employeeStatusSelect').val(),
                    provinsi: $('#provinsiSelect').val(),
                    salaryRangeTop: $('#salaryRangeSelectTop').val(),
                };
                console.log('Apply filter button clicked'); // Debugging line
                loadContent(1, filters, currentSort); // Fetch content with filters and current sort
            });
            $('#resetFilterBtn').on('click', function() {
                // $('#filterJobtype').val('');
                datesearchJob: $('#datesearchJob').val(''),
                $('#filterLocation').val('');
                $('#filterJobtitle').val('');
                $('#salaryRangeSelect').val('');
                $('#salaryRangeSelectTop').val('');
                $('#employeeStatusSelect').val('');
                $('#provinsiSelect').val('');
                $('#filterexperiencelevel').val('');
                $('.filterEmployeeStatus').prop('checked', false);
                $('.filterPlacement').prop('checked', false);
                $('.filterexperiencelevel').prop('checked', false);
                console.log('Reset filter button clicked'); // Debugging line
                loadContent(1, {}, currentSort); // Fetch content without filters and current sort
                PreviewemployeeStatus();
                PriviewfilterPlacement();
                filterExperienceLevel();
                loadSalaryRanges();
                loadEmployeeStatusTop();
                loadProvinsisTop();
                loadSalaryRangesTop();
            });
        });

        function loadSalaryRanges() {
            const url = 'load-filter-salaray-range'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#salaryRangeSelect');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Salary Range</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.nama).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching salary ranges:', error);
                }
            });
        }

        function loadSalaryRangesTop() {
            const url = 'load-filter-salaray-range'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#salaryRangeSelectTop');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Salary Range</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.nama).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching salary ranges:', error);
                }
            });
        }


        function PreviewemployeeStatus() {
            const filters = {
                employeeStatus: $('.filterEmployeeStatus:checked').map(function() {
                    return $(this).val();
                }).get()
            };
            $.ajax({
                url: '/preview-filter-job', // Endpoint untuk pratinjau filter
                method: 'GET',
                data: filters,
                success: function(response) {
                    $('#filterEmployeeStatus').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching filter preview:', error);
                }
            });
        }

        function PriviewfilterPlacement() {
            const filters = {
                placement: $('.filterPlacement:checked').map(function() {
                    return $(this).val();
                }).get(),

            };
            $.ajax({
                url: '/filter-placement', // Endpoint untuk pratinjau filter
                method: 'GET',
                data: filters,
                success: function(response) {
                    $('#filterPlacement').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching filter preview:', error);
                }
            });
        }

        function filterExperienceLevel() {
            const filters = {
                experiencelevel: $('.filterExperiencelevel:checked').map(function() {
                    return $(this).val();
                }).get(),

            };
            $.ajax({
                url: '/filter-experience-level-job', // Endpoint untuk pratinjau filter
                method: 'GET',
                data: filters,
                success: function(response) {
                    $('#filterexperiencelevel').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching filter preview:', error);
                }
            });
        }

        function filterEducation() {
            const filters = {
                education: $('.filterEducation:checked').map(function() {
                    return $(this).val();
                }).get(),

            };
            $.ajax({
                url: '/filter-education-job', // Endpoint untuk pratinjau filter
                method: 'GET',
                data: filters,
                success: function(response) {
                    $('#filtereducation').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching filter preview:', error);
                }
            });
        }


        function loadEmployeeStatusTop() {
            const url = 'load-filter-employeeStatusTop'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#employeeStatusSelect');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Employee Status</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching salary ranges:', error);
                }
            });
        }

        function loadProvinsisTop() {
            const url = 'load-filter-provinsiTop'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#provinsiSelect');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Location</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching salary ranges:', error);
                }
            });
        }
    </script>
@endsection
