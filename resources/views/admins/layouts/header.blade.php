@push('style')
    <style>
        .field-icon {
            float: right;
            margin-left: -25px;
            position: relative;
            top: 100%;
            transform: translateY(-70%);
            z-index: 5;
            cursor: pointer;
        }

        a.navbar-brand {
            min-width: 10rem !important;
            height: 4.5rem;
            flex: 1;
        }

        a.nav-link:hover,
        a.nav-link.active {
            -webkit-text-stroke-width: .5px;
            -webkit-text-stroke-color: white;
            color: white !important;
        }

        div[aria-labelledby="navbarDropdownMenuLink"] a:hover,
        div[aria-labelledby="navbarDropdownMenuLinkMobile"] a:hover {
            color: black !important;
        }

        div[aria-labelledby="navbarDropdownMenuLinkMobile1"] a:hover {
            color: black !important;
        }

        div.mobile-nav {
            background-color: rgba(0, 0, 0, 0);
            height: 100vh;
            z-index: 100;
            pointer-events: none;
            transition: .5s ease-in-out;
        }

        div.mobile-nav div.nav-container {
            min-width: 20rem;
            transform: translateX(100%);
            transition: .5s ease-in-out;
        }

        div.mobile-nav.active {
            background-color: rgba(0, 0, 0, .4);
            pointer-events: auto;
        }

        div.mobile-nav.active div.nav-container {
            transform: translateX(0);
        }

        @media only screen and (max-width: 25em) {
            div.mobile-nav div.nav-container {
                min-width: 17rem;
            }
        }
    </style>
@endpush

<div class="container-fluid bg-primary">
    @php
        if (!isset($config)) {
            $config = getConfig();
        }
    @endphp

    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="dropdown">
            <a class="navbar-brand d-block" style="height:auto;" href="!#" id="navbarTextDropdownmobile"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('images/logo_ship.jpg') }}" alt="" class="img-fluid"
                    style="width: 100px; height:100px;">
            </a>
            <!-- <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="navbarTextDropdownmobile">
                <a class="dropdown-item text-dark" href="!#">Đổi mật khẩu</a>
                <a class="dropdown-item text-dark" href="!#" data-toggle="modal" data-target="#reciptConfigModal">Cấu hình hóa đơn</a>
                <a class="dropdown-item text-dark" href="!#" data-toggle="modal" data-target="#reciptConfigModal">Cấu hình biên lai</a>
                <a class="dropdown-item text-dark" href="{{ route('get.admin.logout') }}">Đăng xuất</a>
            </div> -->
        </div>
        <button class="navbar-toggler" type="button" onclick="openMobileNav()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-uppercase">
                @can('Thống kê')
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ route('get.ticker.statistical', ['username' => Str::slug($config->name, '-') ?? '']) }}">Dashboard</a>
                    </li>
                @endcan
                @can('Bán vé')
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ route('get.ticker', ['username' => Str::slug($config->name, '-') ?? '']) }}">Bán vé</a>
                    </li>
                @endcan
                @can('Thống kê')
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ route('get.ticker.stat', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}">Thống
                            kê</a>
                    </li>
                @endcan
                @can('Soát vé')
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ route('get.ticker.check', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}">Soát
                            vé</a>
                    </li>
                @endcan

                <li class="nav-item dropdown desktop">
                    <a class="nav-link text-light" href="!#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Danh mục
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu bg-primary rounded-0 p-2" aria-labelledby="navbarDropdownMenuLink">
                        @can('Quản lý loại vé')
                            <a class="dropdown-item text-light"
                                href="{{ route('ticket-types.index', ['username' => Str::slug($config->name, '-') ?? '']) }}">Loại
                                vé</a>
                        @endcan
                        {{-- @can('Nhóm dịch vụ')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-light" href="!#">Nhóm dịch vụ</a>
                        @endcan --}}
                        @can('Quản lý tài khoản')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-light" href="{{ route('accounts.index') }}">Tài khoản</a>
                        @endcan
                        @can('Quản lý quyền hạn')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-light"
                                href="{{ route('get.permission', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}">Quản
                                lý quyền hạn</a>
                        @endcan
                    </div>
                </li>
            </ul>
        </div>

        <div class="navbar-text d-none d-xl-flex align-items-center">
            <div class="dropdown">
                <a class="text-light text-uppercase" href="!#" id="navbarTextDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    HỆ THỐNG VÉ SSS
                </a>
                <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="navbarTextDropdown">
                    <a class="dropdown-item text-dark" href="!#" data-toggle="modal"
                        data-target="#changePasswordModal">Đổi mật khẩu</a>
                    @if (Auth::user()->role_id == 1)
                        <a class="dropdown-item text-dark" href="!#" data-toggle="modal"
                            data-target="#reciptConfigModal">Cấu hình biên lai</a>
                    @endif
                    <a class="dropdown-item text-dark" href="{{ route('get.admin.logout') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container-fluid position-fixed mobile-nav p-0 d-lg-none d-flex justify-content-end">
    <div class="nav-container bg-primary h-100">
        <div class="w-100 d-flex justify-content-end">
            <button class="navbar-toggler text-light py-0" type="button" onclick="closeMobileNav()">
                <span style="font-size: 2rem;"><i class="fa-solid fa-xmark"></i></span>
            </button>
        </div>

        <nav class="navbar">
            <ul class="navbar-nav mt-2 mt-lg-0 text-uppercase flex-column w-100">
                @can('Thống kê')
                    <li class="nav-item">
                        <a class="nav-link text-light border-bottom"
                            href="{{ route('get.ticker.statistical', ['username' => Str::slug($config->name, '-') ?? '']) }}">Dashboard</a>
                    </li>
                @endcan
                @can('Bán vé')
                <li class="nav-item">
                    <a class="nav-link text-light border-bottom"
                        href="{{ route('get.ticker', ['username' => Str::slug($config->name, '-') ?? '']) }}">Bán
                        vé</a>
                </li>
                @endcan
                @can('Thống kê')
                <li class="nav-item">
                    <a class="nav-link text-light border-bottom"
                        href="{{ route('get.ticker.stat', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}">Thống
                        kê</a>
                </li>
                @endcan
                @can('Soát vé')
                    <li class="nav-item">
                        <a class="nav-link text-light border-bottom"
                            href="{{ route('get.ticker.check', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}">Soát
                            vé</a>
                    </li>
                    <li class="nav-item dropdown mobile">
                        <a class="nav-link text-light d-flex justify-content-between align-items-center border-bottom"
                            href="!#" id="navbarDropdownMenuLinkMobile" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Danh mục
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="shadow-none border-0 dropdown-menu bg-primary rounded-0 p-0 mt-0 ml-4"
                            aria-labelledby="navbarDropdownMenuLinkMobile">
                            @can('Quản lý loại vé')
                            <a class="dropdown-item text-light"
                                href="{{ route('ticket-types.index', ['username' => Str::slug($config->name, '-') ?? '']) }}">Loại
                                vé</a>
                            @endcan
                            {{-- @can('Nhóm dịch vụ')
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item text-light" href="!#">Nhóm dịch vụ</a>
                            @endcan --}}
                            @can('Quản lý tài khoản')
                            <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item text-light border-bottom"
                                    href="{{ route('accounts.index') }}">Tài khoản</a>
                            @endcan
                            @can('Quản lý quyền hạn')
                            <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item text-light border-bottom"
                                    href="{{ route('get.permission', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}">Quản lý quyền hạn</a>
                            @endcan
                            
                        </div>
                    </li>
                @endcan
                <li class="nav-item dropdown mobile1">
                    <a class="nav-link text-light d-flex justify-content-between align-items-center border-bottom"
                        href="!#" id="navbarDropdownMenuLinkMobile1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Cá nhân
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <div class="shadow-none border-0 dropdown-menu bg-primary rounded-0 p-0 mt-0 ml-4"
                        aria-labelledby="navbarDropdownMenuLinkMobile1">
                        <a class="dropdown-item text-light border-bottom" href="!#" data-toggle="modal"
                            data-target="#changePasswordModal">Đổi mật khẩu</a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item text-light" href="{{ route('get.admin.logout') }}">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>

