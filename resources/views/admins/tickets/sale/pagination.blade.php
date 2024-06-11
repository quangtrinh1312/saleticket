<div class="container-fluid" id="" style="overflow: auto;"> 
<div class="mt-2 table-wrapper">
        <table class="table table-hover table-dark table-striped mb-1 table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">STT</th>
                    <th scope="col" class="text-center">Địa chỉ</th>
                    <th scope="col" class="text-center">Số vé</th>
                    <th scope="col" class="text-center">Khách hàng</th>
                    <th scope="col" class="text-center">Mã khách hàng</th>
                    <th scope="col" class="text-center">Giá vé</th>
                    <th scope="col" class="text-center">Ngày giờ xuất vé</th>
                    <th scope="col" class="text-center">Trạng thái vé</th>
                    <th scope="col" class="text-center">Vé</th>
                    <th scope="col" class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody id="list_ticket_table_data">
            @php($sn = ($tickets->perPage() * ($tickets->currentPage() - 1)) + 1)
            @if ($tickets !== null && count($tickets) > 0)
                @php($sum = 0)
                @foreach ($tickets as $ticket)
                    <tr id="r_id_">
                        <td scope="row" class="text-center">{{ $sn++ }}</td>
                        <td scope="row" class="text-uppercase">{{ $ticket->address }}</td>
                        <td scope="row" class="text-center">{{ $config->api == 'VNPT' ? covert_code_bill($ticket->number_bill_number) ?? '' : $ticket->number_bill_number ?? '' }}</td>
                        <td scope="row" class="text-uppercase">{{ $ticket->cus_name }}</td>
                        <td scope="row">{{ $ticket->number_bill_string }}</td>
                        <td scope="row">{{ number_format($ticket->price, 0, ',', '.') }} đ</td>
                        <td scope="row" class="text-center">{{ $ticket->created_at }}</td>
                        <td scope="row">
                            @if ($ticket->status_id != null)
                                <span class="badge {{ $ticket->status_id == 1 ? 'badge-success' : 'badge-warning' }}">
                                    {{ $ticket->status->title }}
                                </span>
                            @else
                                <span class="badge badge-danger">Không xác định</span>
                            @endif
                        </td>
                        <td scope="row">
                            @if ($ticket->check == 1)
                                <p>Mới</p>
                            @else
                                <p>Đã sử dụng</p>
                            @endif
                        </td>
                        <td class="text-center" scope="row"><button class="badge badge-secondary cursor-pointer" onclick="ticketDetail('{{$ticket->id}}')" data-id="{{$ticket->id}}" title="Chi tiết"><i class="fa-solid fa-eye"></i></button></td>
                        @php($sum = $sum + $ticket->price)
                    </tr>
                @endforeach
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
</div>
