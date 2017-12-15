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
            @foreach(['Name','Agency', 'Birthday','Research for', 'view', 'edit', 'update'] as $thead)
                <th class="bold">
                    {{$thead}}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($rawProfiles as $index => $rawProfile)
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1">
                        <span></span>
                    </label>
                </td>
                <td width="30%">
                    <a href="javascript:;"> {{$rawProfile->acadamic_title.'.'.$rawProfile->name}} </a>
                </td>
                <td> {{$rawProfile->agency}}</td>
                <td> {{$rawProfile->birthday}}</td>
                <td>
                    @foreach(json_decode($rawProfile->specialization) as $specialization)
                        <li>{{$specialization}}</li>
                    @endforeach
                </td>
                <td>
                    <a href="javascript:;" class="font-dark btn-sm">
                        <i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <a href="javascript:;" class="font-green-junger btn-sm">
                        <i class="fa fa-trash"></i></a>
                </td>
                <td>
                    <a href="javascript:;" class="font-red btn-sm">
                        <i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-5 col-sm-5">
        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
            Showing {{$rawProfiles->perPage()*($rawProfiles->currentPage()-1) + 1}} to
            {{$rawProfiles->perPage()*($rawProfiles->currentPage()-1) + $rawProfiles->count()}}
            of {{$rawProfiles->total()}} records
        </div>
    </div>
    <div class="col-md-7 col-sm-7 ajax-pagination">
        {{ $rawProfiles->appends(request()->query())->links() }}
    </div>
</div>