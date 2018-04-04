<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Province\ProvinceInterface;

class ProvinceController extends BaseResourceController
{
    public function __construct(ProvinceInterface $provinceRepository)
    {
        $this->recordRepository = $provinceRepository;
    }
}
