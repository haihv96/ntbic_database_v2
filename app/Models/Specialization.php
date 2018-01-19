<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
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
