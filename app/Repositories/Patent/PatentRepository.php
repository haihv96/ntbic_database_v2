<?php

namespace App\Repositories\Patent;

use App\Repositories\BaseRepository;
use App\Models\Patent;
use DB;

class PatentRepository extends BaseRepository implements PatentInterface
{
    public function __construct(Patent $patent)
    {
        parent::__construct($patent);
    }

    public function indexQuery($search)
    {
        return $this->model
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

    public function showQuery($id)
    {
        return $this->model
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

    public function updatedQuery($id)
    {
        return $this->model
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

    public function baseAnalysis()
    {
        return $this->model
            ->rightJoin(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'patents.base_technology_category_id'
            )
            ->groupBy('base_technology_categories.id')
            ->select(
                'base_technology_categories.name as base_technology_category',
                DB::raw('COUNT(*) as patents')
            )
            ->get();
    }
}