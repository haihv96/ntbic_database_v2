<div class="modal-body">
    <table class="table table-striped table-bordered table-advance table-hover">
        <tbody>
            @foreach($rawProfile->attrNames() as $key => $value)
                <tr>
                    <td class="highlight active bold" width="25%">
                        {{$value}}
                    </td>
                    <td>
                        @include('management.raw-profiles.helpers.show')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
</div>
