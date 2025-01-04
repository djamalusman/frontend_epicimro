@extends('template1.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <section class="section-box-2">
        <div class="box-head-single none-bg">
            <div class="container">
                <h4>There Are {{ $Counttraining }} Training<br />Here For you!</h4>
                <div class="row mt-15 mb-40">
                    <div class="col-lg-7 col-md-9">
                        <span class="text-mutted" style="color: black">Improve your skill to boost your career</span>
                    </div>
                    <div class="col-lg-5 col-md-3 text-lg-end text-start" hidden>
                        <ul class="breadcrumbs mt-sm-15">
                            <li><a href="#">Home</a></li>
                            <li>Jobs listing</li>
                        </ul>
                    </div>
                </div>
                <div class="box-shadow-bdrd-15 box-filters">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="box-search-job">
                                <form class="form-search-job">
                                    <input type="text" id="filterTrainingname" class="input-search-job"
                                        placeholder="Search Training Name" />
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex job-fillter">
                                <div class="d-block d-lg-flex">
                                    <div class="dropdown job-type">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="categoryTop" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="provinsiTop" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="statusTop" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <div class="form-group select-style select-style-icon">
                                            <select id="typeTop" class="form-control form-icons select-active">
                                                <!-- Options will be loaded here via AJAX -->
                                            </select>
                                            <i class="fi-rr-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-button-find">
                                    <button class="btn btn-border float-right" id="applyFilterBtnTop">Find Now</button>
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
                                            <a href="{{ route('course-list') }}" class="view-type" hidden><img
                                                    src="assets/imgs/theme/icons/icon-grid.svg" alt="jobhub" /></a>
                                            <a href="{{ route('course-grid') }}" class="view-type"><img
                                                    src="assets/imgs/theme/icons/icon-list.svg" alt="jobhub" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row list-recent-jobs mt-0">

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
                                <h5 class="medium-heading mb-15">Category</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select id="category" class="form-control form-icons select-active">
                                        <!-- Options will be loaded here via AJAX  -->
                                    </select>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Certificate type</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select id="filterCertificatetype" class="form-control form-icons select-active">
                                        <!-- Options will be loaded here via AJAX -->
                                    </select>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Provinsi</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select id="provinsiSelect" class="form-control form-icons select-active">
                                        <!-- Options will be loaded here via AJAX  -->
                                    </select>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Status</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select id="statusSelect" class="form-control form-icons select-active">
                                        <!-- Options will be loaded here via AJAX  -->
                                    </select>

                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Type</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select id="typeSelect" class="form-control form-icons select-active">
                                        <!-- Options will be loaded here via AJAX  -->
                                    </select>

                                </div>
                            </div>

                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Date</h5>
                                <div class="form-group">
                                    <input type="text" id="datesearch" placeholder="Select Date Range">

                                </div>
                            </div>

                            <div class="buttons-filter">
                                <button id="applyFilterBtn" class="btn btn-border">Apply filter</button>
                                <button id="resetFilterBtn" class="btn btn-border">Reset filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter -->

            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr for Date Range with Optional Single Date
        const dateRangePicker = flatpickr("#datesearch", {
            mode: "range", // Enable range mode for date range selection
            dateFormat: "Y-m-d", // Date format
            onClose: function(selectedDates) {
                const dateInput = document.getElementById("datesearch");

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
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Flatpickr for Date Range with Optional Single Date
            const dateRangePicker = flatpickr("#datesearch", {
                mode: "range", // Enable range mode for date range selection
                dateFormat: "Y-m-d", // Date format
                onClose: function(selectedDates) {
                    const dateInput = document.getElementById("datesearch");

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
            const dateForm = document.getElementById("dateForm");

            if (dateForm) {
                dateForm.addEventListener("submit", function(event) {
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
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Mengambil data upcoming trainings
            $.ajax({
                url: '/fetch-upcoming-jobvacancy',
                method: 'GET',
                success: function(response) {
                    $('#jobvacancy-list').html(response);
                }
            });

            // Mengambil data news
            $.ajax({
                url: '/fetch-upcoming-news',
                method: 'GET',
                success: function(response) {
                    $('#news-list').html(response);
                }
            });
        });

        $(document).ready(function() {

            console.log('Document ready'); // Debugging line
            //previewFilter();
            //filterTypeCourse();
            loadCategoryLeft();
            loadProvinsisLeft();
            loadStatusLeft();
            loadTypeLeft();
            loadCertificatetypeLeft();

            loadCategoryTop();
            loadProvinsisTop();
            loadStatusTop();
            loadTypeTop();
            let currentSort = 'newest'; // Default sorting

            function loadContent(page = 1, filters = {}, sortBy = currentSort) {
                $.ajax({
                    url: '/get-content-grid-course',
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
                    datesearch: $('#datesearch').val(),
                    category: $('#category').val(),
                    cetificatetype: $('#filterCertificatetype').val(),
                    provinsi: $('#provinsiSelect').val(),
                    status: $('#statusSelect').val(),
                    type: $('#typeSelect').val(),
                    trainingname: $('#filterTrainingname').val(),
                    categoryTop: $('#categoryTop').val(),
                    provinsiTop: $('#provinsiTop').val(),
                    statusTop: $('#statusTop').val(),
                    typeTop: $('#typeTop').val(),


                };
                loadContent(1, filters, currentSort); // Fetch content with new sort
            });

            $(document).on('click', '.pager-number', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager number clicked, page:', page); // Debugging line
                const filters = {
                    datesearch: $('#datesearch').val(),
                    category: $('#category').val(),
                    cetificatetype: $('#filterCertificatetype').val(),
                    provinsi: $('#provinsiSelect').val(),
                    status: $('#statusSelect').val(),
                    type: $('#typeSelect').val(),
                    trainingname: $('#filterTrainingname').val(),
                    categoryTop: $('#categoryTop').val(),
                    provinsiTop: $('#provinsiTop').val(),
                    statusTop: $('#statusTop').val(),
                    typeTop: $('#typeTop').val(),


                };
                loadContent(page, filters, currentSort); // Fetch content with current sort
            });

            $(document).on('click', '.pager-prev', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager prev clicked, page:', page); // Debugging line
                if (page) {
                    const filters = {
                        datesearch: $('#datesearch').val(),
                        category: $('#category').val(),
                        cetificatetype: $('#filterCertificatetype').val(),
                        provinsi: $('#provinsiSelect').val(),
                        status: $('#statusSelect').val(),
                        type: $('#typeSelect').val(),
                        trainingname: $('#filterTrainingname').val(),
                        categoryTop: $('#categoryTop').val(),
                        provinsiTop: $('#provinsiTop').val(),
                        statusTop: $('#statusTop').val(),
                        typeTop: $('#typeTop').val(),

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
                        datesearch: $('#datesearch').val(),
                        category: $('#category').val(),
                        cetificatetype: $('#filterCertificatetype').val(),
                        provinsi: $('#provinsiSelect').val(),
                        status: $('#statusSelect').val(),
                        type: $('#typeSelect').val(),
                        trainingname: $('#filterTrainingname').val(),
                        categoryTop: $('#categoryTop').val(),
                        provinsiTop: $('#provinsiTop').val(),
                        statusTop: $('#statusTop').val(),
                        typeTop: $('#typeTop').val(),

                    };
                    loadContent(page, filters, currentSort); // Fetch content with current sort
                }
            });

            $('#applyFilterBtn').on('click', function() {
                const filters = {
                    datesearch: $('#datesearch').val(),
                    category: $('#category').val(),
                    cetificatetype: $('#filterCertificatetype').val(),
                    provinsi: $('#provinsiSelect').val(),
                    status: $('#statusSelect').val(),
                    type: $('#typeSelect').val(),
                    trainingname: $('#filterTrainingname').val(),
                    categoryTop: $('#categoryTop').val(),
                    provinsiTop: $('#provinsiTop').val(),
                    statusTop: $('#statusTop').val(),
                    typeTop: $('#typeTop').val(),

                };
                console.log('Apply filter button clicked'); // Debugging line
                loadContent(1, filters, currentSort); // Fetch content with filters and current sort
            });

            $('#applyFilterBtnTop').on('click', function() {
                const filters = {

                    trainingname: $('#filterTrainingname').val(),
                    category: $('#categoryTop').val(),
                    cetificatetype: $('#filterCertificatetype').val(),
                    provinsi: $('#provinsiTop').val(),
                    status: $('#statusTop').val(),
                    type: $('#typeTop').val(),

                };
                console.log('Apply filter button clicked'); // Debugging line
                loadContent(1, filters, currentSort); // Fetch content with filters and current sort
            });

            $('#resetFilterBtn').on('click', function() {
                $('#datesearch').val(''),
                    $('#filterTrainingname').val('');
                $('#provinsiSelect').val('');
                $('#category').val('');
                $('#statusSelect').val('');
                $('#filterCertificatetype').val('');
                $('#typeSelect').val('');
                $('#categoryTop').val(),
                    $('#provinsiTop').val(),
                    $('#statusTop').val(),
                    $('#typeTop').val(),
                    loadContent(1, {}, currentSort); // Fetch content without filters and current sort
                loadCategoryLeft();
                loadProvinsisLeft();
                loadStatusLeft();
                loadTypeLeft();
                loadCertificatetypeLeft();

                loadCategoryTop();
                loadProvinsisTop();
                loadStatusTop();
                loadTypeTop();
            });
        });



        function loadCategoryLeft() {
            const url = 'load-dropdown-category'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#category');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Category</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching category:', error);
                }
            });
        }

        function loadProvinsisLeft() {
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
                    $selectElement.append('<option value="">Select Provinsi</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Provinsi:', error);
                }
            });
        }

        function loadCertificatetypeLeft() {
            const url = 'load-dropdown-certificatetype'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#filterCertificatetype');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Certificate</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching category:', error);
                }
            });
        }

        function loadStatusLeft() {
            const url = 'load-filter-status'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#statusSelect');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Status</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Provinsi:', error);
                }
            });
        }

        function loadTypeLeft() {
            const url = 'load-dropdown-type'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#typeSelect');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Type</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Type:', error);
                }
            });
        }


        function loadCategoryTop() {
            const url = 'load-dropdown-category'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#categoryTop');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Category</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.nama).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching category:', error);
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
                    const $selectElement = $('#provinsiTop');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Provinsi</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Provinsi:', error);
                }
            });
        }

        function loadStatusTop() {
            const url = 'load-filter-status'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#statusTop');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Status</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Provinsi:', error);
                }
            });
        }

        function loadTypeTop() {
            const url = 'load-dropdown-type'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#typeTop');

                    // Clear existing options
                    $selectElement.empty();

                    // Add a default option
                    $selectElement.append('<option value="">Select Type</option>');

                    // Loop through the data and create new option elements
                    $.each(data, function(index, item) {
                        $selectElement.append(
                            $('<option></option>').val(item.id).text(item.nama)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Type:', error);
                }
            });
        }
    </script>
@endsection
