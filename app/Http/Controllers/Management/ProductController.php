<?php

namespace App\Http\Controllers\Management;

use App\Repositories\Product\ProductInterface;
use App\Http\Requests\UpdateProduct;
use Closure;

class ProductController extends RecordController
{
    public function __construct(ProductInterface $productRepository)
    {
        $this->recordRepository = $productRepository;
        $this->viewIndex = 'management.products.index';
        $this->viewRecords = 'management.products.records';
        $this->viewShow = 'management.products.show';
        $this->viewRecord = 'management.products.record';
        $this->viewEdit = 'management.products.edit';
        $this->viewCreate = 'management.products.create';
    }

    public function store(UpdateProduct $validStoreRequest)
    {
        return $this->storeRecord($validStoreRequest, function ($record) {
            $record->esIndexing();
        });
    }

    public function update(UpdateProduct $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id, function ($record) {
            $record->esUpdate();
        });
    }

    public function destroy($ids, Closure $callback = null)
    {
        return parent::destroy($ids, function ($record) {
            $record->esDelete();
        });
    }
}
