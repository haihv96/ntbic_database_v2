<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\RecordController;
use App\Repositories\RawProduct\RawProductInterface;
use App\Http\Requests\UpdateRawProduct;

class RawProductController extends RecordController
{
    public function __construct(RawProductInterface $rawProfileRepository)
    {
        $this->recordRepository = $rawProfileRepository;
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
}
