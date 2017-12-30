<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\RecordController;
use App\Repositories\RawCompany\RawCompanyInterface;
use App\Http\Requests\UpdateRawCompany;

class RawCompanyController extends RecordController
{
    public function __construct(RawCompanyInterface $rawCompanyRepository)
    {
        $this->recordRepository = $rawCompanyRepository;
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
}
