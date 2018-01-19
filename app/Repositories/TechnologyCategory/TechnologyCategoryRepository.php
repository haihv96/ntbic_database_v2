<?php

namespace App\Repositories\TechnologyCategory;

use App\Repositories\BaseRepository;
use App\Models\TechnologyCategory;

class TechnologyCategoryRepository extends BaseRepository implements TechnologyCategoryInterface
{
    public function __construct(TechnologyCategory $technologyCategory)
    {
        parent::__construct($technologyCategory);
    }
}