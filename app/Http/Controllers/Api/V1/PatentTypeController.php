<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\PatentType\PatentTypeInterface;

class PatentTypeController extends BaseResourceController
{
    public function __construct(PatentTypeInterface $patentTypeRepository)
    {
        $this->recordRepository = $patentTypeRepository;
    }
}
