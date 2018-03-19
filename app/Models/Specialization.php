<?php

namespace App\Models;

class Specialization extends BaseModel
{
    protected $table = 'specializations';
    protected $fillable = [
        'name',
        'normalize'
    ];

    public function technologyCategory()
    {
        return $this->belongsTo(TechnologyCategory::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
