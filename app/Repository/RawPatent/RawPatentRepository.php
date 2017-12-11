<?php

namespace App\Repositories\RawPatent;

use App\Repositories\BaseRepository;
use App\Models\RawPatent;

class RawRepository extends BaseRepository implements RawPatentInterface
{
    public function __construct(RawPatent $rawPatent)
    {
        parent::__construct($rawPatent);
    }
}