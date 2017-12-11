<?php

namespace App\Repositories\RawCompany;

use App\Repositories\BaseRepository;
use App\Models\RawCompany;

class RawRepository extends BaseRepository implements RawCompanyInterface
{
    public function __construct(RawCompany $rawCompany)
    {
        parent::__construct($rawCompany);
    }
}