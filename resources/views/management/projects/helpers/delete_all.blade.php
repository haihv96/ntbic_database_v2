<a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
    <button class="btn red float-right action-with-all">Delete All</button>
    <div class="modal-content" hidden>
        @component('management.projects.helpers.form_delete', [
            'ids' => 'all'
        ])
            @slot('body')
                Do you sure
                <span class="bold font-red">
                    DELETE ALL PROJECTS
                </span> ?
            @endslot
        @endcomponent
    </div>
</a>