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
        return $this->transferRecord($ids, ['image']);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject([
            'url',
            'name',
            'patent_code',
            'public_date',
            'provide_date',
            'owner',
            'author',
            'highlights',
            'description',
            'content_can_be_transferred',
            'market_application'
        ], $record, new Patent);

        $btcNormalize = strNormalize($record->base_technology_category);
        $transferTo->baseTechnologyCategory()->associate(
            $this->baseTechnologyCategoryRepository->whereRaw("INSTR('$btcNormalize',normalize)<>0")->first()
        );

        $transferTo->patentType()->associate(
            $this->patentTypeRepository->whereRaw("INSTR('$btcNormalize',normalize)<>0")->first()
        );
        $transferTo->path = strToPath($record->name);
        return $transferTo;
    }
}
