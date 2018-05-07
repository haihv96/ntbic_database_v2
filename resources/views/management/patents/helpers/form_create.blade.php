@if(in_array($key, ['highlights', 'description']))
    {!! Form::textarea($key, $record[$key], ['class'=>'form-control tinymce']) !!}
@else
    @switch($key)
        @case('base_technology_category')
        {!! Form::select(
                'base_technology_category_id',
                $record['base_technology_categories'],
                 null,
                 ['class'=>'form-control']
             )
         !!}
        @break
        @case('patent_type')
        {!! Form::select('patent_type_id', $record['patent_types'], null, ['class'=>'form-control']) !!}
        @break
        @default
        {!! Form::text($key, null, ['class'=>'form-control']) !!}
    @endswitch
@endif
