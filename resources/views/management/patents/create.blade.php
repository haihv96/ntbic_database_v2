{!!
    Form::open([
        'route'=>['patents.store'],
        'method'=>'post',
        'class' => 'form-ajax'
    ])
!!}
<div class="modal-body">
    @foreach($record->attrNames() as $key => $value)
        <div class="form-group">
            {!! Form::label($key, $value, ['class' => 'bold']) !!}
            @include('management.patents.helpers.form_create')
        </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="submit" class="btn blue submit-form-ajax">Create</button>
    <button type="button" class="btn dark btn-outline close-modal" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
