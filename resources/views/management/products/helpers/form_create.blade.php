@if(in_array($key, ['highlights', 'description', 'results']))
    {!! Form::textarea($key, null, ['class'=>'form-control tinymce']) !!}
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
        @default
        {!! Form::text($key, null, ['class'=>'form-control']) !!}
    @endswitch
@endif
