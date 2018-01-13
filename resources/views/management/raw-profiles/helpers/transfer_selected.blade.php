<a href="#transfer-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
    <button class="btn btn-primary display-none action-records-selected">Transfer Selected
    </button>
    <div class="modal-content" hidden>
        @component('management.raw-profiles.helpers.form_transfer', [
            'class' => 'form-records-selected',
        ])
            @slot('body')
                Do you sure
                <span class="bold font-blue-steel">
                    TRANSFER <span class="records-checked"></span>
                    SELECTED RAW PROFILES
                </span> ?
            @endslot
        @endcomponent
    </div>
</a>