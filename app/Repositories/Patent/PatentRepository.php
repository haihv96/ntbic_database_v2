<?php

namespace App\Repositories\Patent;

use App\Repositories\BaseRepository;
use App\Models\Patent;

class PatentRepository extends BaseRepository implements PatentInterface
{
    public function __construct(Patent $patent)
    {
        parent::__construct($patent);
    }
}