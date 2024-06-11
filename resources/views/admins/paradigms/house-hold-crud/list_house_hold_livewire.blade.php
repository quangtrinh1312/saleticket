<div>
    <div class="mt-3">
        <div class="d-flex justify-content-between">
            <div>
                <select class="form-control custom-select" wire:model="paginate">
                    <option value="5">5 hàng</option>
                    <option value="10">10 hàng</option>
                    <option value="15">15 hàng</option>
                    <option value="20">20 hàng</option>
                </select>
            </div>
            <div>
                <button type="button" class="btn btn-info btn-sm" wire:click.prevent="$emit('openCreateHouseHold')">
                    <i class="fa-solid fa-plus mr-1"></i>
                    Tạo mới
                </button>
                {{-- <button type="button" class="btn btn-info btn-sm" wire:click.prevent="$emit('openAssignHouseHold')">
                    Phân quyền quản lý Hộ dân
                </button> --}}
                <a class="btn btn-info btn-sm" href="{{ route('manager-assignment.index', ['paradigm_id' => $paradigmId, 'household_type' => $householdType]) }}">
                    Danh sách Quản lý viên
                </a>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
        <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách Hộ dân</span>
    </div>

    <div>
        <div class="mt-2 table-wrapper">
            <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
                <thead>
                    <th scope="col" class="text-center">STT</th>
                    @if ($householdType == 1)
                    <th scope="col" class="text-center">Tên chung cư</th>
                    <th scope="col" class="text-center">Tên nhà</th>
                    <th scope="col" class="text-center">Tầng</th>
                    <th scope="col" class="text-center">Căn hộ</th>
                    @elseif ($householdType == 2)
                    <th scope="col" class="text-center">Quận/Huyện</th>
                    <th scope="col" class="text-center">Phường/Xã</th>
                    <th scope="col" class="text-center">Số nhà</th>
                    <th scope="col" class="text-center">Tên đường</th>
                    @endif
                    <th scope="col" class="text-center">Tên hộ dân</th>
                    <th scope="col" class="text-center">Số điện thoại</th>
                    <th scope="col" class="text-center">Thao tác</th>
                </thead>
                <tbody>
                    @if(isset($households))
                    @if ($households !== null && count($households) > 0)
                    @php $sn = ($households->perPage() * ($households->currentPage() - 1)) + 1 @endphp
                        @foreach ($households as $household)
                            <tr>
                                <td scope="row">{{ $sn++ }}</td>
                                @if ($householdType == 1)
                                <td scope="row" class="text-left text-uppercase">{{ $household->apartment->name ?? '' }}</td>
                                <td scope="row" class="text-center">{{$household->block->name ?? ''}}</td>
                                <td scope="row" class="text-center">{{$household->floor->name ?? ''}}</td>
                                <td scope="row" class="text-center">{{$household->room->name ?? ''}}</td>
                                @elseif ($householdType == 2)
                                <td scope="row" class="text-center">{{$household->district->name ?? ''}}</td>
                                <td scope="row" class="text-center">{{$household->ward->name ?? ''}}</td>
                                <td scope="row" class="text-center">{{$household->apartment_number ?? ''}}</td>
                                <td scope="row" class="text-center">{{$household->street ?? ''}}</td>
                                @endif
                                <td scope="row" class="text-left text-capitalize">{{$household->fullname ?? ''}}</td>
                                <td scope="row" class="text-center">{{$household->phone_number ?? ''}}</td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-success btn-icon legitRipple btn-sm" wire:click.prevent="$emit('openUpdateHouseHold', {{$household->id}})"><i class="icon-pencil" aria-hidden="true"></i></button>

                                    <button type="button" class="btn btn-danger btn-icon btn-sm" wire:click.prevent="$emit('openDeleteHouseHold', {{$household->id}})"><i class="icon-cross"></i></button>
                                </td>
                            </tr>  
                        @endforeach
                    @else
                        <tr>
                            <td scope="row" colspan="8" class="text-center">(Không có dữ liệu)</td>
                        </tr>
                    @endif
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-2" id="links">
            @if(isset($households) && $households !== null && count($households) > 0)
                <span style="font-size: 15px;"><strong>Hiển thị {{ $households->firstItem() }} - {{ $households->lastItem() }} / Tổng {{ $households->total() }}</strong></span>
            
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
        <!--                 <li class="page-item {{ $households->currentPage() == 1 ? 'disabled' : '' }}">
                            <a href="?page=1" class="page-link">Đầu trang</a>
                        </li> -->
                        @if (isset($households) && count($households) > 0)
                            {{--{!! $households->appends(Request::all())->links('helpers.paginate') !!}--}}

                            {!! $households->links('helpers.livewire-paginate') !!}
                        @endif
        <!--                 <li class="page-item {{ $households->currentPage() == $households->lastPage() ? 'disabled' : '' }}">
                            <a href="?page={{ $households->lastPage() }}" class="page-link">Cuối trang</a>
                        </li> -->
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>
