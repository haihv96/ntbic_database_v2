<?php

namespace App\Repositories\Company;

interface CompanyInterface
{
    public function indexQuery($search);

    public function showQuery($id);

    public function updatedQuery($id);
}
