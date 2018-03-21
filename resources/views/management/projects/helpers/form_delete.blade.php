{!! Form::open([
    'route'=>['projects.destroy', isset($ids) ? $ids : null],
    'method'=>'delete',
    'class' => 'form-ajax form-delete '.(isset($class) ? $class : null),
    'hidden' => isset($hidden) ? $hidden : false,
    'data-model-url' => route('projects.index'),
    'data-reloadable' => true
    ])
!!}
<div class="modal-body">
    {{isset($body) ? $body : null}}
</div>
<div class="modal-footer">
    <button type="submit" class="btn red submit-form-ajax">Delete</button>
    <button type="button" class="btn dark btn-outline close-modal" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}