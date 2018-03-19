<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
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

    public function updateRecord($validUpdateRequest, $id)
    {
        try {
            $this->recordRepository->update($id, $validUpdateRequest->all());
            $customUpdatedQuery = method_exists($this, 'customUpdatedQuery') ?
                $this->customUpdatedQuery($id) : $this->recordRepository->find($id);
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

    public function destroy($ids)
    {
        $records = ($ids === 'all' ? $this->recordRepository->all() :
            $this->recordRepository->whereIn('id', json_decode($ids))->get());
        foreach ($records as $record) {
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

    public function transferRecord($ids, $medias = false)
    {
        $records = ($ids === 'all' ?
            $this->recordRepository->all() :
            $this->recordRepository->whereIn('id', json_decode($ids))->get());
        foreach ($records as $record) {
            try {
                DB::beginTransaction();
                $transferTo = $this->transferToRecordModel($record);
                $transferTo->save();
                $medias && $this->transferMedia($record, $transferTo, $medias);
                $record->delete();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'data' => null,
                    'message' => $this->transferErrorMessage
                ], 500);
            }
        }
        return response()->json([
            'data' => null,
            'message' => $this->transferSuccessMessage
        ], 200);
    }

    private function transferMedia($record, $transferTo, $medias)
    {
        foreach ($medias as $mediaName) {
            foreach ($record->getMedia($mediaName) as $recordMedia) {
                $transferTo->addMedia($recordMedia->getPath())->toMediaCollection($mediaName);
            }
        }
    }
}
