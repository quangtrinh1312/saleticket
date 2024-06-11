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
                <button type="button" class="btn btn-info btn-sm" wire:click.prevent="$emit('openCreateFloor')">
                    <i class="fa-solid fa-plus mr-1"></i>
                    Tạo mới
                </button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
        <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách tầng</span>
    </div>

    <div>
        <div class="mt-2 table-wrapper">
            <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
                <thead>
                    <th scope="col" class="text-center">STT</th>
                    <th scope="col" class="text-center">Tên chung cư
                        <a href="{{route('paradigms-apartments-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Tên nhà
                        <a href="{{route('paradigms-blocks-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Tầng</th>
                    <th scope="col" class="text-center">Số lượng căn hộ
                        <a href="{{route('paradigms-rooms-crud.index',['paradigm_id' => $paradigmId])}}" class="float-left mr-1"><i class="far fa-eye"></i></a>
                    </th>
                    <th scope="col" class="text-center">Thao tác</th>
                </thead>
                <tbody>
                    @if(isset($floors))
                    @if ($floors !== null && count($floors) > 0)
                    @php $sn = ($floors->perPage() * ($floors->currentPage() - 1)) + 1 @endphp
                        @foreach ($floors as $floor)
                            <tr>
                                <td scope="row">{{ $sn++ }}</td>
                                <td scope="row" class="text-uppercase text-left">{{$floor->apartment->name }}</td>
                                <td scope="row" class="text-center">{{$floor->block->name}}
                                <td scope="row" class="text-center">{{$floor->name}}</td>
                                <td scope="row" class="text-center">{{$floor->room->count()}}</td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-success btn-icon legitRipple  btn-sm" wire:click.prevent="$emit('openUpdateFloor', {{$floor->id}})"><i class="icon-pencil" aria-hidden="true"></i></button>

                                    <button type="button" class="btn btn-danger btn-icon btn-sm" wire:click.prevent="$emit('openDeleteFloor', {{$floor->id}})"><i class="icon-cross"></i></button>
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
            @if(isset($floors) && $floors !== null && count($floors) > 0)
                <span style="font-size: 15px;"><strong>Hiển thị {{ $floors->firstItem() }} - {{ $floors->lastItem() }} / Tổng {{ $floors->total() }}</strong></span>
            
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
        <!--                 <li class="page-item {{ $floors->currentPage() == 1 ? 'disabled' : '' }}">
                            <a href="?page=1" class="page-link">Đầu trang</a>
                        </li> -->
                        @if (isset($floors) && count($floors) > 0)
                            {{--{!! $floors->appends(Request::all())->links('helpers.paginate') !!}--}}

                            {!! $floors->links('helpers.livewire-paginate') !!}
                        @endif
        <!--                 <li class="page-item {{ $floors->currentPage() == $floors->lastPage() ? 'disabled' : '' }}">
                            <a href="?page={{ $floors->lastPage() }}" class="page-link">Cuối trang</a>
                        </li> -->
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>
