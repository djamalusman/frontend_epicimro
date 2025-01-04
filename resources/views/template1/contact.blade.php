@extends('layouts.app')
@section('title')
    HOME
@endsection

@section('content')
<style>
    #map {
        height: 500px;
        width: 100%;
    }
    /* CSS untuk popup tetap terbuka */
    .leaflet-popup {
        max-width: 300px; /* Sesuaikan dengan kebutuhan Anda */
    }
</style>
    <!-- **************** MAIN CONTENT START **************** -->

        <div class="container wide mb-50">
            <div class="border-radius-15 overflow-hidden">
                <div id="map" class="leaflet-map"></div>
            </div>
        </div>
        <div class="container mt-90 mt-md-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="mb-50">

                        <div class="row">
                            <div class="col-xl-9 col-md-12 mx-auto">
                                <div class="contact-from-area padding-20-row-col">

                                    <form class="contact-form-style mt-80" id="contact-form" action="#" method="post">
                                        <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="name" placeholder="First Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="email" placeholder="Your Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="telephone" placeholder="Your Phone" type="tel" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="subject" placeholder="Subject" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 text-center">
                                                <div class="textarea-style mb-30">
                                                    <textarea name="message" placeholder="Message"></textarea>
                                                </div>
                                                <button class="submit submit-auto-width" type="submit">Send
                                                    message</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </div>
                    </section>
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
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            // Koordinat default
            var defaultLatitude = -6.2572506;
            var defaultLongitude = 106.846076;

            // Inisialisasi peta
            var map = L.map('map').setView([defaultLatitude, defaultLongitude], 13);

            // Menambahkan layer tile
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Data lokasi dari controller
            var locations = @json($locations);

            console.log(locations); // Debug: Periksa data lokasi

            // Array untuk menyimpan semua marker
            var markers = [];

            // Menambahkan marker dan popup untuk setiap lokasi
            locations.forEach(function(location) {
                var latitude = location.latitude;
                var longitude = location.longitude;
                var nama = location.nama;
                var popupContent =  nama;

                // Tambahkan marker ke peta
                var marker = L.marker([latitude, longitude]).addTo(map);

                // Tambahkan popup ke marker
                marker.bindPopup(popupContent);

                // Buka popup secara otomatis
                marker.openPopup();

                // Simpan marker dalam array
                markers.push(marker);
            });

            // Zoom ke semua marker
            if (markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds());
            }
        </script>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection
