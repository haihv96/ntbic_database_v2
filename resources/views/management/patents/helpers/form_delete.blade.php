{!! Form::open([
    'route'=>['patents.destroy', isset($ids) ? $ids : null],
    'method'=>'delete',
    'id' => (isset($id) ? $id : null),
    'class' => 'form-ajax form-delete '.(isset($class) ? $class : null),
    'hidden' => isset($hidden) ? $hidden : false,
    'data-model-url' => route('patents.index'),
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