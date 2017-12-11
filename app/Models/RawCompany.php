<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class RawCompany extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'raw_companies';
    protected $fillable = [
        'url',
        'image',
        'name',
        'last_update',
        'technology_category',
        'province',
        'headquarters',
        'email',
        'phone',
        'fax',
        'website',
        'company_code',
        'tax_code',
        'type',
        'founded',
        'founder',
        'founder_phone',
        'founder_email',
        'founder_address',
        'industry',
        'tax_information',
        'company_branch',
        'representative_office',
        'TRC_number',
        'TRC_date',
        'TRC_place',
        'technology_rank',
        'research_for',
        'number_of_employees_research',
        'technology_highlight',
        'technology_using',
        'technology_transfer',
        'results',
        'products'
    ];
}
