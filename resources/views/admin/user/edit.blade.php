<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">
                            <form class="my-4" action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                     <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}">
                                    </div>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-outline">
                                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    </div>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        Phone No.
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}">
                                    </div>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">
                                        Address
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $user->location }}">
                                    </div>

                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">
                                        Role <span class="text-danger">*</span>
                                    </label>

                                    @foreach ($roles as $role)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="{{ $role->name }}" value="{{ $role->name }}" {{ ($user->roles->pluck('name')->first() == $role->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $role->name }}">{{ Str::ucfirst($role->name) }}</label>
                                        </div>
                                    @endforeach

                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('users.index') }}" class="btn btn-danger mr-2">Back</a>
                                    <button type="submit" class="btn btn-success ms-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
