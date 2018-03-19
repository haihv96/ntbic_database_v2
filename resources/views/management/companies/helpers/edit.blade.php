@if(in_array($key, ['specialization', 'research_joined', 'research_results','research_for']))
    {!! Form::textarea($key, $record[$key], ['class'=>'form-control tinymce']) !!}
@else
    @switch($key)
        @case('url')
            <a href="{{$record[$key]}}" target="_blank">
                {!! Form::text($key, $record[$key], ['class'=>'form-control', 'disabled' => true]) !!}
            </a>
            @break

        @case('province')
            {!! Form::select('province_id', $record['provinces'], $record['province_id'], ['class'=>'form-control']) !!}
            @break
        @case('base_technology_category')
            {!! Form::select('base_technology_category_id', $record['baseTechnologyCategories'], $record['base_technology_category_id'], ['class'=>'form-control']) !!}
            @break
        @default
            {!! Form::text($key, $record[$key], ['class'=>'form-control']) !!}
    @endswitch
@endif