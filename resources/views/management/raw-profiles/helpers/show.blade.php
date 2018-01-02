@if($key == 'url')
    <a href="{{$record[$key]}}" target="_blank">
        {{$record[$key]}}
    </a>
@else
    {!!$record[$key]!!}
@endif