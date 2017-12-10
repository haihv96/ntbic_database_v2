<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawPatent extends Model
{
    protected $table = 'raw_patents';

    protected $fillable = ['url', 'name', 'patent_code', 'technology_category', 'public_date',
        'provide_date', 'owner', 'author', 'highlights', 'description',
        'content_can_be_transferred', 'market_application', 'image'];
}
