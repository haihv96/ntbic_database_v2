<?php

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Migrations\Migration;

class CreateEsPatentsIndex extends Migration
{
    protected $esClient;

    public function __construct()
    {
        $this->esClient = ClientBuilder::create()->build();
    }

    public function up()
    {
        $this->esClient->indices()->create([
            'index' => 'profiles',
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
                    'profiles' => [
                        '_source' => ['enabled' => true],
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => ['type' => 'text', 'analyzer' => 'text_analyzer'],
                            'patent_code' => ['type' => 'text'],
                            'base_technology_category_id' => ['type' => 'integer'],
                            'patent_type_id' => ['type' => 'integer'],
                            'owner' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'author' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'highlights' => ['type' => 'text', 'analyzer' => 'text_analyzer'],
                            'description' => ['type' => 'text', 'analyzer' => 'text_analyzer'],
                            'market_application' => ['type' => 'text', 'analyzer' => 'text_analyzer'],
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
            'index' => 'patents',
            'client' => ['ignore' => [400, 404]]
        ]);
    }
}
