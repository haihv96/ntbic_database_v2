@if($key == 'url')
    <a href="{{$rawProfile[$key]}}" target="_blank">
        {{$rawProfile[$key]}}
    </a>
@elseif(in_array($key, ['specialization', 'research_joined', 'research_results']))
    @foreach(json_decode($rawProfile[$key]) as $value)
        <li class="dash">
            {!!$value!!}
        </li>
    @endforeach
@else
    {!!$rawProfile[$key]!!}
@endif