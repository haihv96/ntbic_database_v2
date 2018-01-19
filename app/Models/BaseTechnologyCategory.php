<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseTechnologyCategory extends Model
{
    protected $table = 'base_technology_categories';
    protected $fillable = [
        'name',
        'normalize'
    ];
}
