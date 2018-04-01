<?php

namespace App\Repositories\RawProject;

use App\Repositories\BaseRepository;
use App\Models\RawProject;

class RawProjectRepository extends BaseRepository implements RawProjectInterface
{
    public function __construct(RawProject $rawProject)
    {
        parent::__construct($rawProject);
    }

    public function getTransferData($ids)
    {
        $results = $ids ? $this->whereIn('id', $ids) : $this->model;
        return $results->select(
            'id', 'url', 'name', 'project_code', 'start_date_invest', 'close_date',
            'operator', 'author', 'highlights', 'description', 'transfer_description', 'results'
        )->get();
    }
}