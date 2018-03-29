{!! Form::open([
    'route'=>['raw-projects.transfer', isset($ids) ? $ids : null],
    'method'=>'post',
    'ids' => (isset($ids) ? $ids : null),
    'class' => 'form-ajax '.(isset($class) ? $class : null),
    'hidden' => isset($hidden) ? $hidden : false,
    'data-model-url' => route('raw-projects.index'),
    'data-reloadable' => true
    ])
!!}
<button type="submit" class="submit-form-ajax btn btn-primary btn-sm">
    <i class="fa fa-sign-out"></i>
</button>
{!! Form::close() !!}