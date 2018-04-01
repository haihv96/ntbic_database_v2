<?php

namespace App\Repositories\RawProduct;

use App\Repositories\BaseRepository;
use App\Models\RawProduct;

class RawProductRepository extends BaseRepository implements RawProductInterface
{
    public function __construct(RawProduct $rawProduct)
    {
        parent::__construct($rawProduct);
    }

    public function getTransferData($ids)
    {
        $results = $ids ? $this->whereIn('id', $ids) : $this->model;
        return $results->select(
            'id', 'url', 'name', 'highlights', 'description',
            'transfer_description', 'results'
        )->get();
    }
}