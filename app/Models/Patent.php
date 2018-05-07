<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Patent extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    protected $table = 'patents';
    protected $fillable = [
        'url',
        'path',
        'name',
        'patent_code',
        'base_technology_category_id',
        'patent_type_id',
        'public_date',
        'provide_date',
        'owner',
        'author',
        'highlights',
        'description',
        'content_can_be_transferred',
        'market_application'
    ];

    protected $esIndexName = 'patents';
    protected $esTypeName = 'patents';
    protected $esAttributes = [
        'name', 'patent_code', 'base_technology_category_id',
        'patent_type_id', 'owner', 'author', 'highlights',
        'description',
    ];

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'name' => 'Name',
            'patent_code' => 'Patent code',
            'base_technology_category' => 'Base Technology category',
            'patent_type' => 'Patent Type',
            'public_date' => 'Public date',
            'provide_date' => 'Provide date',
            'owner' => 'Owner',
            'author' => 'Author',
            'highlights' => 'HighLights',
            'description' => 'Description',
            'content_can_be_transferred' => 'Content can be transferred',
            'market_application' => 'Market application',
        ];
    }

    public function baseTechnologyCategory()
    {
        return $this->belongsTo(BaseTechnologyCategory::class);
    }

    public function patentType()
    {
        return $this->belongsTo(PatentType::class);
    }
}
