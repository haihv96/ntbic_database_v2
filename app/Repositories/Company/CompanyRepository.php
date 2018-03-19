<?php

namespace App\Repositories\Company;

use App\Repositories\BaseRepository;
use App\Models\Company;

class CompanyRepository extends BaseRepository implements CompanyInterface
{
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }
}