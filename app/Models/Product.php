<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'products';
    protected $fillable = [
        'url',
        'name',
        'base_technology_category_id',
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
            'technology_category' => 'Technology category',
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
