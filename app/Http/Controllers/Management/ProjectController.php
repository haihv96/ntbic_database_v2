<?php

namespace App\Http\Controllers\Management;

use App\Repositories\Project\ProjectInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProject;
use Closure;

class ProjectController extends RecordController
{
    public function __construct(ProjectInterface $profileRepository)
    {
        $this->recordRepository = $profileRepository;
        $this->viewIndex = 'management.projects.index';
        $this->viewRecords = 'management.projects.records';
        $this->viewShow = 'management.projects.show';
        $this->viewRecord = 'management.projects.record';
        $this->viewEdit = 'management.projects.edit';
        $this->viewCreate = 'management.projects.create';
    }

    public function store(UpdateProject $validStoreRequest)
    {
        return $this->storeRecord($validStoreRequest, function ($record) {
            $record->esIndexing();
        });
    }

    public function update(UpdateProject $validUpdateRequest, $id)
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
