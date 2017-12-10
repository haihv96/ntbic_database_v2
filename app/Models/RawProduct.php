<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawProduct extends Model
{
    protected $table = 'raw_products';

    protected $fillable = ['url', 'thumb', 'name', 'technology_category', 'highlights',
        'description', 'transfer_description', 'results'];
}
