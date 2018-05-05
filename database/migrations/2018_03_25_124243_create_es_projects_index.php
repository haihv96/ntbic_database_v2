<?php

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Migrations\Migration;

class CreateEsProjectsIndex extends Migration
{
    protected $esClient;

    public function __construct()
    {
        $this->esClient = ClientBuilder::create()->build();
    }

    public function up()
    {
        $this->esClient->indices()->create([
            'index' => 'projects',
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
                    'projects' => [
                        '_source' => ['enabled' => true],
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => [
                                'type' => 'text',
                                'fields' => [
                                    'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                                    'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
                                ]
                            ],
                            'project_code' => ['type' => 'text'],
                            'specialization_id' => ['type' => 'integer'],
                            'operator' => [
                                'type' => 'text',
                                'fields' => [
                                    'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                                    'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
                                ]
                            ],
                            'author' => [
                                'type' => 'text',
                                'fields' => [
                                    'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                                    'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
                                ]
                            ],
                            'highlights' => [
                                'type' => 'text',
                                'fields' => [
                                    'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                                    'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
                                ]
                            ],
                            'description' => [
                                'type' => 'text',
                                'fields' => [
                                    'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                                    'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
                                ]
                            ],
                            'results' => [
                                'type' => 'text',
                                'fields' => [
                                    'vi' => ['type' => 'text', 'analyzer' => 'vn_analyzer', 'search_analyzer' => 'vn_analyzer'],
                                    'en' => ['type' => 'text', 'analyzer' => 'standard_analyzer', 'search_analyzer' => 'standard_analyzer']
                                ]
                            ],
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
            'index' => 'projects',
            'client' => ['ignore' => [400, 404]]
        ]);
    }
}
