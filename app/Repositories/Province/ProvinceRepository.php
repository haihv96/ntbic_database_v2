<?php

namespace App\Repositories\Province;

use App\Repositories\BaseRepository;
use App\Models\Province;

class ProvinceRepository extends BaseRepository implements ProvinceInterface
{
    public function __construct(Province $province)
    {
        parent::__construct($province);
    }
}