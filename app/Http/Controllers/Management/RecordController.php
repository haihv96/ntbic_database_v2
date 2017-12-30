<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class RecordController extends Controller
{
    protected $recordRepository = null;

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

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->ajax()) {
            return response()->json([
                'data' => view($this->viewRecords, [
                    'records' => $this->recordRepository
                        ->where('name', 'like', "%$search%")
                        ->paginate($this->perPage)
                ])->render(),
            ], 200);
        } else {
            return view($this->viewIndex, [
                'records' => $this->recordRepository->paginate($this->perPage)
            ]);
        }
    }

    public function show($id)
    {
        return response()->json([
            'data' => view($this->viewShow, [
                'record' => $this->recordRepository->find($id)
            ])->render(),
        ], 200);
    }

    public function edit($id)
    {
        return response()->json([
            'data' => view($this->viewEdit, [
                'record' => $this->recordRepository->find($id)
            ])->render(),
        ], 200);
    }

    public function updateRecord($validUpdateRequest, $id)
    {
        try {
            $record = $this->recordRepository->update($id, $validUpdateRequest->all());
            return response()->json([
                'data' => view($this->viewRecord, [
                    'record' => $record
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

    public function destroy($ids)
    {
        $ids = json_decode($ids);
        try {
            $this->recordRepository->delete($ids);
            return response()->json([
                'data' => null,
                'message' => $this->destroySuccessMessage
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'message' => $this->destroyErrorMessage
            ], 500);
        }
    }
}
