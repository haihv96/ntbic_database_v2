<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class RawProfile extends Model implements HasMediaConversions
{
    use HasMediaTrait;

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
        'research_results'
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
            'acadamic_title' => 'Academic_title',
            'birthday' => 'Birthday',
            'specialization' => 'Specialization',
            'agency' => 'Agency',
            'agency_address' => 'Agency address',
            'research_for' => 'Research for',
            'research_joined' => 'Research joined',
            'research_results' => 'Research results'
        ];
    }
}
