<?php

namespace App\Models;

class BaseTechnologyCategory extends BaseModel
{
    protected $table = 'base_technology_categories';
    protected $fillable = [
        'name',
        'normalize'
    ];
}
