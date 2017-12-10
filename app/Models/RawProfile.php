<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawProfile extends Model
{
    protected $table = 'raw_profiles';
    protected $fillable = [
        'url',
        'studies_or_papers',
        'name',
        'acadamic_title',
        'birthday',
        'specialization',
        'agency',
        'agency_address',
        'research_for',
        'research_joined',
        'research_results',
        'image'
    ];
}
