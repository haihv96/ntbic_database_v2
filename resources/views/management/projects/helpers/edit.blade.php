@if(in_array($key, ['research_joined', 'research_results','research_for']))
    {!! Form::textarea($key, $record[$key], ['class'=>'form-control tinymce']) !!}
@else
    @switch($key)
        @case('url')
            <a href="{{$record[$key]}}" target="_blank">
                {!! Form::text($key, $record[$key], ['class'=>'form-control', 'disabled' => true]) !!}
            </a>
            @break

        @case('specialization')
            {!! Form::select('specialization_id', $record['specializations'], $record['specialization_id'], ['class'=>'form-control']) !!}
            @break
        @default
            {!! Form::text($key, $record[$key], ['class'=>'form-control']) !!}
    @endswitch
@endif