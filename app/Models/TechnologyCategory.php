<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnologyCategory extends Model
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
