<!-- Add script for Mapbox and address search -->
<script src="https://api.mapbox.com/mapbox-gl-js/v2.8.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.8.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css" />

<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="locations"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Locations"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">
                            <form class="my-4" action="{{ route('location.store') }}" method="POST">
                                @csrf
                                <!-- Add a map container -->
                                <div id="map" style="height: 400px;"></div>
                                <!-- Hidden input fields for latitude and longitude -->
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <!-- Existing input fields for location information -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Location Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="searchAddress">
                                    </div>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('location.index') }}" class="btn btn-danger mr-2">Back</a>
                                    <button type="submit" class="btn btn-success ms-2">Submit</button>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
        <script>
            mapboxgl.accessToken = '{{ config('app.mapbox') }}';
        
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [101.9758, 4.2105], // Default center for Malaysia
                zoom: 6
            });
        
            var geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl,
                countries: 'MY', // ISO 3166-1 alpha-2 country code for Malaysia
            });
        
            document.getElementById('searchAddress').appendChild(geocoder.onAdd(map));
        
            // Listen for the `result` event from the MapboxGeocoder
            geocoder.on('result', function (event) {
                var latitude = event.result.center[1];
                var longitude = event.result.center[0];
        
                // Update hidden input fields with latitude and longitude
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                // Update map center
                map.flyTo({
                    center: [longitude, latitude],
                    zoom: 14
                });
            });
        </script>           
    </main>
    <x-plugins></x-plugins>
</x-layout>
