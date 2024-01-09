<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="colors"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Colors"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">
                        <form class="my-4"
                      action="{{ route('colors.update', $color->id) }}"
                      method="POST">
                      @csrf
                      @method('PATCH')

                      <div class="mb-3">
                        <label for="name" class="form-label fw-bold">
                          Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-outline">
                        <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $color->name }}">
</div>
                          @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                      
                      <div class="d-flex justify-content-end">
                        <a href="{{ route('colors.index') }}" class="btn btn-danger mr-2">Back</a>
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
