<?php

namespace App\Http\Controllers\Management;

use App\Repositories\Patent\PatentInterface;
use App\Http\Requests\UpdatePatent;
use Closure;

class PatentController extends RecordController
{
    public function __construct(PatentInterface $patentRepository)
    {
        $this->recordRepository = $patentRepository;
        $this->viewIndex = 'management.patents.index';
        $this->viewRecords = 'management.patents.records';
        $this->viewShow = 'management.patents.show';
        $this->viewRecord = 'management.patents.record';
        $this->viewEdit = 'management.patents.edit';
        $this->viewCreate = 'management.patents.create';
    }

    public function store(UpdatePatent $validStoreRequest)
    {
        return $this->storeRecord($validStoreRequest, function ($record) {
            $record->esIndexing();
        });
    }

    public function update(UpdatePatent $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id, function($record){
            $record->esUpdate();
        });
    }

    public function destroy($ids, Closure $callback = null)
    {
        return parent::destroy($ids, function($record){
            $record->esDelete();
        });
    }
}
