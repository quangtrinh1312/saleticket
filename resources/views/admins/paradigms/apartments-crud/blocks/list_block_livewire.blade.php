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
                <button type="button" class="btn btn-info btn-sm" wire:click.prevent="$emit('openCreateBlock')">
                    <i class="fa-solid fa-plus mr-1"></i>
                    Tạo mới
                </button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
        <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách nhà</span>
    </div>

    <div>
        <div class="mt-2 table-wrapper">
            <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
                <thead>
                    <th scope="col" class="text-center">STT</th>
                    <th scope="col" class="text-center">Tên chung cư
                        <a href="{{route('paradigms-apartments-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Tên nhà</th>
                    <th scope="col" class="text-center">Số lượng tầng
                        <a href="{{route('paradigms-floors-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Số lượng căn hộ
                        <a href="{{route('paradigms-rooms-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Thao tác</th>
                </thead>
                <tbody>
                    @if(isset($blocks))
                    @if ($blocks !== null && count($blocks) > 0)
                    @php $sn = ($blocks->perPage() * ($blocks->currentPage() - 1)) + 1 @endphp
                        @foreach ($blocks as $block)
                            <tr>
                                <td scope="row">{{ $sn++ }}</td>
                                <td scope="row" class="text-uppercase text-left">{{ $block->apartment->name }}</td>
                                <td scope="row" class="text-center">{{$block->name}}
                                <td scope="row" class="text-center">{{$block->floor->count()}}</td>
                                <td scope="row" class="text-center">{{$block->room->count()}}</td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-success btn-icon legitRipple  btn-sm" wire:click.prevent="$emit('openUpdateBlock', {{$block->id}})"><i class="icon-pencil" aria-hidden="true"></i></button>

                                    <button type="button" class="btn btn-danger btn-icon btn-sm" wire:click.prevent="$emit('openDeleteBlock', {{$block->id}})"><i class="icon-cross"></i></button>
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
            @if(isset($blocks) && $blocks !== null && count($blocks) > 0)
                <span style="font-size: 15px;"><strong>Hiển thị {{ $blocks->firstItem() }} - {{ $blocks->lastItem() }} / Tổng {{ $blocks->total() }}</strong></span>
            
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
        <!--                 <li class="page-item {{ $blocks->currentPage() == 1 ? 'disabled' : '' }}">
                            <a href="?page=1" class="page-link">Đầu trang</a>
                        </li> -->
                        @if (isset($blocks) && count($blocks) > 0)
                            {{--{!! $blocks->appends(Request::all())->links('helpers.paginate') !!}--}}

                            {!! $blocks->links('helpers.livewire-paginate') !!}
                        @endif
        <!--                 <li class="page-item {{ $blocks->currentPage() == $blocks->lastPage() ? 'disabled' : '' }}">
                            <a href="?page={{ $blocks->lastPage() }}" class="page-link">Cuối trang</a>
                        </li> -->
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>

