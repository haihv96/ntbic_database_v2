<?php

namespace App\Models;

class TechnologyCategory extends BaseModel
{
    protected $table = 'technology_categories';
    protected $fillable = [
        'name',
        'normalize'
    ];

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
}
