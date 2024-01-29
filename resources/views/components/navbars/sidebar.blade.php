@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('admin.home') }} ">
            <img src="{{ asset('customer') }}/img/gg_square.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Graceful Glam Admin Hub</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('admin.home') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-- Customer Navs -->
            @role('customer')
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'products' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('cust.products.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory_2</i>
                        </div>
                        <span class="nav-link-text ms-1">Products</span>
                    </a>
                </li>
            @endrole

            <!-- Admin Navs -->
            @role('admin')
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'users' ? ' active bg-gradient-primary' : '' }} "
                        href="{{ route('users.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'carts' ? ' active bg-gradient-primary' : '' }} "
                        href="{{ route('carts.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">shopping_cart</i>
                        </div>
                        <span class="nav-link-text ms-1">Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'categories' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('categories.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">list_alt</i>
                        </div>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'products' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('admin.products.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory_2</i>
                        </div>
                        <span class="nav-link-text ms-1">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'brands' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('brands.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">checkroom</i>
                        </div>
                        <span class="nav-link-text ms-1">Brands</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'sizes' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('sizes.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">checkroom</i>
                        </div>
                        <span class="nav-link-text ms-1">Sizes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'roles' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('roles.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person_search</i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'colors' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('colors.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">colorize</i>
                        </div>
                        <span class="nav-link-text ms-1">Colors</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'locations' ? ' active bg-gradient-primary' : '' }}  "
                        href="{{ route('location.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">map</i>
                        </div>
                        <span class="nav-link-text ms-1">Store Locations</span>
                    </a>
                </li>
            @endrole
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary w-100" href="{{ route('main') }}" target="_blank">Main page</a>
        </div>
        <!-- <div class="mx-3">
            <a class="btn bg-gradient-primary w-100" href="#" target="_blank">NAK ISI APA NI</a>
        </div>
        <div class="mx-3">
            <a class="btn bg-gradient-primary w-100"
                href="#" target="_blank" type="button">NAK ISI APA NI</a>
        </div>
    </div> -->

</aside>

