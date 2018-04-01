<?php

namespace App\Repositories\RawCompany;

use App\Repositories\BaseRepository;
use App\Models\RawCompany;

class RawCompanyRepository extends BaseRepository implements RawCompanyInterface
{
    public function __construct(RawCompany $rawCompany)
    {
        parent::__construct($rawCompany);
    }

    public function getTransferData($ids)
    {
        $results = $ids ? $this->whereIn('id', $ids) : $this->model;
        return $results->select(
            'id', 'url', 'name', 'last_update', 'headquarters', 'email', 'phone', 'fax',
            'website', 'company_code', 'tax_code', 'type', 'founded', 'founder',
            'founder_phone', 'founder_email', 'founder_address', 'industry', 'tax_information',
            'company_branch', 'representative_office', 'TRC_number', 'TRC_date', 'TRC_place',
            'technology_rank', 'research_for', 'number_of_employees_research',
            'technology_highlight', 'technology_using', 'technology_transfer',
            'results', 'products'
        )->get();
    }
}