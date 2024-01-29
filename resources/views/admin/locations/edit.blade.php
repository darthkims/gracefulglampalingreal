<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<style>
    #map {
        width: 100%;
        margin-bottom: 15px;
    }

    .input-group-outline {
        margin-bottom: 15px;
    }
</style>

<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="locations"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Location"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">
                            <form class="my-4" action="{{ route('location.update', $location->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <!-- Add an input field for the address search -->
                                <div class="mb-3">
                                    <label for="searchAddress" class="form-label">
                                        Search Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <select class="form-control select2" name="address" id="searchAddress" style="width: 100%;">
                                            <!-- Options will be dynamically added by Select2 -->
                                        </select>
                                    </div>
                                </div>

                                <!-- Add a map container -->
                                <div id="map" style="height: 400px;"></div>

                                <!-- Existing input fields for location information -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Location Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $location->name) }}">
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- ... (other input fields) -->

                                <div class="mb-3">
                                    <label for="latitude" class="form-label">
                                        Latitude
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude', $location->latitude) }}">
                                    </div>
                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="longitude" class="form-label">
                                        Longitude
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude', $location->longitude) }}">
                                    </div>
                                    @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('location.index') }}" class="btn btn-danger mr-2">Back</a>
                                    <button type="submit" class="btn btn-success ms-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        
        <!-- Add script for OpenStreetMap API integration -->
        <script>
            $(document).ready(function() {
        
                var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 13);
                // Set the initial map view based on database values
        
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
        
                var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);
                // Add a marker to the initial location
        
                // Update latitude and longitude inputs
                $('input[name="latitude"]').val({{ $location->latitude }});
                $('input[name="longitude"]').val({{ $location->longitude }});
        
                // Set the default value for the search input to the address from the database
                $('#searchAddress').val("{{ $location->address }}").trigger('change');
        
                // Function to search for an address and update the map and marker
                function updateMapAndMarker(address) {
                    var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + address;
        
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data && data.length > 0) {
                                var latitude = parseFloat(data[0].lat);
                                var longitude = parseFloat(data[0].lon);
        
                                // Update map view and marker
                                map.setView([latitude, longitude], 13);
                                if (marker) {
                                    marker.setLatLng([latitude, longitude]);
                                } else {
                                    marker = L.marker([latitude, longitude]).addTo(map);
                                }
        
                                // Update latitude and longitude inputs
                                $('input[name="latitude"]').val(latitude);
                                $('input[name="longitude"]').val(longitude);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', status, error);
                        }
                    });
                }
        
                // Listen for input changes in the searchAddress field
                $('#searchAddress').on('input', function() {
                    var address = $(this).val();
                    if (address.length >= 3) {
                        updateMapAndMarker(address);
                    }
                });
        
                // Initialize Select2 after setting the default value
                $('#searchAddress').select2({
                    placeholder: 'Type to search...',
                    minimumInputLength: 3,
                    ajax: {
                        url: 'https://nominatim.openstreetmap.org/search?format=json',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term,
                                limit: 10
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.display_name,
                                        id: item.display_name,
                                        latitude: item.lat,
                                        longitude: item.lon
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
        
                // Handle selection change
                $('#searchAddress').on('select2:select', function(e) {
                    var selectedData = e.params.data;
                    $('input[name="latitude"]').val(selectedData.latitude);
                    $('input[name="longitude"]').val(selectedData.longitude);
                });
        
            });
        </script>                    
    </main>
</x-layout>
