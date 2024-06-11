@if ($datas && count($datas) > 0)

    @if ($name == 'ward_id')
        <option value="">Tất cả</option>
        @foreach ($datas as $data)
            <option class="" value="{{$data->id}}" {{isset($params[$name]) ? $params[$name] == $data->id ? 'selected' : '' : ''}}>{{$data->name}}</option>
        @endforeach
    @elseif ($name == 'room_id')
        <option value="">Tất cả</option>
        @foreach ($datas as $data)
            <option class="" value="{{$data->id}}" {{isset($params[$name]) ? $params[$name] == $data->id ? 'selected' : '' : ''}}>{{$data->name}}</option>
        @endforeach
    @endif
@endif