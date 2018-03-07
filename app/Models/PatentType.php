<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatentType extends Model
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
