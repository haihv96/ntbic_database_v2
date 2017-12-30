<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\RecordController;
use App\Repositories\RawProfile\RawProfileInterface;
use App\Http\Requests\UpdateRawProfile;

class RawProfileController extends RecordController
{
    public function __construct(RawProfileInterface $rawProfileRepository)
    {
        $this->recordRepository = $rawProfileRepository;
        $this->viewIndex = 'management.raw-profiles.index';
        $this->viewRecords = 'management.raw-profiles.records';
        $this->viewShow = 'management.raw-profiles.show';
        $this->viewRecord = 'management.raw-profiles.record';
        $this->viewEdit = 'management.raw-profiles.edit';
    }

    public function update(UpdateRawProfile $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }
}
