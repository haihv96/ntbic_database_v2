<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Product extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'products';
    protected $fillable = [
        'url',
        'path',
        'name',
        'base_technology_category_id',
        'highlights',
        'description',
        'transfer_description',
        'results'
    ];

    protected $esIndexName = 'products';
    protected $esTypeName = 'products';
    protected $esAttributes = [
        'name', 'base_technology_category_id', 'highlights',
        'description', 'results'
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

    public function baseTechnologyCategory()
    {
        return $this->belongsTo(BaseTechnologyCategory::class);
    }
}
