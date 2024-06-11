<div class="mt-2 table-wrapper overflow-auto">
    <table class="table table-hover table-dark table-striped mb-1">
        <thead>
            <th scope="col" class="text-center">STT</th>
            <th scope="col" class="text-center">Thời gian</th>
            <th scope="col" class="text-center">Tên khách/Đoàn</th>
            <th scope="col" class="text-center">Số lượng vé</th>
            <th scope="col" class="text-center">Thành tiền</th>
            <th scope="col" class="text-center">Nhân viên</th>
        </thead>
        <tbody id="list_ticket_table_data">
            @php($sn = ($tickets->perPage() * ($tickets->currentPage() - 1)) + 1)
            @if ($tickets !== null && count($tickets) > 0)
                @php($sum = 0)
                @foreach ($tickets as $ticket)
                    <tr>
                        <td scope="row" class="text-center">{{ $sn++ }}</td>
                        <td scope="row" class="text-uppercase">{{ $ticket->created_at }}</td>
                        <td scope="row" class="text-uppercase">{{ $ticket->name }}</td>
                        <td scope="row">{{ $ticket->number }}</td>
                        <td scope="row">{{ number_format($ticket->sum, 0, ',', '.') }} đ</td>
                        <td scope="row" class="text-center">{{ $ticket->user->name }}</td>  
                    </tr>
                @endforeach
                <tr>
                    <td>Tổng</td>
                    <td></td>
                    <td></td>
                    <td>{{$sum_number ?? 0}}</td>
                    <td>{{number_format($sum_price, 0, ',', '.')}} đ</td>
                    <td></td>
                </tr>
            @else
            <tr>
                <td colspan="10" class="text-center">(Không có dữ liệu)</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="mt-2" id="links">
    @if(count($tickets) > 0)
        <div class="d-flex justify-content-between">
            <span style="font-size: 15px;"><strong>Hiển thị {{ $tickets->firstItem() }} - {{ $tickets->lastItem() }} / Tổng {{ $tickets->total() }}</strong></span>
        </div>
    
        <nav aria-label="Page navigation example" class="mbl_pagination">
            <ul class="pagination justify-content-center">
                @if (isset($tickets) && count($tickets) > 0)
                    {!! $tickets->appends(Request::all())->links('helpers.paginate') !!}
                @endif
            </ul>
        </nav>
    @endif
</div>
