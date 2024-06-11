<div class="mt-2 table-wrapper">
    <table class="table table-hover table-dark table-striped mb-1">
        <thead>
            <th scope="col" style="width: 70px;">STT</th>
            <th scope="col">Loại tiền</th>
            <th scope="col">Loại biên nhận</th>
            <th scope="col" class="text-center" style="width: 70px;">Sửa</th>
            <th scope="col" class="text-center" style="width: 70px;">Xóa</th>
        </thead>
        <tbody>
            @php($sn = ($typePrices->perPage() * ($typePrices->currentPage() - 1)) + 1)
            @if ($typePrices !== null && count($typePrices) > 0)
                @foreach ($typePrices as $typePrice)
                    <tr>
                        <td scope="row">{{ $sn++ }}</td>
                        <td scope="row">{{ $typePrice->type }}</td>
                        <td scope="row">{{ $typePrice->typeReceipt != null ? $typePrice->typeReceipt->type : '' }}</td>
                        <td scope="row">
                            <center>
                                <button type="button" value="{{ $typePrice->id }}" class="btn btn-outline-success btn-sm" id="tp_btn_edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </center>
                        </td>
                        <td scope="row">
                            <center>
                                <button type="button" value="{{ $typePrice->id }}" class="btn btn-outline-danger btn-sm" id="tp_btn_delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </center>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<div class="mt-2" id="links">
    @if(count($typePrices) > 0)
        <span style="font-size: 15px;"><strong>Hiển thị {{ $typePrices->firstItem() }} - {{ $typePrices->lastItem() }} / Tổng {{ $typePrices->total() }}</strong></span>
    
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $typePrices->currentPage() == 1 ? 'disabled' : '' }}">
                    <a href="?page=1" class="page-link">Đầu trang</a>
                </li>
                @if (isset($typePrices) && count($typePrices) > 0)
                    {{ $typePrices->render('helpers.paginate') }}
                @endif
                <li class="page-item {{ $typePrices->currentPage() == $typePrices->lastPage() ? 'disabled' : '' }}">
                    <a href="?page={{ $typePrices->lastPage() }}" class="page-link">Cuối trang</a>
                </li>
            </ul>
        </nav>
    @endif
</div>
