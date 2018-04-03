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
