@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')

    <section class="section-box-2">
        <div class="box-head-single none-bg">
            <div class="container">
                <h4>Please check your certificate here</h4>
                <br>
                <span class="text-mutted" style="color: black">Enter your certificate number in the search field and click the find now button</span>
            </div>
        </div>
    </section>
    <section class="section-box mt-0">
        <div class="container">
            <div class="row flex-row-reverse">
                <!-- Item Training & News -->
                <!-- Page content -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">
                        <div class="box-filters-job mt-0 mb-10">
                            <div class="row">
                                <div class="col-sm-0 text-center d-flex align-items-center"></div>
                                <div class="col-sm-4 text-center d-flex align-items-center">
                                    <input type="text" id="filterJobtitle"  class="form-control form-icons" placeholder="search">
                                </div>
                                <div class="col-sm-4 text-center d-flex align-items-center">
                                    <button  id="applyFilterBtn"  class="btn btn-default float-right">Find Now</button> &nbsp;&nbsp;&nbsp;
                                    <button id="resetFilterBtn" onclick="reloadPage()" class="btn btn-default float-right">Reset filter</button>
                                </div>

                            </div>
                        </div>

                        <div class="list-recent-jobs">

                        </div>

                        <!-- pagination -->
                        <div class="paginations" hidden>
                            <ul class="pager">

                            </ul>
                        </div>
                        <!-- End pagination -->

                    </div>
                </div>
                <!-- End page content -->


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
                        <input type="text" class="input-newsletter" value="" placeholder="contact.alithemes@gmail.com" />
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

    <script>





        $(document).ready(function() {

            console.log('Document ready'); // Debugging line

            //filterEducation();
            let currentSort = 'newest'; // Default sorting

            function loadContent(page = 1, filters = {}, sortBy = currentSort) {
                $.ajax({
                    url: '/getdata-certification',
                    method: 'GET',
                    data: {

                        ...filters
                    },
                    success: function(response) {
                        //console.log('Success response:', response); // Debugging line
                        $('.content-page .list-recent-jobs').html(response.content);
                        $('.content-page .paginations').html(response.pagination);

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

        });

        function reloadPage() {
            location.reload();
        }



    </script>
@endsection
