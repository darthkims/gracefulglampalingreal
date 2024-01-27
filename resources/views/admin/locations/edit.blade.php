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
                            <form class="my-4" action="{{ route('locations.update', $location->id) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Location Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" value="{{ $location->name }}"
                                            class="form-control @error('name') is-invalid @enderror" name="name">
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">
                                        Address
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" value="{{ $location->address }}"
                                            class="form-control @error('address') is-invalid @enderror" name="address">
                                    </div>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="latitude" class="form-label">
                                        Latitude
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text"
