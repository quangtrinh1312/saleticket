@if ($blocks && count($blocks) > 0)
    <option value="">Tất cả</option>
    @foreach ($blocks as $block)
        <option class="option_block" value="{{$block->id}}">{{$block->name}}</option>
    @endforeach
@endif