<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">

                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="color: white;">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card my-4">
                    <div class=" me-3 my-3 d-flex justify-content-between align-items-center">
                            <h2 class="text-gradient text-dark mb-0 ms-3">Users</h2>
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('users.create') }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New User
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NAME</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ROLE</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DATE CREATED</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DATE UPDATED</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ACTION
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $user->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                      @if($user->roles->first()->name === 'customer')
                                                        <span class="badge bg-info">{{ Str::ucfirst($user->roles->first()->name) }}</span>
                                                      @elseif($user->roles->first()->name === 'admin')
                                                        <span class="badge bg-primary">{{ Str::ucfirst($user->roles->first()->name) }}</span>
                                                      @else
                                                          No role assigned
                                                      @endif
                                                    </h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">{{ date_format($user->created_at ,"d F Y H:i A") }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">{{ date_format($user->updated_at ,"d F Y H:i A") }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                   <a class="btn btn-secondary" href="{{ route('users.edit',$user->id) }}"><i class="material-icons">edit</i></a>
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="btn btn-danger"><i class="material-icons">close</i></button>
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
