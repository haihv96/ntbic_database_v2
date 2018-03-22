<?php

namespace App\Http\Controllers\Management;

use App\Models\Product;
use App\Repositories\RawProduct\RawProductInterface;
use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryInterface;
use App\Http\Requests\UpdateRawProduct;

class RawProductController extends RecordController
{
    protected $baseTechnologyCategoryRepository;

    public function __construct(
        RawProductInterface $rawProfileRepository,
        BaseTechnologyCategoryInterface $baseTechnologyCategoryRepository)
    {
        $this->recordRepository = $rawProfileRepository;
        $this->baseTechnologyCategoryRepository = $baseTechnologyCategoryRepository;
        $this->viewIndex = 'management.raw-products.index';
        $this->viewRecords = 'management.raw-products.records';
        $this->viewShow = 'management.raw-products.show';
        $this->viewRecord = 'management.raw-products.record';
        $this->viewEdit = 'management.raw-products.edit';
    }

    public function update(UpdateRawProduct $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }


    public function transfer($ids)
    {
        return $this->transferRecord($ids, ['thumb']);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject([
            'url',
            'name',
            'highlights',
            'description',
            'transfer_description',
            'results'
        ], $record, new Product);

        $transferTo->baseTechnologyCategory()->associate(
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize($record->base_technology_category)) ??
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize('Công nghệ khác'))
        );
        $transferTo->path = strToPath($record->name);
        return $transferTo;
    }
}
