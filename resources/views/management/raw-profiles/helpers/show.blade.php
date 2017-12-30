@if($key == 'url')
    <a href="{{$record[$key]}}" target="_blank">
        {{$record[$key]}}
    </a>
@elseif(in_array($key, ['specialization', 'research_joined', 'research_results']))
    @foreach(json_decode($record[$key]) as $value)
        <li class="dash">
            {!!$value!!}
        </li>
    @endforeach
@else
    {!!$record[$key]!!}
@endif