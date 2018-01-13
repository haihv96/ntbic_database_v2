{!! Form::open([
    'route'=>['raw-profiles.transfer', isset($ids) ? $ids : null],
    'method'=>'post',
    'ids' => (isset($ids) ? $ids : null),
    'class' => 'form-ajax '.(isset($class) ? $class : null),
    'hidden' => isset($hidden) ? $hidden : false,
    ])
!!}
<button type="submit" class="send-request btn btn-primary btn-sm">
    <i class="fa fa-sign-out"></i>
</button>
{!! Form::close() !!}