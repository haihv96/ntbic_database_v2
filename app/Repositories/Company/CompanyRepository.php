<?php

namespace App\Repositories\Company;

use App\Repositories\BaseRepository;
use App\Models\Company;
use DB;

class CompanyRepository extends BaseRepository implements CompanyInterface
{
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }


    public function indexQuery($search)
    {
        return $this->model
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

    public function showQuery($id)
    {
        return $this->model
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


    public function updatedQuery($id)
    {
        return $this->model
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

    public function baseAnalysis()
    {
        return $this->model
            ->rightJoin(
                'base_technology_categories',
                'base_technology_categories.id',
                '=',
                'companies.base_technology_category_id'
            )
            ->groupBy('base_technology_categories.id')
            ->select(
                'base_technology_categories.name as base_technology_category',
                DB::raw('COUNT(*) as count')
            )
            ->get();
    }
}