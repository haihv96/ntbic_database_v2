<?php

namespace App\Models;

class PatentType extends BaseModel
{
    protected $table = 'patent_types';
    protected $fillable = [
        'name',
        'normalize'
    ];

    public function patents()
    {
        return $this->hasMany(Patent::class);
    }
}
