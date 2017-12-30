<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\RecordController;
use App\Repositories\RawProject\RawProjectInterface;
use App\Http\Requests\UpdateRawProject;

class RawProjectController extends RecordController
{
    public function __construct(RawProjectInterface $rawProjectRepository)
    {
        $this->recordRepository = $rawProjectRepository;
        $this->viewIndex = 'management.raw-projects.index';
        $this->viewRecords = 'management.raw-projects.records';
        $this->viewShow = 'management.raw-projects.show';
        $this->viewRecord = 'management.raw-projects.record';
        $this->viewEdit = 'management.raw-projects.edit';
    }

    public function update(UpdateRawProject $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }
}
