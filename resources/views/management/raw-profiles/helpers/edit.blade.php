@if($key == 'url')
    <a href="{{$record[$key]}}" target="_blank">
        {!! Form::text($key, $record[$key], ['class'=>'form-control', 'disabled' => true]) !!}
    </a>
@elseif(in_array($key, ['specialization', 'research_joined', 'research_results','research_for']))
    {!! Form::textarea($key, $record[$key], ['class'=>'form-control tinymce']) !!}
@else
    {!! Form::text($key, $record[$key], ['class'=>'form-control']) !!}
@endif