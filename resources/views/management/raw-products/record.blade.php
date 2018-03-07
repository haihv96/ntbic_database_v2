<tr id="record-{{$record->id}}">
    <td>
        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
            <input type="checkbox" class="checkboxes" value="{{$record->id}}">
            <span></span>
        </label>
    </td>
    <td>
        <img class="thumb" src="{{asset($record->getFirstMediaUrl('thumb') ?
        $record->getFirstMediaUrl('thumb') : 'images/nophoto.jpg')}}"/>
    </td>
    <td width="30%">
        <a href="#show-record" data-toggle="modal" class="send-request bold"
           data-url="{{route('raw-products.show', ['id' => $record->id])}}"
           data-method="GET">
            {{$record->name}}
        </a>
    </td>
    <td>
        {{$record->technology_category}}
    </td>
    <td>
        {{$record->highlights}}
    </td>
    <td>
        <a href="#show-record" data-toggle="modal" class="send-request font-dark btn-sm"
           data-url="{{route('raw-products.show', ['id' => $record->id])}}"
           data-method="GET">
            <i class="fa fa-eye"></i>
        </a>
    </td>
    <td>
        <a href="#edit-record" data-toggle="modal" class="send-request font-green-junger btn-sm"
           data-url="{{route('raw-products.edit', ['id' => $record->id])}}"
           data-method="GET">
            <i class="fa fa-pencil"></i>
        </a>
    </td>
    <td>
        <a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
            <i class="fa fa-trash"></i>
            <div class="modal-content" hidden>
                @component('management.raw-products.helpers.form_delete', [
                    'ids' => $record->id
                ])
                    @slot('body')
                        Do you sure delete <span class="bold font-red">"{{$record->name}}"</span> ?
                    @endslot
                @endcomponent
            </div>
        </a>
    </td>
    <td>
        @include('management.raw-products.transfer', ['ids' => $record->id])
    </td>
</tr>