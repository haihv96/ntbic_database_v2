<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\TechnologyCategory\TechnologyCategoryInterface;

class TechnologyCategoryController extends BaseResourceController
{
    public function __construct(
        TechnologyCategoryInterface $technologyCategoryRepository
    )
    {
        $this->recordRepository = $technologyCategoryRepository;
    }
}
