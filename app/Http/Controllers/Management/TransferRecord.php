<?php

namespace App\Http\Controllers\Management;

use Illuminate\Support\Facades\DB;

trait TransferRecord
{
    public function transferData($ids, $medias = false)
    {
        $records = $this->recordRepository->getTransferData(json_decode($ids));
        foreach ($records as $record) {
            try {
                DB::beginTransaction();
                $transferTo = $this->transferToRecordModel($record);
                $transferTo->save();
                $medias && $this->transferMedia($record, $transferTo, $medias);
                $record->delete();
                $transferTo->esIndexing();
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
