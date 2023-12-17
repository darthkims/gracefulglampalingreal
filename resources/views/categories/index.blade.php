<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="categories"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Categories"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="mb-0">Categories</h2>
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('categories.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Category
                                </a>
                            </div>
                        </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" style="color: white; background-color: red;">
                                    <strong>Success!</strong> {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NAME</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PRODUCT COUNT</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                UPDATED DATE</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $category->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $category->category_name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                     <!-- Count the number of products for the current category -->
                                                     <span class="text-secondary text-xs font-weight-bold">{{ $category->products->count() }}</span>
                                                 </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $category->updated_at->format('F j, Y, g:i A') }}</span>
                                                </td>                                               
                                                <td>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                        <a class="btn btn-secondary btn-link" href="{{ route('categories.edit', $category->id) }}">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <a class="btn btn-success btn-link" href="{{ route('categories.show', $category->id) }}">
                                                            <i class="material-icons">visibility</i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-link">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
