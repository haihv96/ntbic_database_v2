<div class="pull-left">
    <a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
        <button class="btn red display-none action-records-selected">Delete Selected</button>
        <div class="modal-content" hidden>
            @component('management.projects.helpers.form_delete', [
                'class' => 'form-records-selected',
            ])
                @slot('body')
                    Do you sure
                    <span class="bold font-red">
                    DELETE <span class="records-checked"></span>
                    SELECTED PROJECTS
                </span> ?
                @endslot
            @endcomponent
        </div>
    </a>
</div>