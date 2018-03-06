<?php

namespace App\Http\Controllers\Management;

use App\Repositories\RawPatent\RawPatentInterface;
use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryInterface;
use App\Http\Requests\UpdateRawPatent;

class RawPatentController extends RecordController
{
    protected $baseTechnologyCategoryRepository;

    public function __construct(
        RawPatentInterface $rawProfileRepository,
        BaseTechnologyCategoryInterface $baseTechnologyCategoryRepository
    )
    {
        $this->baseTechnologyCategoryRepository = $baseTechnologyCategoryRepository;
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

    public function transferToRecordModel($record, $transferTo)
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
        ], $record, $transferTo);

        $transferTo->province()->associate(
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize($record->province))
        );
        $transferTo->path = strToPath($record->name);
        return $transferTo;
    }
}
