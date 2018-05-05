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
        $this->esClient->indices()->create([
            'index' => 'companies',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 1,
                    'index' => [
                        'analysis' => [
                            'analyzer' => [
                                'text_analyzer' => [
                                    'tokenizer' => 'vi_tokenizer',
                                    'char_filter' => ['html_strip'],
                                    'filter' => ['icu_folding', 'lowercase'],
                                ],
                                'name_analyzer' => [
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
                            'name' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'base_technology_category_id' => ['type' => 'integer'],
                            'province_id' => ['type' => 'integer'],
                            'headquarters' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'company_code' => ['type' => 'text'],
                            'founder' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'industry' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'research_for' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'technology_highlight' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'technology_using' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'technology_transfer' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'results' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
                            'products' => ['type' => 'text', 'analyzer' => 'text_analyzer', 'search_analyzer' => 'text_analyzer'],
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
