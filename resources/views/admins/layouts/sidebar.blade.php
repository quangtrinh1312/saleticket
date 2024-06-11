<!-- Main sidebar -->
@php($auth = Auth::guard('account')->user())
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!--# User menu -->
        <div class="sidebar-section sidebar-user my-1">
            <div class="sidebar-section-body">
                <div class="media">
                    <a href="#" class="mr-3">
                        <img src="{{asset('global_assets/images/placeholders/placeholder.jpg')}}" class="rounded-circle" alt="">
                    </a>

                    <div class="media-body">
                        <div class="font-weight-semibold">{{ $auth ? $auth->fullname : 'Khách' }}</div>
                        <div class="font-size-sm line-height-sm opacity-50">
                            @if ($auth)
                                @if ($auth->role === 'admin')
                                    Quản trị viên
                                @elseif ($auth->role === 'accountant')
                                    Kế toán
                                @elseif ($auth->role === 'qlv')
                                    Quản lý viên
                                @else
                                    Bảo vệ
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="icon-transmission"></i>
                        </button>

                        <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                            <i class="icon-cross2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--# /user menu -->

        <!--# Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <!-- Kế toán -->
                @if ($auth->role !== 'protector')
                    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Quản lí chung</div> <i class="icon-menu" title="Main"></i></li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">
                            <i class="icon-home4"></i>
                            <span>
                                Trang chủ
                                <!-- <span class="d-block font-weight-normal opacity-50">No active orders</span> -->
                            </span>
                        </a>
                    </li>
                @endif
                
                @if ($auth->role === 'admin')
                    <li class="nav-item nav-item-submenu {{ Str::contains(url()->current(), 'admins/manage-accounts') ? 'nav-item-open' : '' }}">
                        <a href="#!" class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Quản lí tài khoản
                            </span>
                        </a>

                            <ul class="nav nav-group-sub {{ Str::contains(url()->current(), 'admins/manage-accounts') ? 'd-block' : '' }}" data-submenu-title="Layouts">
                                <li class="nav-item">
                                    <a href="{{ route('manage-accounts.index') }}" 
                                    class="nav-link {{ Str::contains(url()->current(), 'admins/manage-accounts') ? 'active' : '' }}">
                                    Danh sách
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{ route('manage-accountants.index') }}" 
                                    class="nav-link ">
                                    Quản lý Kế toán
                                    </a>
                                </li>
                            </ul>
                    </li>
                @endif
                
                @if ($auth->role === 'accountant' || $auth->role === 'admin')
                    @if ($auth->ktx === null)
                        <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}} hiden">
                            <a class="nav-link">
                                <i class="icon-cash3"></i>
                                <span>
                                    Quản lí công nợ
                                </span>
                            </a>

                            <ul class="nav nav-group-sub " style="{{ Session::get('open') == 'debt-controls.get' ? 'display: block;' : ''}}" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="#!" class="nav-link {{ Session::get('active') == 'debt-controls.get' ? 'active' : ''}}">Chung cư</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
                
                {{-- @if ($auth->role === 'admin')
                    <li class="nav-item {{ Str::contains(url()->current(), 'admins/manager-assignment') ? 'nav-item-open' : '' }}">
                        <a href="{{ route('manager-assignment.index') }}" class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Phân quyền quản lý
                            </span>
                        </a>

                    </li>
                @endif --}}

                @if ($auth->role !== 'protector')
                    @if ($auth->ktx === null)
                    <!-- Kế toán -->
                    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Quản lí danh mục</div> <i class="icon-menu" title="Main"></i></li>

                    {{-- 1 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'paradigm_1' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Chung cư
                            </span>
                        </a>

                        <ul class="nav nav-group-sub {{ Session::get('open') == 'paradigm_1' ? 'd-block' : ''}}" data-submenu-title="Layouts" >
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 1, 'household_type' => 1])}}" class="nav-link {{ Session::get('active') == 'crud_house_hold_1' ? 'active' : ''}}">Hộ dân</a></li>
                            <li class="nav-item"><a href="{{route('paradigms-apartments-crud.index', ['paradigm_id' => 1])}}" class="nav-link {{ Session::get('active') == 'crud_apartment_1' ? 'active' : ''}} ">Chung cư, nhà, tầng</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.type.price')}}" class="nav-link {{ Session::get('active') == 'crud_type_price_1' ? 'active' : ''}}">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.statistical', ['paradigm_id' => 1])}}" class="nav-link {{ Session::get('active') == 'crud_statistical_1' ? 'active' : ''}}">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 1, 'household_type' => 1])}}" class="nav-link {{ Session::get('active') == 'crud_get_collect_1' ? 'active' : ''}}">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.history', ['paradigm_id' => 1])}}" class="nav-link {{ Session::get('active') == 'crud_history_1' ? 'active' : ''}}">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- 2 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Nhà dân
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 2, 'household_type' => 2])}}" class="nav-link ">Hộ dân</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.people.house.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.people.house.statistical', ['paradigm_id' => 2])}}" class="nav-link ">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 2, 'household_type' => 2])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.people.house.history', ['paradigm_id' => 2])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- 3 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Nhà cơ quan
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 3, 'household_type' => 2])}}" class="nav-link ">Hộ dân</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.agency.house.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.agency.house.statistical', ['paradigm_id' => 3])}}" class="nav-link ">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 3, 'household_type' => 2])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.agency.house.history', ['paradigm_id' => 3])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- 4 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Nhà bán thuộc SHNN
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-apartments-crud.index', ['paradigm_id' => 4])}}" class="nav-link {{ Session::get('active') == 'crud_apartment_1' ? 'active' : ''}} ">Chung cư, nhà, tầng</a></li>

                            <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                                <a class="nav-link">
                                    <!-- <i class="icon-cash3"></i> -->
                                    <span>
                                        Hộ dân
                                    </span>
                                </a>

                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 4, 'household_type' => 1])}}" class="nav-link ">Chung cư</a></li>
                                    <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 4, 'household_type' => 2])}}" class="nav-link ">Địa chỉ</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{route('get.paradigms.house.sell.shnn.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                                <a class="nav-link">
                                    <!-- <i class="icon-cash3"></i> -->
                                    <span>
                                        Thống kê thu tiền
                                    </span>
                                </a>

                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('get.paradigms.house.sell.shnn.statistical', ['paradigm_id' => 4, 'household_type' => 1])}}" class="nav-link ">Chung cư</a></li>
                                    <li class="nav-item"><a href="{{route('get.paradigms.house.sell.shnn.statistical', ['paradigm_id' => 4, 'household_type' => 2])}}" class="nav-link ">Địa chỉ</a></li>
                                </ul>
                            </li>
                            @endif

                            <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                                <a class="nav-link">
                                    <!-- <i class="icon-cash3"></i> -->
                                    <span>
                                        Thu tiền
                                    </span>
                                </a>

                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 4, 'household_type' => 1])}}" class="nav-link ">Chung cư</a></li>
                                    <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 4, 'household_type' => 2])}}" class="nav-link ">Địa chỉ</a></li>
                                </ul>
                            </li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                                <a class="nav-link">
                                    <!-- <i class="icon-cash3"></i> -->
                                    <span>
                                        Lịch sử thu tiền
                                    </span>
                                </a>

                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('get.paradigms.house.sell.shnn.history', ['paradigm_id' => 4, 'household_type' => 1])}}" class="nav-link ">Chung cư</a></li>
                                    <li class="nav-item"><a href="{{route('get.paradigms.house.sell.shnn.history', ['paradigm_id' => 4, 'household_type' => 2])}}" class="nav-link ">Địa chỉ</a></li>
                                </ul>
                            </li>
                        
                            @endif
                        </ul>
                    </li>

                    {{-- 5 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Chung cư 201 Đống Đa
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 5, 'household_type' => 1])}}" class="nav-link ">Hộ dân</a></li>
                            <li class="nav-item"><a href="{{route('paradigms-apartments-crud.index', ['paradigm_id' => 5])}}" class="nav-link ">Chung cư, nhà, tầng</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.201.dong.da.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.201.statistical', ['paradigm_id' => 5])}}" class="nav-link ">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 5, 'household_type' => 1])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.201.history', ['paradigm_id' => 5])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- 6 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Nhà ở công nhân
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 6, 'household_type' => 1])}}" class="nav-link ">Hộ dân</a></li>
                            <li class="nav-item"><a href="{{route('paradigms-apartments-crud.index', ['paradigm_id' => 6])}}" class="nav-link ">Chung cư, nhà, tầng</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.worker.housing.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.worker.housing.statistical', ['paradigm_id' => 6])}}" class="nav-link ">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 6, 'household_type' => 1])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv' )
                            <li class="nav-item"><a href="{{route('get.paradigms.apartment.worker.housing.history', ['paradigm_id' => 6])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    {{-- 7 --}}
                    <li class="nav-item nav-item-submenu {{ Str::contains(url()->current(), ['admins/ticket/sale', 'admins/ticket/invoice-view', 'admins/ticket/statistic', 'admins/ticket/ticket-type']) ? 'nav-item-open' : '' }}">
                        <a href="#!" class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Kí túc xá
                            </span>
                        </a>

                        <ul class="nav nav-group-sub {{ Str::contains(url()->current(), ['admins/ticket/sale', 'admins/ticket/invoice-view', 'admins/ticket/statistic', 'admins/ticket/ticket-type']) ? 'd-block' : '' }}" data-submenu-title="Layouts">
                            <!-- Quản lí viên -->
                            @if ($auth->role !== 'qlv')
                                {{-- @if ($auth->role !== 'protector')
                                    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Quản lí các mục khác</div> <i class="icon-menu" title="Main"></i></li>
                                @endif --}}

                                <li class="nav-item nav-item-submenu {{ Str::contains(url()->current(), ['admins/ticket/sale', 'admins/ticket/invoice-view', 'admins/ticket/statistic', 'admins/ticket/ticket-type']) ? 'nav-item-open' : '' }}">
                                    @if ($auth->role !== 'protector')
                                        <a href="#!" class="nav-link">
                                            {{-- <i class="fa-solid fa-ticket"></i> --}}
                                            <span>
                                                Vé xe
                                                <!-- <span class="d-block font-weight-normal opacity-50">No active orders</span> -->
                                            </span>
                                        </a>
                                    @endif
                                    <ul class="nav nav-group-sub {{ Str::contains(url()->current(), ['admins/ticket/sale', 'admins/ticket/invoice-view', 'admins/ticket/statistic', 'admins/ticket/ticket-type']) ? 'd-block' : '' }}" data-submenu-title="Layouts">
                                        @if ($auth->role !== 'protector')
                                            <li class="nav-item">
                                                <a href="{{ url('/admins/ticket/statistic') }}"
                                                    class="nav-link {{ Str::contains(url()->current(), 'admins/ticket/statistic') ? 'active' : '' }}">
                                                    Thống kê
                                                </a>
                                            </li>
                                        @endif
                                        @if ($auth->ktx !== null)
                                            <li class="nav-item">
                                                <a href="{{ url('/admins/ticket/sale') }}"
                                                    class="nav-link {{ Str::contains(url()->current(), 'admins/ticket/sale') ? 'active' : '' }}">
                                                    Bán vé
                                                </a>
                                            </li>
                                        @endif
                                        @if ($auth->role !== 'protector')
                                            <li class="nav-item">
                                                <a href="{{ url('/admins/ticket/invoice-view') }}"
                                                    class="nav-link {{ Str::contains(url()->current(), 'admins/ticket/invoice-view') ? 'active' : '' }}">
                                                    Xem hóa đơn
                                                </a>
                                            </li>
                                            @if ($auth->role == 'admin')
                                                <li class="nav-item">
                                                    <a href="{{ url('/admins/ticket/ticket-type') }}"
                                                        class="nav-link {{ Str::contains(url()->current(), 'admins/ticket/ticket-type') ? 'active' : '' }}">
                                                        Loại vé
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                                @if ($auth->ktx === null)
                                    <li class="nav-item"><a href="{{route('paradigms-dors-crud.index', ['paradigm_id' => 7])}}" class="nav-link ">Kí túc</a></li>
                                    <li class="nav-item"><a href="{{route('get.paradigms.dor.type.price')}}" class="nav-link ">Loại tiền</a></li>
                                    <li class="nav-item"><a href="{{route('get.paradigms.dor.statistical', ['paradigm_id' => 7])}}" class="nav-link ">Thống kê thu tiền</a></li>
                                @endif
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 7, 'household_type' => 0])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.dor.history', ['paradigm_id' => 7])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>

                    @if ($auth->ktx === null)
                    {{-- 8 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Thuê mặt bằng
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('paradigms-house-holds-crud.index', ['paradigm_id' => 8, 'household_type' => 2])}}" class="nav-link ">Hộ dân</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.rent.ground.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.rent.ground.statistical', ['paradigm_id' => 8])}}" class="nav-link ">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 8, 'household_type' => 2])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.rent.ground.history', ['paradigm_id' => 8])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- 9 --}}
                    <li class="nav-item nav-item-submenu {{ Session::get('open') == 'collect-money.get' ? 'nav-item-open' : ''}}">
                        <a class="nav-link">
                            <i class="icon-cash3"></i>
                            <span>
                                Các khoản thu khác
                            </span>
                        </a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <!-- <li class="nav-item"><a href="#!" class="nav-link ">Thống kê chung</a></li> -->
                            @if ($auth->role === 'accountant' || $auth->role === 'admin')
                            <li class="nav-item"><a href="{{route('get.paradigms.other.amount.type.price')}}" class="nav-link ">Loại tiền</a></li>
                            <li class="nav-item"><a href="{{route('get.paradigms.other.amount.statistical', ['paradigm_id' => 9])}}" class="nav-link ">Thống kê thu tiền</a></li>
                            @endif
                            <li class="nav-item"><a href="{{route('get.paradigms.collect', ['paradigm_id' => 9, 'household_type' => 2])}}" class="nav-link ">Thu tiền</a></li>
                            @if ($auth->role === 'admin' || $auth->role === 'qlv')
                            <li class="nav-item"><a href="{{route('get.paradigms.other.amount.history', ['paradigm_id' => 9])}}" class="nav-link ">Lịch sử thu tiền</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif

                


                {{-- <li class="nav-item">
                    <a href="{{ url('/admins/receipt') }}" class="nav-link {{ Str::contains(url()->current(), 'admins/receipt') ? 'active' : '' }}">
                        <i class="fa-solid fa-receipt"></i>
                        <span>
                            Hóa đơn
                            <!-- <span class="d-block font-weight-normal opacity-50">No active orders</span> -->
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admins/invoice') }}" class="nav-link {{ Str::contains(url()->current(), 'admins/invoice') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>
                            Biên lai
                            <!-- <span class="d-block font-weight-normal opacity-50">No active orders</span> -->
                        </span>
                    </a>
                </li> --}}


                {{-- Danh mục khác --}}
                {{-- <li class="nav-item nav-item-submenu {{ Str::contains(url()->current(), ['admins/categories/accountant', 'admins/categories/qlv', 'admins/categories/apartment', 'admins/categories/household']) ? 'nav-item-open' : '' }}">
                    <a href="#!" class="nav-link">
                        <i class="icon-stack3"></i>
                        <span>
                            Danh mục khác
                        </span>
                    </a>
                    <ul class="nav nav-group-sub {{ Str::contains(url()->current(), ['admins/categories/accountant', 'admins/categories/qlv', 'admins/categories/apartment', 'admins/categories/household']) ? 'd-block' : '' }}" data-submenu-title="Layouts">
                        <li class="nav-item">
                            <a href="{{ url('/admins/categories/accountant') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/categories/accountant') ? 'active' : '' }}">
                                Kế toán
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/categories/qlv') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/categories/qlv') ? 'active' : '' }}">
                                Quản lý viên
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/categories/apartment') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/categories/apartment') ? 'active' : '' }}">
                                Chung cư
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/categories/household') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/categories/household') ? 'active' : '' }}">
                                Hộ dân
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- Thu tiền --}}
                {{-- <li class="nav-item nav-item-submenu {{ Str::contains(url()->current(), ['admins/collect-money/apartment', 'admins/collect-money/people-house', 'admins/collect-money/agency-house', 'admins/collect-money/house-sell-shnn', 'admins/collect-money/apartment-201-dong-da', 'admins/collect-money/worker-housing', 'admins/collect-money/dorm', 'admins/collect-money/rent-ground', 'admins/collect-money/other-amount']) ? 'nav-item-open' : '' }}">
                    <a href="#!" class="nav-link">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        <span>
                            Thu tiền
                        </span>
                    </a>
                    <ul class="nav nav-group-sub {{ Str::contains(url()->current(), ['admins/collect-money/apartment', 'admins/collect-money/people-house', 'admins/collect-money/agency-house', 'admins/collect-money/house-sell-shnn', 'admins/collect-money/apartment-201-dong-da', 'admins/collect-money/worker-housing', 'admins/collect-money/dorm', 'admins/collect-money/rent-ground', 'admins/collect-money/other-amount']) ? 'd-block' : '' }}" data-submenu-title="Layouts">
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/apartment') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/apartment') ? 'active' : '' }}">
                                Chung cư
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/people-house') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/people-house') ? 'active' : '' }}">
                                Nhà dân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/agency-house') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/agency-house') ? 'active' : '' }}">
                                Nhà cơ quan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/house-sell-shnn') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/house-sell-shnn') ? 'active' : '' }}">
                                Nhà bán thuộc SHNN
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/apartment-201-dong-da') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/apartment-201-dong-da') ? 'active' : '' }}">
                                Chung cư 201 Đống Đa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/worker-housing') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/worker-housing') ? 'active' : '' }}">
                                Nhà ở công nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/dorm') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/dorm') ? 'active' : '' }}">
                                Ký túc xá
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/rent-ground') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/rent-ground') ? 'active' : '' }}">
                                Thuê mặt bằng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admins/collect-money/other-amount') }}" 
                                class="nav-link {{ Str::contains(url()->current(), 'admins/collect-money/other-amount') ? 'active' : '' }}">
                                Thu các khoản khác
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <!--# /page kits -->

            </ul>
        </div>
        <!--# /main navigation -->
    </div>
    <!-- /sidebar content -->
</div>
<!-- /main sidebar -->
