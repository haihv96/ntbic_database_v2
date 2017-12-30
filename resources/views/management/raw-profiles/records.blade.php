<div id="records-pagination-{{$records->currentPage()}}" class="records-pagination">
    <div class="row">
        <table class="table table-striped table-bordered table-advance table-hover">
            <tr>
                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label=""
                    style="width: 40px;">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable">
                        <span></span>
                    </label>
                </th>
                @foreach(config('views.management.raw-profiles.ths') as $thead)
                    <th class="bold">
                        {{$thead}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                @foreach($records as $index => $record)
                    @include('management.raw-profiles.record')
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-5 col-sm-5">
            <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                Showing {{$records->perPage()*($records->currentPage()-1) + 1}} to
                {{$records->perPage()*($records->currentPage()-1) + $records->count()}}
                of {{$records->total()}} records
            </div>
        </div>
        <div class="col-md-7 col-sm-7 ajax-pagination">
            {{ $records->appends(request()->query())->links() }}
        </div>
    </div>
</div>