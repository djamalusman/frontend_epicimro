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
    </style>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            
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
        <!-- Chart Section -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pie Chart Job</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="jobChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pie Chart Training</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="trainingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        let jobChartInstance = null;
        let trainingChartInstance = null;
        
        function updateChart(data) {
            const jobCanvas = document.getElementById("jobChart");
            const trainingCanvas = document.getElementById("trainingChart");

            if (jobChartInstance) jobChartInstance.destroy();
            if (trainingChartInstance) trainingChartInstance.destroy();

            // Cek apakah semua nilai dalam data.job.values adalah 0
            const jobValues = data.job.values || [];
            const trainingValues = data.training.values || [];

            const allJobValuesZero = jobValues.every(value => value === 0);
            const allTrainingValuesZero = trainingValues.every(value => value === 0);

            // Jika semua nilai adalah 0, tambahkan kategori "No Data"
            const jobLabels = allJobValuesZero ? ["No Data"] : data.job.labels;
            const trainingLabels = allTrainingValuesZero ? ["No Data"] : data.training.labels;

            const jobDataset = allJobValuesZero ? [1] : jobValues;
            const trainingDataset = allTrainingValuesZero ? [1] : trainingValues;

            // Fungsi untuk mendapatkan warna dinamis
            function getDynamicColors(data) {
                const colors = ["#F05537", "#0000FF", "#FF0000", "#36A2EB", "#FFCE56"];
                let colorArray = [];

                data.forEach((value, index) => {
                    colorArray.push(colors[index % colors.length]);
                });

                return colorArray;
            }

            // Mendapatkan warna dinamis untuk job dan training
            const jobBackgroundColors = allJobValuesZero 
                ? ["black"] 
                : getDynamicColors(jobValues);
            
            const trainingBackgroundColors = allTrainingValuesZero 
                ? ["black"] 
                : getDynamicColors(trainingValues);

            // Buat Chart Job
            jobChartInstance = new Chart(jobCanvas, {
                type: "pie",
                data: {
                    labels: jobLabels,
                    datasets: [{
                        data: jobDataset,
                        backgroundColor: jobBackgroundColors
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return allJobValuesZero ? "No Data" : `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            });

            // Buat Chart Training
            trainingChartInstance = new Chart(trainingCanvas, {
                type: "pie",
                data: {
                    labels: trainingLabels,
                    datasets: [{
                        data: trainingDataset,
                        backgroundColor: trainingBackgroundColors
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return allTrainingValuesZero ? "No Data" : `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        }



        function fetchChartData(dateRange = "", filter = "all") {
            if (!dateRange || dateRange.trim() === "") {
                console.warn("⚠️ Date Range kosong, menggunakan default!");
                dateRange = ""; // Default jika kosong
            }

            const url = `/get-chart-data?dateRange=${encodeURIComponent(dateRange)}&filter=${encodeURIComponent(filter)}`;
            console.log("📡 Fetching URL:", url); // Debugging URL

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                
                    updateChart(data);
                })
                .catch(error => console.error("❌ Error fetching chart data:", error));
        }

        // Load data pertama kali saat halaman dimuat
        fetchChartData();

            // ✅ Event listener filter form
            const filterForm = document.getElementById("filterForm");

            if (filterForm) {
                filterForm.addEventListener("submit", function (e) {
                    e.preventDefault();

                    let dateRange = document.getElementById("dateRange").value;
                    let filter = document.getElementById("filterDropdown").value;

                    console.log("📌 Selected Date Range:", dateRange);
                    console.log("📌 Selected Filter:", filter);

                    fetchChartData(dateRange, filter);
                });
            } else {
                console.error("❌ Form tidak ditemukan!");
            }
        });

        // ✅ Date Range Picker Initialization
        $(document).ready(function () {
            if ($.fn.daterangepicker) {
                console.log("📅 Date Range Picker Loaded!");

                $('#dateRange').daterangepicker({
                    autoUpdateInput: false,
                    locale: { cancelLabel: 'Clear' }
                });

                $('#dateRange').on('apply.daterangepicker', function (ev, picker) {
                    let selectedDateRange = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
                    console.log("📅 Selected Date Range:", selectedDateRange);
                    $(this).val(selectedDateRange);
                });

                $('#dateRange').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });
            } else {
                console.error("❌ Date Range Picker is not loaded!");
            }
        });

    </script>
    
    @push('page-specific-scripts')
        
    @endpush
@endsection
