<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawProject extends Model
{
    protected $table = 'raw_projects';

    protected $fillable = ['url', 'name', 'project_code', 'technology_category',
        'start_date_invest', 'close_date', 'operator', 'author', 'highlights',
        'description', 'transfer_description', 'results'];
}
