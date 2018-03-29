<?php

namespace App\Http\Controllers\Management;

use App\Repositories\Company\CompanyInterface;
use App\Http\Requests\UpdateCompany;
use Closure;

class CompanyController extends RecordController
{
    public function __construct(CompanyInterface $companiesRepository)
    {
        $this->recordRepository = $companiesRepository;
        $this->viewIndex = 'management.companies.index';
        $this->viewRecords = 'management.companies.records';
        $this->viewShow = 'management.companies.show';
        $this->viewRecord = 'management.companies.record';
        $this->viewEdit = 'management.companies.edit';
    }

    public function customIndexQuery($search)
    {
        return $this->recordRepository
            ->join('provinces', 'provinces.id', '=', 'companies.province_id')
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'companies.base_technology_category_id'
            )
            ->select(
                'companies.*',
                'provinces.name as province',
                'base_technology_categories.name as base_technology_category'

            )
            ->where('companies.name', 'like', "%$search%");
    }

    public function customShowQuery($id)
    {
        return $this->recordRepository
            ->join('provinces', 'provinces.id', '=', 'companies.province_id')
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'companies.base_technology_category_id'
            )
            ->where('companies.id', $id)
            ->select(
                'companies.*',
                'provinces.name as province',
                'base_technology_categories.name as base_technology_category'

            )
            ->first();
    }


    public function customUpdatedQuery($id)
    {
        return $this->recordRepository
            ->join('provinces', 'provinces.id', '=', 'companies.province_id')
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'companies.base_technology_category_id'
            )
            ->where('companies.id', $id)
            ->select(
                'companies.*',
                'provinces.name as province',
                'base_technology_categories.name as base_technology_category'
            )
            ->first();
    }

    public function update(UpdateCompany $validUpdateRequest, $id)
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
