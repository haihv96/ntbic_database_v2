<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class RawProduct extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'raw_products';
    protected $fillable = [
        'url',
        'name',
        'technology_category',
        'highlights',
        'description',
        'transfer_description',
        'results'
    ];
}
