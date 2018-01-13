{!! Form::open([
    'route'=>['raw-profiles.transfer', isset($ids) ? $ids : null],
    'class' => 'form-ajax '.(isset($class) ? $class : null),
    'hidden' => isset($hidden) ? $hidden : false,
    'data-model-url' => route('raw-profiles.transfer', null),
    'data-reloadable' => true
    ])
!!}
<div class="modal-body">
    {{isset($body) ? $body : null}}
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary submit-form-ajax">Transfer</button>
    <button type="button" class="btn dark btn-outline close-modal" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
