<?php

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Migrations\Migration;

class CreateEsCompaniesIndex extends Migration
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
            'index' => 'companies',
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
                    'companies' => [
                        '_source' => ['enabled' => true],
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => $fieldText,
                            'base_technology_category_id' => ['type' => 'integer'],
                            'province_id' => ['type' => 'integer'],
                            'headquarters' => $fieldText,
                            'founder' => $fieldText,
                            'industry' => $fieldText,
                            'research_for' => $fieldText,
                            'technology_highlight' => $fieldText,
                            'technology_using' => $fieldText,
                            'products' => $fieldText,
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
            'index' => 'companies',
            'client' => ['ignore' => [400, 404]]
        ]);
    }
}
