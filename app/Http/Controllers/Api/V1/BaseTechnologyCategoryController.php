<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryInterface;

class BaseTechnologyCategoryController extends BaseResourceController
{
    public function __construct(
        BaseTechnologyCategoryInterface $baseTechnologyCategoryRepository
    )
    {
        $this->recordRepository = $baseTechnologyCategoryRepository;
    }
}
