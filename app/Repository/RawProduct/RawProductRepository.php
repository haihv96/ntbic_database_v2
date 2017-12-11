<?php

namespace App\Repositories\RawProduct;

use App\Repositories\BaseRepository;
use App\Models\RawProduct;

class RawRepository extends BaseRepository implements RawProductInterface
{
    public function __construct(RawProduct $rawProduct)
    {
        parent::__construct($rawProduct);
    }
}