<?php

namespace App\Http\Controllers\Management;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    use TransferRecord;
    protected $recordRepository = null;
    protected $transferToRecordModel = null;
    protected $perPage = 10;

    protected $viewIndex = null;
    protected $viewRecords = null;
    protected $viewShow = null;
    protected $viewRecord = null;
    protected $viewEdit = null;
    protected $updateSuccessMessage = 'Update record success !';
    protected $updateErrorMessage = 'Update record error !';
    protected $destroySuccessMessage = 'Delete record success !';
    protected $destroyErrorMessage = 'Delete record error !';
    protected $transferSuccessMessage = 'Transfer record success !';
    protected $transferErrorMessage = 'Transfer record error !';

    public function index(Request $request)
    {
        $search = $request->get('search');
        $customIndexQuery = method_exists($this, 'customIndexQuery') ?
            $this->customIndexQuery($search) : $this->recordRepository;
        if ($request->ajax()) {
            return response()->json([
                'data' => view($this->viewRecords, [
                    'records' => $customIndexQuery
                        ->paginate($this->perPage)
                ])->render(),
            ], 200);
        } else {
            return view($this->viewIndex, [
                'records' => $customIndexQuery
                    ->paginate($this->perPage)
            ]);
        }
    }

    public function show($id)
    {
        $customShowQuery = method_exists($this, 'customShowQuery') ?
            $this->customShowQuery($id) : $this->recordRepository->find($id);
        return response()->json([
            'data' => view($this->viewShow, [
                'record' => $customShowQuery
            ])->render(),
        ], 200);
    }

    public function edit($id)
    {
        $customEditQuery = method_exists($this, 'customEditQuery') ?
            $this->customEditQuery($id) : $this->recordRepository->find($id);
        return response()->json([
            'data' => view($this->viewEdit, [
                'record' => $customEditQuery
            ])->render(),
        ], 200);
    }

    public function updateRecord($validUpdateRequest, $id, Closure $callback = null)
    {
        try {
            $record = $this->recordRepository->find($id);
            $record->update($validUpdateRequest->all());
            $callback && $callback($record);
            $customUpdatedQuery = method_exists($this, 'customUpdatedQuery') ?
                $this->customUpdatedQuery($id) : $record;
            return response()->json([
                'data' => view($this->viewRecord, [
                    'record' => $customUpdatedQuery
                ])->render(),
                'message' => $this->updateSuccessMessage
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'message' => $this->updateErrorMessage
            ], 500);
        }
    }

    public function destroy($ids, Closure $callback = null)
    {
        $records = ($ids === 'all' ? $this->recordRepository->all() :
            $this->recordRepository->whereIn('id', json_decode($ids))->get());
        foreach ($records as $record) {
            $callback && $callback($record);
            try {
                DB::beginTransaction();
                $record->delete();
                DB::commit();
            } catch (Exception $e) {
                return response()->json([
                    'data' => null,
                    'message' => $this->destroyErrorMessage
                ], 500);
            }
        }
        return response()->json([
            'data' => $ids,
            'message' => $this->destroySuccessMessage
        ], 200);
    }
}
