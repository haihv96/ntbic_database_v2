<?php

namespace App\Models;

class RawProject extends BaseModel
{
    protected $table = 'raw_projects';

    protected $fillable = [
        'url',
        'name',
        'project_code',
        'specialization',
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
            'specialization' => 'Specialization',
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
}
