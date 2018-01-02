<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicTitle extends Model
{
    protected $table = 'academic_titles';
    protected $fillable = [
        'name',
        'en_description'
    ];
}
