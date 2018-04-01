<?php

namespace App\Repositories\RawProfile;

use App\Repositories\BaseRepository;
use App\Models\RawProfile;

class RawProfileRepository extends BaseRepository implements RawProfileInterface
{
    public function __construct(RawProfile $rawProfile)
    {
        parent::__construct($rawProfile);
    }
}
