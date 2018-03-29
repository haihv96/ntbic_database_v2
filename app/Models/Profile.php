<?php

namespace App\Models;

use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Profile extends BaseModel implements HasMediaConversions
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
        'research_results',
    ];

    protected $esIndexName = 'profiles';

    protected $esTypeName = 'profiles';

    protected $esAttributes = [
        'name', 'province_id', 'academic_title_id', 'specialization',
        'agency', 'research_for', 'research_joined', 'research_results'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->performOnCollections('avatar');
    }

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'studies_or_papers' => 'Studies or papers',
            'name' => 'Name',
            'province' => 'Province',
            'academic_title' => 'Academic title',
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

    public function getAcademicTitlesAttribute()
    {
        return AcademicTitle::select('id', 'name')->get()->mapWithKeys(function ($entry) {
            return [$entry->id => $entry->name];
        })->sortBy(function ($value, $key) {
            return $key;
        })->all();
    }
}
