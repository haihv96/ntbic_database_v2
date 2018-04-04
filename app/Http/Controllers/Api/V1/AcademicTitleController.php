<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\AcademicTitle\AcademicTitleInterface;

class AcademicTitleController extends BaseResourceController
{
    public function __construct(AcademicTitleInterface $academicTitleRepository)
    {
        $this->recordRepository = $academicTitleRepository;
    }
}
