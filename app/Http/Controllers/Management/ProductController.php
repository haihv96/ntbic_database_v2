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
    }

    public function customIndexQuery($search)
    {
        return $this->recordRepository
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'products.base_technology_category_id'
            )
            ->select(
                'products.*',
                'base_technology_categories.name as base_technology_category'
            )
            ->where('products.name', 'like', "%$search%");
    }

    public function customShowQuery($id)
    {
        return $this->recordRepository
            ->where('products.id', $id)
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'products.base_technology_category_id'
            )
            ->select(
                'products.*',
                'base_technology_categories.name as base_technology_category'
            )
            ->first();
    }

    public function customUpdatedQuery($id)
    {
        return $this->recordRepository
            ->where('products.id', $id)
            ->join(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'products.base_technology_category_id'
            )
            ->select(
                'products.*',
                'base_technology_categories.name as base_technology_category'
            )
            ->first();
    }

    public function update(UpdateProduct $validUpdateRequest, $id)
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
