@if(in_array($key, ['highlights', 'description', 'results']))
    {!! Form::textarea($key, $record[$key], ['class'=>'form-control tinymce']) !!}
@else
    @switch($key)
        @case('url')
        <a href="{{$record[$key]}}" target="_blank">
            {!! Form::text($key, $record[$key], ['class'=>'form-control', 'disabled' => true]) !!}
        </a>
        @break

        @case('base_technology_category')
        {!! Form::select(
                'base_technology_category',
                $record['base_technology_categories'],
                 $record['base_technology_category_id'],
                 ['class'=>'form-control']
             )
         !!}
        @break
        @default
        {!! Form::text($key, $record[$key], ['class'=>'form-control']) !!}
    @endswitch
@endif
