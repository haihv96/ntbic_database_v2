<?php

namespace App\Models;

class AcademicTitle extends BaseModel
{
    protected $table = 'academic_titles';
    protected $fillable = [
        'name',
        'en_description',
        'normalize'
    ];
}
