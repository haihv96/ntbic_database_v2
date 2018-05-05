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
                                'fields' => $fields['en'],
                                'operator' => 'and',
                                'boost' => 100,
                            ]
                        ],
                        'should' => [
                            'bool' => [
                                'must' => [
                                    'multi_match' => [
                                        'query' => $query,
                                        'fields' => $fields['vi'],
                                        'operator' => 'or',
                                        'boost' => 200,
                                    ]
                                ],
                                'should' => [
                                    'multi_match' => [
                                        'query' => $query,
                                        'fields' => $fields['vi'],
                                        'operator' => 'and',
                                        'boost' => 300
                                    ],
                                ],
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
