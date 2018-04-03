<?php

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Migrations\Migration;

class CreateEsProfilesIndex extends Migration
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
                            'name' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'province_id' => ['type' => 'integer'],
                            'academic_title_id' => ['type' => 'integer'],
                            'specialization' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'agency' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'research_for' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'research_joined' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
                            'research_results' => ['type' => 'text', 'analyzer' => 'name_analyzer'],
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
            'index' => 'profiles',
            'client' => ['ignore' => [400, 404]]
        ]);
    }
}
