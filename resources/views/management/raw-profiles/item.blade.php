<tr id="record-{{$rawProfile->id}}">
    <td>
        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
            <input type="checkbox" class="checkboxes" value="{{$rawProfile->id}}">
            <span></span>
        </label>
    </td>
    <td width="30%">
        <a href="#show-record" data-toggle="modal" class="send-request bold"
           data-url="{{route('raw-profiles.show', ['id' => $rawProfile->id])}}"
           data-method="GET">
            {{$rawProfile->acadamic_title.'.'.$rawProfile->name}}
        </a>
    </td>
    <td> {{$rawProfile->agency}}</td>
    <td> {{$rawProfile->birthday}}</td>
    <td>
        @foreach(json_decode($rawProfile->specialization) as $specialization)
            <li class="dash">{{$specialization}}</li>
        @endforeach
    </td>
    <td>
        <a href="#show-record" data-toggle="modal" class="send-request font-dark btn-sm"
           data-url="{{route('raw-profiles.show', ['id' => $rawProfile->id])}}"
           data-method="GET">
            <i class="fa fa-eye"></i>
        </a>
    </td>
    <td>
        <a href="#edit-record" data-toggle="modal" class="send-request font-green-junger btn-sm"
           data-url="{{route('raw-profiles.edit', ['id' => $rawProfile->id])}}"
           data-method="GET">
            <i class="fa fa-pencil"></i>
        </a>
    </td>
    <td>
        <a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
            <i class="fa fa-trash"></i>
            <div class="modal-content" hidden>
                @component('management.raw-profiles.helpers.form_delete', [
                    'ids' => $rawProfile->id
                ])
                    @slot('body')
                        Do you sure delete <span class="bold font-red">"{{$rawProfile->name}}"</span> ?
                    @endslot
                @endcomponent
            </div>
        </a>
    </td>
</tr>