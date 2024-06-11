<div class="mt-2 table-wrapper">
    <table class="table table-hover table-dark table-bordered table-striped mb-1 table-responsive-lg">
        <thead>
            <th scope="col" class="text-center">STT</th>
            <th scope="col" class="text-center">Tên chung cư</th>
            <th scope="col" class="text-center">Số lượng nhà
                <a href="{{route('paradigms-blocks.index',['url' => url()->full(), 'paradigm_id' => 1])}}" class="float-left mr-1"><i class="far fa-eye"></i>
                            </a></td>
            </th>
            <th scope="col" class="text-center">Số lượng tầng</th>
            <th scope="col" class="text-center">Số lượng căn hộ</th>
            <th scope="col" class="text-center">Thao tác</th>
        </thead>
        <tbody>
            @if(isset($apartments))
            @if ($apartments !== null && count($apartments) > 0)
            @php $sn = ($apartments->perPage() * ($apartments->currentPage() - 1)) + 1 @endphp
                @foreach ($apartments as $apartment)
                    <tr>
                        <td scope="row">{{ $sn++ }}</td>
                        <td scope="row" class="text-uppercase text-left">{{ $apartment->name }}</td>
                        <td scope="row" class="text-center">{{$apartment->block()->count()}}
                        <td scope="row" class="text-center">{{$apartment->floor()->count()}}</td>
                        <td scope="row" class="text-center">{{$apartment->room()->count()}}</td>
                        <td scope="row" class="text-center">
                            <form action="{{route('paradigms-apartments.destroy',['id' => $apartment->id, 'url' => url()->full(), 'paradigm_id' => 1])}}"
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
                            <button type="button" class="btn btn-success btn-icon legitRipple  btn-sm float-left" id="btn_update_apartment" onclick="getApartment('{{$paradigm_id}}', '{{$apartment->id}}', '{{url()->full()}}')"><i class="icon-pencil" aria-hidden="true"></i></button>
                        </td>
                    </tr>  

                @endforeach
            @endif
            @endif
        </tbody>
    </table>
</div>

<div class="mt-2" id="links">
    @if(isset($apartments))
        <span style="font-size: 15px;"><strong>Hiển thị {{ $apartments->firstItem() }} - {{ $apartments->lastItem() }} / Tổng {{ $apartments->total() }}</strong></span>
    
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
<!--                 <li class="page-item {{ $apartments->currentPage() == 1 ? 'disabled' : '' }}">
                    <a href="?page=1" class="page-link">Đầu trang</a>
                </li> -->
                @if (isset($apartments) && count($apartments) > 0)
                    {!! $apartments->appends(Request::all())->links('helpers.paginate') !!}
                @endif
<!--                 <li class="page-item {{ $apartments->currentPage() == $apartments->lastPage() ? 'disabled' : '' }}">
                    <a href="?page={{ $apartments->lastPage() }}" class="page-link">Cuối trang</a>
                </li> -->
            </ul>
        </nav>
    @endif
</div>

