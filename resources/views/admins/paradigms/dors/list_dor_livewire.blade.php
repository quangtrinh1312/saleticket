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
                <button type="button" class="btn btn-info btn-sm" wire:click.prevent="$emit('openCreateDor')">
                    <i class="fa-solid fa-plus mr-1"></i>
                    Tạo mới
                </button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
        <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách Ký túc xá</span>
    </div>

    <div>
        <div class="mt-2 table-wrapper">
            <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
                <thead>
                    <th scope="col" class="text-center" style="width:5%">STT</th>
                    <th scope="col" class="text-center">Tên ký túc xá</th>
                    <th scope="col" class="text-center" style="width:15%">Thao tác</th>
                </thead>
                <tbody>
                    @if(isset($dors))
                    @if ($dors !== null && count($dors) > 0)
                    @php $sn = ($dors->perPage() * ($dors->currentPage() - 1)) + 1 @endphp
                        @foreach ($dors as $dor)
                            <tr>
                                <td scope="row" class="text-center">{{ $sn++ }}</td>
                                <td scope="row" class="text-uppercase text-left">{{ $dor->name }}</td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-success btn-icon legitRipple btn-sm" wire:click.prevent="$emit('openUpdateDor', {{$dor->id}})"><i class="icon-pencil" aria-hidden="true"></i></button>

                                    <button type="button" class="btn btn-danger btn-icon btn-sm" wire:click.prevent="$emit('openDeleteDor', {{$dor->id}})"><i class="icon-cross"></i></button>
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
            @if(isset($dors) && $dors !== null && count($dors) > 0)
                <span style="font-size: 15px;"><strong>Hiển thị {{ $dors->firstItem() }} - {{ $dors->lastItem() }} / Tổng {{ $dors->total() }}</strong></span>
            
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
        <!--                 <li class="page-item {{ $dors->currentPage() == 1 ? 'disabled' : '' }}">
                            <a href="?page=1" class="page-link">Đầu trang</a>
                        </li> -->
                        @if (isset($dors) && count($dors) > 0)
                            {{--{!! $dors->appends(Request::all())->links('helpers.paginate') !!}--}}

                            {!! $dors->links('helpers.livewire-paginate') !!}
                        @endif
        <!--                 <li class="page-item {{ $dors->currentPage() == $dors->lastPage() ? 'disabled' : '' }}">
                            <a href="?page={{ $dors->lastPage() }}" class="page-link">Cuối trang</a>
                        </li> -->
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>

