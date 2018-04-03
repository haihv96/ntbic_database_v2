<?php

namespace App\Repositories\Patent;

interface PatentInterface
{
    public function indexQuery($search);

    public function showQuery($id);

    public function updatedQuery($id);
}
