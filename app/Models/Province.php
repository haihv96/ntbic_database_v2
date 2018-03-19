<?php

namespace App\Models;

class Province extends BaseModel
{
    protected $table = 'provinces';
    protected $fillable = [
        'name',
        'normalize'
    ];
}
