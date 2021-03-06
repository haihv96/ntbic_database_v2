<?php

namespace App\Models;

class Project extends BaseModel
{
    protected $table = 'projects';

    protected $fillable = [
        'url',
        'path',
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

    protected $esIndexName = 'projects';

    protected $esTypeName = 'projects';

    protected $esAttributes =[
        'name', 'project_code', 'specialization_id', 'operator',
        'author', 'highlights', 'description', 'results'
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

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
