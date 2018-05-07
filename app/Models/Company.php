<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Company extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'companies';
    protected $fillable = [
        'url', 'path', 'name', 'last_update', 'base_technology_category_id', 'province_id',
        'headquarters', 'email', 'phone', 'fax', 'website', 'company_code',
        'tax_code', 'type', 'founded', 'founder', 'founder_phone', 'founder_email',
        'founder_address', 'industry', 'tax_information', 'company_branch',
        'representative_office', 'TRC_number', 'TRC_date', 'TRC_place',
        'technology_rank', 'research_for', 'number_of_employees_research',
        'technology_highlight', 'technology_using', 'technology_transfer',
        'results', 'products'
    ];


    protected $esIndexName = 'companies';
    protected $esTypeName = 'companies';
    protected $esAttributes = [
        'name', 'base_technology_category_id', 'province_id', 'headquarters',
        'company_code', 'founder', 'industry', 'research_for',
        'technology_highlight', 'technology_using', 'results', 'products'
    ];

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'name' => 'Name',
            'last_update' => 'Last update',
            'base_technology_category' => 'Base Technology category',
            'province' => 'Province',
            'headquarters' => 'Headquarters',
            'email' => 'Email',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'website' => 'Website',
            'company_code' => 'Company code',
            'tax_code' => 'Tax code',
            'type' => 'Type',
            'founded' => 'Founded',
            'founder' => 'Founder',
            'founder_phone' => 'Founder phone',
            'founder_email' => 'Founder email',
            'founder_address' => 'Founder address',
            'industry' => 'Industry',
            'tax_information' => 'Tax information',
            'company_branch' => 'Company branch',
            'representative_office' => 'Representative office',
            'TRC_number' => 'Technology registration certificate number',
            'TRC_date' => 'Technology registration certificate date',
            'TRC_place' => 'Technology registration certificate place',
            'technology_rank' => 'Technology rank',
            'research_for' => 'Research for',
            'number_of_employees_research' => 'Number of employees research',
            'technology_highlight' => 'Technology highlight',
            'technology_using' => 'Technology using',
            'technology_transfer' => 'Technology transfer',
            'results' => 'Results',
            'products' => 'Products'
        ];
    }

    public function baseTechnologyCategory()
    {
        return $this->belongsTo(BaseTechnologyCategory::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
