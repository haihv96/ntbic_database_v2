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
    }

    public function customIndexQuery($search)
    {
        return $this->recordRepository
            ->join('specializations', 'specializations.id', '=', 'projects.specialization_id')
            ->join('technology_categories', 'technology_categories.id', '=', 'specializations.technology_category_id')
            ->select(
                'projects.*',
                DB::raw('CONCAT(technology_categories.name," (",specializations.name,")") as specialization')
            )
            ->where('projects.name', 'like', "%$search%");
    }

    public function customShowQuery($id)
    {
        return $this->recordRepository
            ->join('specializations', 'specializations.id', '=', 'projects.specialization_id')
            ->join('technology_categories', 'technology_categories.id', '=', 'specializations.technology_category_id')
            ->select(
                'projects.*',
                DB::raw('CONCAT(technology_categories.name," (",specializations.name,")") as specialization')
            )
            ->where('projects.id', $id)
            ->first();
    }

    public function customUpdatedQuery($id)
    {
        return $this->recordRepository
            ->join('specializations', 'specializations.id', '=', 'projects.specialization_id')
            ->join('technology_categories', 'technology_categories.id', '=', 'specializations.technology_category_id')
            ->select(
                'projects.*',
                DB::raw('CONCAT(technology_categories.name," (",specializations.name,")") as specialization')
            )
            ->where('projects.id', $id)
            ->first();
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
