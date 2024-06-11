@if ($rooms && count($rooms) > 0)
    <option value="">Tất cả</option>
    @foreach ($rooms as $room)
        <option class="option_room" value="{{$room->id}}">{{$room->name}}</option>
    @endforeach
@else
    <option value="">(Không có dữ liệu)</option>
@endif