@include('admins.layouts.modals.recipt-config-modal')
@include('admins.layouts.modals.change-password')
@push('script')
    <script>
        $(document).ready(() => {
            $('.dropdown.desktop').on('show.bs.dropdown', () => {
                $('#navbarDropdownMenuLink i').removeClass('fa-chevron-down').addClass('fa-chevron-up')
            })
            $('.dropdown.desktop').on('hide.bs.dropdown', () => {
                $('#navbarDropdownMenuLink i').removeClass('fa-chevron-up').addClass('fa-chevron-down')
            })
            $('.dropdown.mobile').on('show.bs.dropdown', () => {
                $('#navbarDropdownMenuLinkMobile').addClass('border-bottom')
                $('#navbarDropdownMenuLinkMobile i').removeClass('fa-chevron-down').addClass(
                    'fa-chevron-up')
            })
            $('.dropdown.mobile').on('hide.bs.dropdown', () => {
                // $('#navbarDropdownMenuLinkMobile').removeClass('border-bottom')
                $('#navbarDropdownMenuLinkMobile i').removeClass('fa-chevron-up').addClass(
                    'fa-chevron-down')
            })
            $('.dropdown.mobile1').on('show.bs.dropdown', () => {
                $('#navbarDropdownMenuLinkMobile1').addClass('border-bottom')
                $('#navbarDropdownMenuLinkMobile1 i').removeClass('fa-chevron-down').addClass(
                    'fa-chevron-up')
            })
            $('.dropdown.mobile1').on('hide.bs.dropdown', () => {
                // $('#navbarDropdownMenuLinkMobile').removeClass('border-bottom')
                $('#navbarDropdownMenuLinkMobile1 i').removeClass('fa-chevron-up').addClass(
                    'fa-chevron-down')
            })
        })

        function openMobileNav() {
            $('.mobile-nav').addClass('active')
        }

        function closeMobileNav(e) {
            $('.mobile-nav').removeClass('active')
        }
    </script>
@endpush
