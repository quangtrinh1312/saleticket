<div class="container shadow mt-4 pb-5 bg-white">
    <div class="row bg-primary text-light p-1">
        <span>Danh sách loại vé</span>
    </div>

    <div class="container-fluid px-3">
        <div class="row mt-3 d-flex justify-content-between">
            <div>
                <select class="form-input px-2" wire:model="paginate">
                    @for ($page = 5; $page <= 20; $page+=5)
                    <option value="{{ $page }}">{{ $page }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <button type="button" class="btn btn-sm rounded-0 btn-primary text-uppercase" data-toggle="modal" data-target="#crudTicketTypeModal">
                    Thêm mới
                </button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="container-fluid p-0 table-wrapper" style="max-height:450px;overflow-y:scroll">
                <table class="table table-sm table-bordered table-hover table-dark table-striped mb-1">
                    <thead>
                        <th scope="col" class="text-center">STT</th>
                        <th scope="col" class="text-center">Loại vé</th>
                        <th scope="col" class="text-center">Giá vé</th>
                        <th scope="col" class="text-center">Giá trước thuế</th>
                        <th scope="col" class="text-center">Sử dụng</th>
                        <th scope="col" class="text-center">Giờ kết thúc</th>
                        <th scope="col" class="text-center">Mẫu số</th>
                        <th scope="col" class="text-center">Ký hiệu</th>
                        <th scope="col" class="text-center">VAT</th>
                        <th scope="col" class="text-center">Kích hoạt</th>
                        <th scope="col" class="text-center">Thao tác</th>
                    </thead>
                    <tbody id="list_ticket_table_data">
                        @if(isset($ticket_types))
                        @if ($ticket_types !== null && count($ticket_types) > 0)
                            @php $sn = ($ticket_types->perPage() * ($ticket_types->currentPage() - 1)) + 1 @endphp
                            @foreach ($ticket_types as $type)
                            <tr>
                                <td scope="row" class="text-center">{{ $sn++ }}</td>
                                <td scope="row" class="text-center text-uppercase">{{ $type->title }}</td>
                                <td scope="row" class="text-center">{{ number_format($type->post_vat_price, 0, ',', '.') }} VND</td>
                                <td scope="row" class="text-center">{{ number_format($type->pre_vat_price, 0, ',', '.') }} VND</td>
                                <td scope="row" class="text-center">{{ $type->duration }}</td>
                                <td scope="row" class="text-center">{{ $type->expired }}</td>
                                <td scope="row" class="text-center">{{ $type->pattern }}</td>
                                <td scope="row" class="text-center">{{ $type->serial }}</td>
                                <td scope="row" class="text-center">{{ $type->vat !== null ? ($type->vat * 100).'%' : 'Không chịu thuế' }}</td>
                                <td scope="row" class="text-center">
                                    @if ($type->is_actived)
                                    <span type="button" class="text-primary" style="font-size:1.2rem" wire:click.prevent="disableTicketType({{ $type->id }})"><i class="fa-regular fa-square-check"></i></span>
                                    @else
                                    <span type="button" class="text-primary" style="font-size:1.2rem" wire:click.prevent="activateTicketType({{ $type->id }})"><i class="fa-regular fa-square"></i></span>
                                    @endif
                                </td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#crudTicketTypeModal" data-ticket-type-id={{ $type->id }}><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#crudTicketTypeModal" data-ticket-type-id={{ -$type->id }}><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td scope="row" colspan="11" class="text-center">(Không có dữ liệu)</td>
                            </tr>
                        @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-2 flex-column">

            @if(isset($ticket_types) && $ticket_types !== null && count($ticket_types) > 0)
            
                <div class="row px-3 justify-content-between">
                    <span style="font-size: 15px;"><strong>Hiển thị {{ $ticket_types->firstItem() }} - {{ $ticket_types->lastItem() }} / Tổng {{ $ticket_types->total() }}</strong></span>
                </div>

                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
    
                            @if (isset($ticket_types) && count($ticket_types) > 0)
                                {!! $ticket_types->links('helpers.livewire-paginate') !!}
                            @endif
    
                        </ul>
                    </nav>
                </div>
            @endif

        </div>
    </div>



</div>