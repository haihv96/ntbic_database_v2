<?php

namespace App\Services\ElasticSearch;

interface ElasticSearchServiceInterface
{
    public function search($index, $type, $query, $fields, $filters = [], $esPaginate);
}
