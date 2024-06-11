@if ($floors && count($floors) > 0)
    @unless ($crud)
        <option value="">Tất cả</option>
    @endunless
    @foreach ($floors as $floor)
        <option class="option_floor" value="{{$floor->id}}">{{$floor->name}}</option>
    @endforeach
@else
    <option value="">(Không có dữ liệu)</option>
@endif