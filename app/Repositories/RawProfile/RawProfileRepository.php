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

    public function getTransferData($ids)
    {
        $results = $ids ? $this->whereIn('id', $ids) : $this->model;
        return $results->select(
            'id', 'url', 'studies_or_papers', 'name', 'birthday', 'specialization', 'agency',
            'agency_address', 'research_for', 'research_joined', 'research_results'
        )->get();
    }
}