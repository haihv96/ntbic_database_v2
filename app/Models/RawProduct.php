<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class RawProduct extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'raw_products';
    protected $fillable = [
        'url',
        'name',
        'base_technology_category',
        'highlights',
        'description',
        'transfer_description',
        'results'
    ];

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'name' => 'Name',
            'base_technology_category' => 'Base Technology category',
            'highlights' => 'Highlights',
            'description' => 'Description',
            'transfer_description' => 'Transfer description',
            'results' => 'Results'
        ];
    }
}
