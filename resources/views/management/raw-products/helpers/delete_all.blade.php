<a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
    <button class="btn red float-right action-with-all">Delete All</button>
    <div class="modal-content" hidden>
        @component('management.raw-products.helpers.form_delete', [
            'ids' => 'all'
        ])
            @slot('body')
                Do you sure
                <span class="bold font-red">
                    DELETE ALL RAW PRODUCTS
                </span> ?
            @endslot
        @endcomponent
    </div>
</a>