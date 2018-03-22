<?php

namespace App\Http\Controllers\Management;

use App\Repositories\Patent\PatentInterface;
use App\Http\Requests\UpdatePatent;

class PatentController extends RecordController
{
    public function __construct(PatentInterface $patentRepository)
    {
        $this->recordRepository = $patentRepository;
        $this->viewIndex = 'management.patents.index';
        $this->viewRecords = 'management.patents.records';
        $this->viewShow = 'management.patents.show';
        $this->viewRecord = 'management.patents.record';
        $this->viewEdit = 'management.patents.edit';
    }

    public function customIndexQuery($search)
    {
        return $this->recordRepository
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'patents.base_technology_category_id'
            )
            ->select(
                'patents.*',
                'base_technology_categories.name as base_technology_category'
            )
            ->where('patents.name', 'like', "%$search%");
    }

    public function customShowQuery($id)
    {
        return $this->recordRepository
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'patents.base_technology_category_id'
            )
            ->join('patent_types', 'patent_types.id', '=', 'patents.patent_type_id')
            ->select(
                'patents.*',
                'base_technology_categories.name as base_technology_category',
                'patent_types.name as patent_type'
            )
            ->where('patents.id', $id)
            ->first();
    }

    public function customUpdatedQuery($id)
    {
        return $this->recordRepository
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'patents.base_technology_category_id'
            )
            ->select('patents.*', 'base_technology_categories.name as base_technology_category')
            ->where('patents.id', $id)
            ->first();
    }

    public function update(UpdatePatent $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }
}
