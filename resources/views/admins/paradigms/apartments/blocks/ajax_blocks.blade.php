@if ($blocks && count($blocks) > 0)
    @unless ($crud)
        <option value="">Tất cả</option>
    @endunless
    @foreach ($blocks as $block)
        <option class="option_block" value="{{$block->id}}">{{$block->name}}</option>
    @endforeach
@else
    <option value="">(Không có dữ liệu)</option>
@endif