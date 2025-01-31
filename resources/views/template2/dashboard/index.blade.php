@extends('template2.layouts.app')

@section('content')
    @push('page-specific-css')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('assets2/modules/jqvmap/dist/jqvmap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets2/modules/summernote/summernote-bs4.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets2/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}" />
        <linkrel="stylesheet" href="{{ asset('assets2/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}"/>
        

    @endpush
    <style>
        #jobChart {
            width: 400px!important;
            height: 400px!important;
        }

        #trainingChart {
            width: 400px!important;
            height: 400px!important;
        }
        .img-fixed-size {
    width: 50px;
    height: 50px;
    object-fit: cover; /* Pastikan gambar tidak terdistorsi */
}

    </style>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form id="filterForm" class="needs-validation" novalidate="">
              <div class="card-body">
                  <div class="row">                               
                    <div class="form-group col-md-4 col-12">
                      <input type="text" id="dateRange" name="dateRange" class="form-control" placeholder="Select Date Range">
                    </div>
                    <div class="form-group col-md-4 col-12">
                      <select id="filterDropdown" name="filter" class="form-control">
                          <option value="all">All</option>
                          <option value="job">Job</option>
                          <option value="training">Training</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-12">
                          <button type="submit" class="btn btn-primary ">Apply Filter</button>
                    </div>
                  </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                    <h4>Pie Chart Job</h4>
                </div>
                <div class="card-body">
                    <canvas id="jobChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                    <h4>Pie Chart Training</h4>
                </div>
                <div class="card-body">
                    <canvas id="trainingChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Activities Job</h4>
                  </div>
                  <div class="card-body">             
                      <ul id="activities-list-job" class="list-unstyled list-unstyled-border"></ul>
                  </div>
                  <div class="card-header">
                    <h4>Activities Training</h4>
                  </div>
                  <div class="card-body">             
                    <ul id="activities-list-training" class="list-unstyled list-unstyled-border"></ul>
                  </div>
                </div>
            </div>
        </div>
        <!-- Chart Section -->
        
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
    

    function timeAgo(date) {
        let seconds = Math.floor((new Date() - new Date(date)) / 1000);
        let interval = Math.floor(seconds / 60);
        if (interval < 1) return "Just now";
        if (interval < 60) return `${interval}m ago`;
        interval = Math.floor(interval / 60);
        if (interval < 24) return `${interval}h ago`;
        interval = Math.floor(interval / 24);
        return `${interval}d ago`;
    }

    $(document).ready(function () {
        function fetchActivitiesJob() {
            $.ajax({
                url: "{{ route('activitiesJob') }}",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    console.log("🚀 Job Activities Response:", response);

                    let activitiesList = '';
                    if (Array.isArray(response) && response.length > 0) {
                        $.each(response, function (index, activity) {
                            let jobUrl = `/jobclinetdetail/${btoa(activity.id)}`;

                            activitiesList += `
                                <li class="media">
                                    <img class="mr-3 rounded-circle img-fixed-size" src="${activity.image}" alt="job-image">
                                    <div class="media-body">
                                        <div class="float-right text-primary">${timeAgo(activity.created_at)}</div>
                                        <div class="media-title">
                                            <a href="${jobUrl}" target ="_blank" class="text-decoration-none text-dark">
                                                ${activity.title}
                                            </a>
                                        </div>
                                        <span class="text-small text-muted">Recent job activity recorded.</span>
                                    </div>
                                </li>`;
                        });
                    } else {
                        activitiesList = '<li class="text-center text-muted">No recent job activities.</li>';
                    }

                    $('#activities-list-job').html(activitiesList);
                }
            });
        }

        function fetchActivitiesTraining() {
            $.ajax({
                url: "{{ route('activitiesTraining') }}",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    console.log("🚀 Training Activities Response:", response);

                    let activitiesList = '';
                    if (Array.isArray(response) && response.length > 0) {
                        $.each(response, function (index, activity) {
                            let trainingUrl = `/trainingclinetdetail/${btoa(activity.id)}`;


                            activitiesList += `
                                <li class="media">
                                    <img class="mr-3 rounded-circle img-fixed-size" src="${activity.image}" alt="training-image">
                                    <div class="media-body">
                                        <div class="float-right text-primary">${timeAgo(activity.created_at)}</div>
                                        <div class="media-title">
                                            <a href="${trainingUrl}" target ="_blank" class="text-decoration-none text-dark">
                                                ${activity.title}
                                            </a>
                                        </div>
                                        <span class="text-small text-muted">Recent training activity recorded.</span>
                                    </div>
                                </li>`;
                        });
                    } else {
                        activitiesList = '<li class="text-center text-muted">No recent training activities.</li>';
                    }

                    $('#activities-list-training').html(activitiesList);
                }
            });
        }

        fetchActivitiesJob();
        fetchActivitiesTraining();

        setInterval(fetchActivitiesJob, 30000);
        setInterval(fetchActivitiesTraining, 30000);
    });





    document.addEventListener("DOMContentLoaded", function () {
    let jobChartInstance = null;
    let trainingChartInstance = null;
    
    function generateColors(length) {
        const colors = [
            "#f05537", "#9C9F84", "#FFCE56", "#4BC0C0", "#9966FF",
            "#f05537", "#FFCD56", "#C9CBCF", "#9C9F84", "#A0D468"
        ];
        return Array.from({ length }, (_, i) => colors[i % colors.length]);
    }

    function updateChart(data) {
        const jobCanvas = document.getElementById("jobChart");
        const trainingCanvas = document.getElementById("trainingChart");

        if (jobChartInstance) jobChartInstance.destroy();
        if (trainingChartInstance) trainingChartInstance.destroy();

        const jobLabels = data.job.labels.length ? data.job.labels : ["No Data"];
        const trainingLabels = data.training.labels.length ? data.training.labels : ["No Data"];

        const jobValues = data.job.values.length ? data.job.values : [1];
        const trainingValues = data.training.values.length ? data.training.values : [1];

        const jobBackgroundColors = data.job.labels.length ? generateColors(jobLabels.length) : ["#CCCCCC"];
        const trainingBackgroundColors = data.training.labels.length ? generateColors(trainingLabels.length) : ["#CCCCCC"];

        jobChartInstance = new Chart(jobCanvas, {
            type: "pie",
            data: {
                labels: jobLabels,
                datasets: [{
                    data: jobValues,
                    backgroundColor: jobBackgroundColors
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return jobLabels[tooltipItem.dataIndex] + ": " + jobValues[tooltipItem.dataIndex];
                            }
                        }
                    }
                }
            }
        });

        trainingChartInstance = new Chart(trainingCanvas, {
            type: "pie",
            data: {
                labels: trainingLabels,
                datasets: [{
                    data: trainingValues,
                    backgroundColor: trainingBackgroundColors
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return trainingLabels[tooltipItem.dataIndex] + ": " + trainingValues[tooltipItem.dataIndex];
                            }
                        }
                    }
                }
            }
        });
    }

    function fetchChartData(dateRange = "", filter = "all") {
        const url = `/get-chart-data?dateRange=${encodeURIComponent(dateRange)}&filter=${encodeURIComponent(filter)}`;
        fetch(url)
            .then(response => response.json())
            .then(data => updateChart(data))
            .catch(error => console.error("❌ Error fetching chart data:", error));
    }

    fetchChartData();

    const filterForm = document.getElementById("filterForm");
    if (filterForm) {
        filterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            let dateRange = document.getElementById("dateRange").value;
            let filter = document.getElementById("filterDropdown").value;
            fetchChartData(dateRange, filter);
        });
    }

    $(document).ready(function () {
        if ($.fn.daterangepicker) {
            $('#dateRange').daterangepicker({
                autoUpdateInput: false,
                locale: { cancelLabel: 'Clear' }
            });

            $('#dateRange').on('apply.daterangepicker', function (ev, picker) {
                let selectedDateRange = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
                $(this).val(selectedDateRange);
            });

            $('#dateRange').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        }
    });
});

    </script>
    
    @push('page-specific-scripts')
        
    @endpush
@endsection
