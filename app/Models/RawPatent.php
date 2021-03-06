<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class RawPatent extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    protected $table = 'raw_patents';
    protected $fillable = [
        'url',
        'name',
        'patent_code',
        'base_technology_category',
        'public_date',
        'provide_date',
        'owner',
        'author',
        'highlights',
        'description',
        'content_can_be_transferred',
        'market_application'
    ];

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'name' => 'Name',
            'patent_code' => 'Patent code',
            'base_technology_category' => 'Base Technology category',
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
}
