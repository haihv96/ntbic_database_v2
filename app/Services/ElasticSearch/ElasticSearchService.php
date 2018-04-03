<?php

namespace App\Services\ElasticSearch;

use Elasticsearch\ClientBuilder;

class ElasticSearchService implements ElasticSearchServiceInterface
{
    public function search($index, $type, $query, $fields, $filters = [])
    {
        $filterParams = [];
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $filterParams[] = [
                    'term' => [
                        $key => $value,
                    ]
                ];
            }
        }

        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                                'query' => $query,
                                'fields' => $fields,
                                'operator' => 'and'
                            ]
                        ],
                    ],
                ],
            ]
        ];
        empty($filterParams) || $params['body']['query']['bool']['filter'] = $filterParams;
        $results = ClientBuilder::create()->build()->search($params);
        return collect($results['hits']['hits'])->map(function ($value) {
            return $value['_id'];
        })->all();
    }
}
