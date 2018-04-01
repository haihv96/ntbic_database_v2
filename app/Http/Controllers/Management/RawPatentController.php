<?php

namespace App\Http\Controllers\Management;

use App\Models\Patent;
use App\Repositories\RawPatent\RawPatentInterface;
use App\Repositories\PatentType\PatentTypeInterface;
use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryInterface;
use App\Http\Requests\UpdateRawPatent;

class RawPatentController extends RecordController
{
    protected $baseTechnologyCategoryRepository,
        $patentTypeRepository;

    public function __construct(
        RawPatentInterface $rawPatentRepository,
        PatentTypeInterface $patentTypeRepository,
        BaseTechnologyCategoryInterface $baseTechnologyCategoryRepository
    )
    {
        $this->baseTechnologyCategoryRepository = $baseTechnologyCategoryRepository;
        $this->recordRepository = $rawPatentRepository;
        $this->patentTypeRepository = $patentTypeRepository;
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

    public function transfer($ids)
    {
        return $this->transferData($ids, ['image']);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject($record, new Patent);
        $btcNormalize = strNormalize($record->base_technology_category);
        $transferTo->baseTechnologyCategory()->associate(
            $this->baseTechnologyCategoryRepository->whereRaw("INSTR('$btcNormalize',normalize)<>0")->first() ??
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize('Công nghệ khác'))
        );

        $transferTo->patentType()->associate(
            $this->patentTypeRepository->whereRaw("INSTR('$btcNormalize',normalize)<>0")->first() ??
            $this->patentTypeRepository->findBy('normalize', strNormalize('Khác'))
        );
        $transferTo->path = strToPath($record->name);
        return $transferTo;
    }
}
