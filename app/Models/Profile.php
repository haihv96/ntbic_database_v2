<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Profile extends Model
{
    use HasMediaTrait;

    protected $table = 'profiles';
    protected $fillable = [
        'url',
        'studies_or_papers',
        'name',
        'province_id',
        'academic_title_id',
        'birthday',
        'specialization',
        'agency',
        'agency_address',
        'research_for',
        'research_joined',
        'research_results'
    ];

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'studies_or_papers' => 'Studies or papers',
            'name' => 'Name',
            'academic_title' => 'Academic_title',
            'birthday' => 'Birthday',
            'specialization' => 'Specialization',
            'agency' => 'Agency',
            'agency_address' => 'Agency address',
            'research_for' => 'Research for',
            'research_joined' => 'Research joined',
            'research_results' => 'Research results'
        ];
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function academicTitle()
    {
        return $this->belongsTo(AcademicTitle::class, 'academic_title_id');
    }
}
