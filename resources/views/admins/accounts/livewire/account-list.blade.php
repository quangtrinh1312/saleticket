<div class="container shadow mt-4 pb-5 bg-white">
    <div class="row bg-primary text-light p-1">
        <span>Danh sách tài khoản</span>
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
                <button type="button" class="btn btn-sm rounded-0 btn-primary text-uppercase" data-toggle="modal" data-target="#crudAccountModal">
                    Thêm mới
                </button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="container-fluid p-0 table-wrapper" style="max-height:450px;overflow-y:scroll">
                <table class="table table-sm table-bordered table-hover table-dark table-striped mb-1">
                    <thead>
                        <th scope="col" class="text-center">STT</th>
                        <th scope="col" class="text-center">Họ & Tên</th>
                        <th scope="col" class="text-center">Tên đăng nhập</th>
                        <th scope="col" class="text-center">Chức vụ</th>
                        <th scope="col" class="text-center">Thao tác</th>
                    </thead>
                    <tbody id="list_ticket_table_data">
                        @if(isset($accounts))
                        @if ($accounts !== null && count($accounts) > 0)
                            @php $sn = ($accounts->perPage() * ($accounts->currentPage() - 1)) + 1 @endphp
                            @foreach ($accounts as $account)
                            <tr>
                                <td scope="row" class="text-center">{{ $sn++ }}</td>
                                <td scope="row" class="text-center">{{ $account->name }}</td>
                                <td scope="row" class="text-center">{{ $account->username }}</td>
                                <td scope="row" class="text-center">{{ $account->role->name ?? '' }}</td>
                                <td scope="row" class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#crudAccountModal" data-account-id={{ $account->id }}><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#crudAccountModal" data-account-id={{ -$account->id }}><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td scope="row" colspan="5" class="text-center">(Không có dữ liệu)</td>
                            </tr>
                        @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-2 flex-column">

            @if(isset($accounts) && $accounts !== null && count($accounts) > 0)
            
                <div class="row px-3 justify-content-between">
                    <span style="font-size: 15px;"><strong>Hiển thị {{ $accounts->firstItem() }} - {{ $accounts->lastItem() }} / Tổng {{ $accounts->total() }}</strong></span>
                </div>

                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
    
                            @if (isset($accounts) && count($accounts) > 0)
                                {!! $accounts->links('helpers.livewire-paginate') !!}
                            @endif
    
                        </ul>
                    </nav>
                </div>
            @endif

        </div>
    </div>



</div>