@if(in_array($key, ['specialization', 'research_joined', 'research_results','research_for']))
    {!! Form::textarea($key, null, ['class'=>'form-control tinymce']) !!}
@else
    @switch($key)
        @case('province')
        {!! Form::select('province_id', $record['provinces'], null, ['class'=>'form-control']) !!}
        @break
        @case('academic_title')
        {!! Form::select('academic_title_id', $record['academicTitles'], null, ['class'=>'form-control']) !!}
        @break
        @default
        {!! Form::text($key, null, ['class'=>'form-control']) !!}
    @endswitch
@endif
