<?php

namespace App\Services\ElasticSearch;

use Elasticsearch\ClientBuilder;

class ElasticSearchService implements ElasticSearchServiceInterface
{
    public function search($index, $type, $query, $fields, $filters = [], $esPaginate)
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
                'from' => $esPaginate['from'],
                'size' => $esPaginate['size'],
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => $this->getSubField($fields, 'en'),
                                    'operator' => 'and',
                                    'boost' => 1,
                                ]
                            ],
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => $this->getSubField($fields, 'vi_standard'),
                                    'operator' => 'or',
                                    'boost' => 10,
                                ],
                            ],
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => $this->getSubField($fields, 'vi'),
                                    'operator' => 'or',
                                    'boost' => 100,
                                ],
                            ],
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => $this->getSubField($fields, 'vi_standard'),
                                    'operator' => 'and',
                                    'boost' => 1000,
                                ],
                            ],
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => $this->getSubField($fields, 'vi'),
                                    'operator' => 'and',
                                    'boost' => 10000
                                ],
                            ],
                        ],
                    ]
                ],
                'highlight' => [
                    'fields' => $this->getHighlightFields($fields),
                    'require_field_match' => false,
                    'fragment_size' => 80,
                    'number_of_fragments' => 2,
                    'pre_tags' => ['<span class="es-highlight">'],
                    'post_tags' => ['</span>'],
                ],
            ],
        ];
        empty($filterParams) || $params['body']['query']['bool']['filter'] = $filterParams;
        $results = ClientBuilder::create()->build()->search($params);
        return $this->getIdAndHighlight($results);
    }

    private function getSubField($fields, $subName)
    {
        return collect($fields)->map(function ($value) use ($subName) {
            return "$value.$subName";
        });
    }

    private function getHighlightFields($fields)
    {
        $results = [];
        foreach ($fields as $field) {
            $results[$field] = new \stdClass();
        }
        return $results;
    }

    private function getIdAndHighlight($results)
    {
        return [
            'id' => collect($results['hits']['hits'])->map(function ($value) {
                return $value['_id'];
            })->all(),
            'highlight' => collect($results['hits']['hits'])->map(function ($value) {
                return array_key_exists('highlight', $value) ? $value['highlight'] : null;
            })->all(),
            'total' => $results['hits']['total']
        ];
    }
}
