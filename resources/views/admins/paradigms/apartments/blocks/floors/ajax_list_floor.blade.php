<div class="mt-2 table-wrapper">
    <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
        <thead>
            <th scope="col" class="text-center">STT</th>
            <th scope="col" class="text-center">Tên chung cư</th>
            <th scope="col" class="text-center">Tên nhà</th>
            <th scope="col" class="text-center">Tầng</th>
            <th scope="col" class="text-center">Số lượng căn hộ
                <a href="{{route('paradigms-rooms.index',['paradigm_id' => 1])}}" class="float-left mr-1"><i class="far fa-eye"></i>
                                </a>
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
                        <td scope="row" class="text-uppercase text-left">{{ $floor->apartment->name }}</td>
                        <td scope="row" class="text-center">{{$floor->block->name}}
                        <td scope="row" class="text-center">{{$floor->name}}</td>
                        <td scope="row" class="text-center">{{$floor->room->count()}}</td>
                        <td scope="row" class="text-center">
                            <form action="{{route('paradigms-floors.destroy',['id' => $floor->id, 'paradigm_id' => 1])}}"
                                  class="float-right"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                        onclick="if(!confirm('Bạn có chắc chắn muốn xóa ?')){return false}">
                                    <i class="icon-cross"></i></button>
                            </form>
                            <button type="button" class="btn btn-success btn-icon legitRipple  btn-sm float-left" id="btn_update_floor" onclick="getFloor('{{$paradigm_id}}', '{{$floor->id}}', '{{url()->full()}}')"><i class="icon-pencil" aria-hidden="true"></i></button>
                        </td>
                    </tr>  

                @endforeach
            @endif
            @endif
        </tbody>
    </table>
</div>

<div class="mt-2" id="links">
    @if(isset($floors))
        <span style="font-size: 15px;"><strong>Hiển thị {{ $floors->firstItem() }} - {{ $floors->lastItem() }} / Tổng {{ $floors->total() }}</strong></span>
    
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
<!--                 <li class="page-item {{ $floors->currentPage() == 1 ? 'disabled' : '' }}">
                    <a href="?page=1" class="page-link">Đầu trang</a>
                </li> -->
                @if (isset($floors) && count($floors) > 0)
                    {!! $floors->appends(Request::all())->links('helpers.paginate') !!}
                @endif
<!--                 <li class="page-item {{ $floors->currentPage() == $floors->lastPage() ? 'disabled' : '' }}">
                    <a href="?page={{ $floors->lastPage() }}" class="page-link">Cuối trang</a>
                </li> -->
            </ul>
        </nav>
    @endif
</div>

