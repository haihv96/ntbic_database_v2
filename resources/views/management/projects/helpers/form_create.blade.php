@if(in_array($key, ['research_joined', 'research_results','research_for']))
    {!! Form::textarea($key, null, ['class'=>'form-control tinymce']) !!}
@else
    @switch($key)
        @case('specialization')
        {!! Form::select('specialization_id', $record['specializations'], null, ['class'=>'form-control']) !!}
        @break
        @default
        {!! Form::text($key, null, ['class'=>'form-control']) !!}
    @endswitch
@endif
