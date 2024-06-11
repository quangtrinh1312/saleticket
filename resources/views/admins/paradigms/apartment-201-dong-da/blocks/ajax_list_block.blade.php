<div class="mt-2 table-wrapper">
    <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
        <thead>
            <th scope="col" class="text-center">STT</th>
            <th scope="col" class="text-center">Tên chung cư</th>
            <th scope="col" class="text-center">Tên nhà</th>
            <th scope="col" class="text-center">Số lượng tầng</th>
            <th scope="col" class="text-center">Số lượng căn hộ</th>
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
                        <td scope="row" class="text-center">{{$block->floor()->count()}}</td>
                        <td scope="row" class="text-center">{{$block->room()->count()}}</td>
                        <td scope="row" class="text-center">
                            <form action="{{route('paradigms-blocks.destroy',['id' => $block->id, 'url' => url()->full(), 'paradigm_id' => 1])}}"
                                  class="float-right"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="text" name="url" value="{{$url ?? ''}}" hidden>
                                <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                        onclick="if(!confirm('Bạn có chắc chắn muốn xóa ?')){return false}">
                                    <i class="icon-cross"></i></button>
                            </form>
                            <button type="button" class="btn btn-success btn-icon legitRipple  btn-sm float-left" id="btn_update_block" onclick="getblock('{{$paradigm_id}}', '{{$block->id}}', '{{url()->full()}}')"><i class="icon-pencil" aria-hidden="true"></i></button>
                        </td>
                    </tr>  

                @endforeach
            @endif
            @endif
        </tbody>
    </table>
</div>

<div class="mt-2" id="links">
    @if(isset($blocks))
        <span style="font-size: 15px;"><strong>Hiển thị {{ $blocks->firstItem() }} - {{ $blocks->lastItem() }} / Tổng {{ $blocks->total() }}</strong></span>
    
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
<!--                 <li class="page-item {{ $blocks->currentPage() == 1 ? 'disabled' : '' }}">
                    <a href="?page=1" class="page-link">Đầu trang</a>
                </li> -->
                @if (isset($blocks) && count($blocks) > 0)
                    {!! $blocks->appends(Request::all())->links('helpers.paginate') !!}
                @endif
<!--                 <li class="page-item {{ $blocks->currentPage() == $blocks->lastPage() ? 'disabled' : '' }}">
                    <a href="?page={{ $blocks->lastPage() }}" class="page-link">Cuối trang</a>
                </li> -->
            </ul>
        </nav>
    @endif
</div>

