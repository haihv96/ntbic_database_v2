<?php

namespace App\Http\Controllers\Management;

use App\Repositories\RawProject\RawProjectInterface;
use App\Repositories\Specialization\SpecializationInterface;
use App\Repositories\TechnologyCategory\TechnologyCategoryInterface;
use App\Http\Requests\UpdateRawProject;
use App\Models\Project;

class RawProjectController extends RecordController
{
    protected $specializationRepository,
        $technologyCategoryRepository;

    public function __construct(
        RawProjectInterface $rawProjectRepository,
        SpecializationInterface $specializationRepository,
        TechnologyCategoryInterface $technologyCategoryRepository
    )
    {
        $this->recordRepository = $rawProjectRepository;
        $this->viewIndex = 'management.raw-projects.index';
        $this->viewRecords = 'management.raw-projects.records';
        $this->viewShow = 'management.raw-projects.show';
        $this->viewRecord = 'management.raw-projects.record';
        $this->viewEdit = 'management.raw-projects.edit';
        $this->specializationRepository = $specializationRepository;
        $this->technologyCategoryRepository = $technologyCategoryRepository;
    }

    public function update(UpdateRawProject $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }

    public function transfer($ids)
    {
        return $this->transferData($ids);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject($record, new Project);
        $tcNormalize = $record->specialization;
        $transferTo->specialization()->associate(
            $this->specializationRepository->whereRaw("INSTR('$tcNormalize', name)<>0")->first() ??
            $this->specializationRepository->findBy('normalize', strNormalize('Khác'))
        );

        $transferTo->path = strToPath($record->name);

        return $transferTo;
    }
}
