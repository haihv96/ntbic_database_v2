<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'url',
        'name',
        'project_code',
        'specialization_id',
        'start_date_invest',
        'close_date',
        'operator',
        'author',
        'highlights',
        'description',
        'transfer_description',
        'results'
    ];

    public function attrNames()
    {
        return [
            'url' => 'Source url',
            'name' => 'Name',
            'project_code' => 'Project code',
            'technology_category' => 'Technology category',
            'start_date_invest' => 'Start date invest',
            'close_date' => 'Close date',
            'operator' => 'Operator',
            'author' => 'Author',
            'highlights' => 'Highlights',
            'description' => 'Description',
            'transfer_description' => 'Transfer description',
            'results' => 'Results'
        ];
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
