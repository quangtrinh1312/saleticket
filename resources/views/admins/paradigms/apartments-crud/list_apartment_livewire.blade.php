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
                <button type="button" class="btn btn-info btn-sm" wire:click.prevent="$emit('openCreateApartment')">
                    <i class="fa-solid fa-plus mr-1"></i>
                    Tạo mới
                </button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
        <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách chung cư</span>
    </div>

    <div>
        <div class="mt-2 table-wrapper">
            <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
                <thead>
                    <th scope="col" class="text-center">STT</th>
                    <th scope="col" class="text-center">Tên chung cư</th>
                    <th scope="col" class="text-center">Số lượng nhà
                        <a href="{{route('paradigms-blocks-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Số lượng tầng
                        <a href="{{route('paradigms-floors-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Số lượng căn hộ
                        <a href="{{route('paradigms-rooms-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Thao tác</th>
                </thead>
                <tbody>
                    @if(isset($apartments))
                    @if ($apartments !== null && count($apartments) > 0)
                    @php $sn = ($apartments->perPage() * ($apartments->currentPage() - 1)) + 1 @endphp
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td scope="row">{{ $sn++ }}</td>
                                <td scope="row" class="text-uppercase text-left">{{ $apartment->name }}</td>
                                <td scope="row" class="text-center">{{$apartment->block()->count()}}
                                <td scope="row" class="text-center">{{$apartment->floor()->count()}}</td>
                                <td scope="row" class="text-center">{{$apartment->room()->count()}}</td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-success btn-icon legitRipple btn-sm" wire:click.prevent="$emit('openUpdateApartment', {{$apartment->id}})"><i class="icon-pencil" aria-hidden="true"></i></button>

                                    <button type="button" class="btn btn-danger btn-icon btn-sm" wire:click.prevent="$emit('openDeleteApartment', {{$apartment->id}})"><i class="icon-cross"></i></button>
                                </td>
                            </tr>  
                        @endforeach
                    @else
                        <tr>
                            <td scope="row" colspan="6" class="text-center">(Không có dữ liệu)</td>
                        </tr>
                    @endif
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-2" id="links">
            @if(isset($apartments) && $apartments !== null && count($apartments) > 0)
                <span style="font-size: 15px;"><strong>Hiển thị {{ $apartments->firstItem() }} - {{ $apartments->lastItem() }} / Tổng {{ $apartments->total() }}</strong></span>
            
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
        <!--                 <li class="page-item {{ $apartments->currentPage() == 1 ? 'disabled' : '' }}">
                            <a href="?page=1" class="page-link">Đầu trang</a>
                        </li> -->
                        @if (isset($apartments) && count($apartments) > 0)
                            {{--{!! $apartments->appends(Request::all())->links('helpers.paginate') !!}--}}

                            {!! $apartments->links('helpers.livewire-paginate') !!}
                        @endif
        <!--                 <li class="page-item {{ $apartments->currentPage() == $apartments->lastPage() ? 'disabled' : '' }}">
                            <a href="?page={{ $apartments->lastPage() }}" class="page-link">Cuối trang</a>
                        </li> -->
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>

