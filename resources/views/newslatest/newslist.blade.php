@extends('template1.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <section class="section-box-2" hidden>
        <div class="box-head-single none-bg">
            <div class="container">
                <h4>There Are {{ $Count }} News<br />Here For you!</h4>
                <div class="row mt-15 mb-40">
                    <div class="col-lg-7 col-md-9">
                        <span class="text-mutted">Discover your next career move, freelance gig, or
                            internship</span>
                    </div>
                    <div class="col-lg-5 col-md-3 text-lg-end text-start">
                        <ul class="breadcrumbs">
                            <li><a href="#">Recent News</a></li>
                            <li style="color: black">News listing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="breacrumb-cover">
        <div class="container">
            <ul class="breadcrumbs">
                <br>
                <li><a href="#">Recent News</a></li>
                <li>/</li>
                <li style="color: black">News listing</li>
            </ul>

        </div>
    </div>
    <div class="archive-header pt-50 pb-50">
        <div class="container">
            <h3 class="mb-30 text-center w-75 mx-auto">
                Relevant news and more for you. Welcome to our news
            </h3>
            <div class="text-center">
                <div class="sub-categories" id="categorynews"></div>
            </div>
        </div>
    </div>
    <div class="post-loop-grid">
        <div class="container">
            <div class="content-page">
                <div class="row pr-15 pl-15  list-recent-jobs mt-0">

                </div>
                <div class="paginations">
                    <ul class="pager">

                    </ul>
                </div>
            </div>
        </div>
    </div>
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

    <script>
        $(document).ready(function() {
            // Mengambil data upcoming trainings
            $.ajax({
                url: '/fetch-upcoming-trainings',
                method: 'GET',
                success: function(response) {
                    $('#training-list').html(response);
                }
            });

            // Mengambil data news
            $.ajax({
                url: '/fetch-upcoming-jobvacancy',
                method: 'GET',
                success: function(response) {
                    $('#news-list').html(response);
                }
            });
        });

        $(document).ready(function() {
            console.log('Document ready'); // Debugging line

            loadJenisBeritaTop();
            let currentSort = 'newest'; // Default sorting
            let currentPage = 1;

            function loadContent(page = 1, filters = {}, sortBy = currentSort, initialPage = false) {
                $.ajax({
                    url: '/get-content-news-list',
                    method: 'GET',
                    data: {
                        page: page,
                        ...filters,
                        sortBy: sortBy
                    },
                    success: function(response) {
                        if (initialPage) {
                            currentPage = response.pagination.current_page;
                        }
                        console.log('Load Content Success: currentPage =',
                            currentPage); // Debugging line
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

            loadContent(1, {}, currentSort, true);

            $(document).on('click', '.dropdown-menu a', function(e) {
                e.preventDefault();
                currentSort = $(this).data('sort');
                $('#currentSort').text($(this).text()); // Update button text with selected sort
                console.log('Sort by selected:', currentSort); // Debugging line
                const filters = {
                    categorynews: $('#categorynews').val(),
                };
                loadContent(1, filters, currentSort); // Fetch content with new sort
            });

            $(document).on('click', '.pager-number', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager number clicked, page:', page); // Debugging line
                currentPage = page; // Set currentPage to the clicked page
                const filters = {
                    categorynews: $('#categorynews').val(),
                };
                loadContent(page, filters, currentSort); // Fetch content with current sort
            });

            $(document).on('click', '.pager-prev', function(e) {
                e.preventDefault();
                currentPage = Math.max(currentPage - 1, 1); // Ensure the page does not go below 1
                console.log("Pager prev clicked, currentPage after decrement:",
                    currentPage); // Debugging line
                const filters = {
                    categorynews: $('#categorynews').val(),
                };
                loadContent(currentPage, filters, currentSort);
            });

            $(document).on('click', '.pager-next', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                console.log('Pager next clicked, page:', page); // Debugging line
                if (page) {
                    currentPage = page; // Set currentPage to the next page
                    const filters = {
                        categorynews: $('#categorynews').val(),
                    };
                    loadContent(page, filters, currentSort); // Fetch content with current sort
                }
            });

            $(document).on('click', '.btn-tags-jenis-berita', function() {
                const categorynews = $(this).data('value');
                $.ajax({
                    url: '/get-content-news-list',
                    method: 'GET',
                    data: {
                        categorynews: categorynews
                    },
                    success: function(response) {
                        $('.content-page .list-recent-jobs').html(response.content);
                        $('.content-page .paginations').html(response.pagination);
                        $('.content-page .showing').html(response.showing);
                        $('.content-page .sort-and-view').html(response.sort_and_view);
                    }
                });
            });

            $('#resetFilterBtn').on('click', function() {
                location.reload();
            });
        });


        function loadJenisBeritaTop() {
            const url = 'load-filter-jenis-berita'; // Ganti dengan URL endpoint Anda

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $selectElement = $('#categorynews');

                    // Clear existing content
                    $selectElement.empty();

                    // Create a container for the anchor tags
                    const $container = $('<div></div>');

                    // Loop through the data and create anchor elements
                    $.each(data, function(index, item) {
                        const $anchor = $(
                                '<a href="#" class="btn btn-tags-sm mb-10 mr-5 btn-tags-jenis-berita" data-value="' +
                                item.id + '" style="background-color: white"></a> ')
                            .text(item.nama);
                        $container.append($anchor);
                    });

                    // Replace the select element with the container
                    $selectElement.replaceWith($container);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching salary ranges:', error);
                }
            });
        }
    </script>
@endsection
