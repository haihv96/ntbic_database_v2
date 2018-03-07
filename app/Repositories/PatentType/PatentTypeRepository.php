<?php

namespace App\Repositories\PatentType;

use App\Repositories\BaseRepository;
use App\Models\PatentType;

class PatentTypeRepository extends BaseRepository implements PatentTypeInterface
{
    public function __construct(PatentType $patentType)
    {
        parent::__construct($patentType);
    }
}