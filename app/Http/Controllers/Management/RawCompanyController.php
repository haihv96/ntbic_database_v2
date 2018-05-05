<?php

namespace App\Http\Controllers\Management;

use App\Models\Company;
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\RawCompany\RawCompanyInterface;
use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryInterface;
use App\Http\Requests\UpdateRawCompany;

class RawCompanyController extends RecordController
{
    protected $provinceRepository,
        $baseTechnologyCategoryRepository;

    public function __construct(
        RawCompanyInterface $rawCompanyRepository,
        ProvinceInterface $provinceRepository,
        BaseTechnologyCategoryInterface $baseTechnologyCategoryRepository
    )
    {
        $this->recordRepository = $rawCompanyRepository;
        $this->provinceRepository = $provinceRepository;
        $this->baseTechnologyCategoryRepository = $baseTechnologyCategoryRepository;
        $this->viewIndex = 'management.raw-companies.index';
        $this->viewRecords = 'management.raw-companies.records';
        $this->viewShow = 'management.raw-companies.show';
        $this->viewRecord = 'management.raw-companies.record';
        $this->viewEdit = 'management.raw-companies.edit';
    }

    public function update(UpdateRawCompany $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }


    public function transfer($ids)
    {
        return $this->transferData($ids, ['logo']);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject($record, new Company);
        $transferTo->province()->associate(
            $this->provinceRepository->findBy('normalize', strNormalize($record->province)) ??
            $this->provinceRepository->findBy('normalize', strNormalize('Khác'))
        );

        $transferTo->baseTechnologyCategory()->associate(
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize($record->base_technology_category)) ??
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize('Công nghệ khác'))
        );

        $transferTo->path = substr(strToPath($record->name), 0, 250);

        return $transferTo;
    }
}
