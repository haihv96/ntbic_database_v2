<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\RecordController;
use App\Repositories\RawPatent\RawPatentInterface;
use App\Http\Requests\UpdateRawPatent;

class RawPatentController extends RecordController
{
    public function __construct(RawPatentInterface $rawProfileRepository)
    {
        $this->recordRepository = $rawProfileRepository;
        $this->viewIndex = 'management.raw-patents.index';
        $this->viewRecords = 'management.raw-patents.records';
        $this->viewShow = 'management.raw-patents.show';
        $this->viewRecord = 'management.raw-patents.record';
        $this->viewEdit = 'management.raw-patents.edit';
    }

    public function update(UpdateRawPatent $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }
}
