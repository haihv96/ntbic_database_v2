@if($key == 'url')
    <a href="{{$rawProfile[$key]}}" target="_blank">
        {!! Form::text($key, $rawProfile[$key], ['class'=>'form-control', 'disabled' => true]) !!}
    </a>
@elseif(in_array($key, ['specialization', 'research_joined', 'research_results']))
    {!! Form::textarea($key, $rawProfile[$key], ['class'=>'form-control tinymce']) !!}
@else
    {!! Form::text($key, $rawProfile[$key], ['class'=>'form-control']) !!}
@endif