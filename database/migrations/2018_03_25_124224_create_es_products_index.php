<?php

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Migrations\Migration;

class CreateEsProductsIndex extends Migration
{
    protected $esClient;

    public function __construct()
    {
        $this->esClient = ClientBuilder::create()->build();
    }

    public function up()
    {
        $fieldText = [
            'type' => 'text',
            'fields' => [
                'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                'vi_standard' => ['type' => 'text', 'analyzer' => 'vn_standard_analyzer', 'search_analyzer' => 'vn_standard_analyzer'],
                'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
            ]
        ];
        $this->esClient->indices()->create([
            'index' => 'products',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 1,
                    'index' => [
                        'analysis' => [
                            'analyzer' => [
                                'vn_analyzer' => [
                                    'tokenizer' => 'vi_tokenizer',
                                    'char_filter' => ['html_strip'],
                                    'filter' => ['lowercase'],
                                ],
                                'vn_standard_analyzer' => [
                                    'tokenizer' => 'standard',
                                    'char_filter' => ['html_strip'],
                                    'filter' => ['lowercase'],
                                ],
                                'standard_analyzer' => [
                                    'tokenizer' => 'standard',
                                    'char_filter' => ['html_strip'],
                                    'filter' => ['icu_folding', 'lowercase'],
                                ],
                            ],
                        ],
                    ],

                ],
                'mappings' => [
                    'products' => [
                        '_source' => ['enabled' => true],
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => $fieldText,
                            'base_technology_category_id' => ['type' => 'integer'],
                            'highlights' => $fieldText,
                            'description' => $fieldText,
                            'results' => $fieldText,
                        ]
                    ]
                ]
            ],
            'client' => ['ignore' => [400, 404]]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->esClient->indices()->delete([
            'index' => 'products',
            'client' => ['ignore' => [400, 404]]
        ]);
    }
}
