<?php

namespace App\Repositories\Specialization;

use App\Repositories\BaseRepository;
use App\Models\Specialization;

class SpecializationRepository extends BaseRepository implements SpecializationInterface
{
    public function __construct(Specialization $pecialization)
    {
        parent::__construct($pecialization);
    }
}