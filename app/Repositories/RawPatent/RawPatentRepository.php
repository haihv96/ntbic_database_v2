<?php

namespace App\Repositories\RawPatent;

use App\Repositories\BaseRepository;
use App\Models\RawPatent;

class RawPatentRepository extends BaseRepository implements RawPatentInterface
{
    public function __construct(RawPatent $rawPatent)
    {
        parent::__construct($rawPatent);
    }

    public function getTransferData($ids)
    {
        $results = $ids ? $this->whereIn('id', $ids) : $this->model;
        return $results->select(
            'id', 'url', 'name', 'patent_code', 'public_date', 'provide_date', 'owner',
            'author', 'highlights', 'description', 'content_can_be_transferred', 'market_application'
        )->get();
    }
}