<a href="#transfer-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
    <button class="btn btn-primary float-right action-with-all">Transfer All</button>
    <div class="modal-content" hidden>
        @component('management.raw-patents.helpers.form_transfer', [
            'ids' => 'all'
        ])
            @slot('body')
                Do you sure
                <span class="bold font-blue-steel">
                    TRANSFER ALL RAW PATENTS
                </span> ?
            @endslot
        @endcomponent
    </div>
</a>