<?php

namespace App\Repositories\BaseTechnologyCategory;

use App\Repositories\BaseRepository;
use App\Models\BaseTechnologyCategory;

class BaseTechnologyCategoryRepository extends BaseRepository implements BaseTechnologyCategoryInterface
{
    public function __construct(BaseTechnologyCategory $baseTechnologyCategory)
    {
        parent::__construct($baseTechnologyCategory);
    }
}