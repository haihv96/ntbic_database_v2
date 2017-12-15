<?php

namespace App\Repositories\RawProject;

use App\Repositories\BaseRepository;
use App\Models\RawProject;

class RawProjectRepository extends BaseRepository implements RawProjectInterface
{
    public function __construct(RawProject $rawProject)
    {
        parent::__construct($rawProject);
    }
}