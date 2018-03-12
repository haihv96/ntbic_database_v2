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
        return $this->transferRecord($ids);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject([
            'url',
            'name',
            'last_update',
            'headquarters',
            'email',
            'phone',
            'fax',
            'website',
            'company_code',
            'tax_code',
            'type',
            'founded',
            'founder',
            'founder_phone',
            'founder_email',
            'founder_address',
            'industry',
            'tax_information',
            'company_branch',
            'representative_office',
            'TRC_number',
            'TRC_date',
            'TRC_place',
            'technology_rank',
            'research_for',
            'number_of_employees_research',
            'technology_highlight',
            'technology_using',
            'technology_transfer',
            'results',
            'products'
        ], $record, new Company);

        $transferTo->province()->associate(
            $this->provinceRepository->findBy('normalize', strNormalize($record->province)) ??
            $this->provinceRepository->findBy('normalize', strNormalize('Khác'))
        );

        $transferTo->baseTechnologyCategory()->associate(
            $this->baseTechnologyCategoryRepository->findBy('normalize', strNormalize($record->base_technology_category))
        );

        $transferTo->path = strToPath($record->name);

        return $transferTo;
    }
}
