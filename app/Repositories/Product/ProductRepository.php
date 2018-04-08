<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Product;
use DB;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function indexQuery($search)
    {
        return $this->model
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

    public function showQuery($id)
    {
        return $this->model
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

    public function updatedQuery($id)
    {
        return $this->model
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

    public function baseAnalysis()
    {
        return $this->model
            ->rightJoin(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'products.base_technology_category_id'
            )
            ->groupBy('base_technology_categories.id')
            ->select(
                'base_technology_categories.name as base_technology_category',
                DB::raw('COUNT(*) as count')
            )
            ->get();
    }

}