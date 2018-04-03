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
        $data = method_exists($this->recordRepository, 'indexQuery') ?
            $this->recordRepository->indexQuery($search) : $this->recordRepository;
        if ($request->ajax()) {
            return response()->json([
                'data' => view($this->viewRecords, [
                    'records' => $data
                        ->paginate($this->perPage)
                ])->render(),
            ], 200);
        } else {
            return view($this->viewIndex, [
                'records' => $data
                    ->paginate($this->perPage)
            ]);
        }
    }

    public function show($id)
    {
        $data = method_exists($this->recordRepository, 'showQuery') ?
            $this->recordRepository->showQuery($id) : $this->recordRepository->find($id);
        return response()->json([
            'data' => view($this->viewShow, [
                'record' => $data
            ])->render(),
        ], 200);
    }

    public function edit($id)
    {
        $data = method_exists($this->recordRepository, 'editQuery') ?
            $this->recordRepository->editQuery($id) : $this->recordRepository->find($id);
        return response()->json([
            'data' => view($this->viewEdit, [
                'record' => $data
            ])->render(),
        ], 200);
    }

    public function updateRecord($validUpdateRequest, $id, Closure $callback = null)
    {
        try {
            $record = $this->recordRepository->find($id);
            $record->update($validUpdateRequest->all());
            $callback && $callback($record);
            $data = method_exists($this->recordRepository, 'updatedQuery') ?
                $this->recordRepository->updatedQuery($id) : $record;
            return response()->json([
                'data' => view($this->viewRecord, [
                    'record' => $data
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
        $records = $this->recordRepository->getListRecord(json_decode($ids));
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
