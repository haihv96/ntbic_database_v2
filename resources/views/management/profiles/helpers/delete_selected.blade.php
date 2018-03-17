<a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
    <button class="btn red display-none action-records-selected">Delete Selected</button>
    <div class="modal-content" hidden>
        @component('management.profiles.helpers.form_delete', [
            'class' => 'form-records-selected',
        ])
            @slot('body')
                Do you sure
                <span class="bold font-red">
                    DELETE <span class="records-checked"></span>
                    SELECTED PROFILES
                </span> ?
            @endslot
        @endcomponent
    </div>
</a>