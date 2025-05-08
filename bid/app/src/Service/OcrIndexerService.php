<?php

namespace App\Service;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Exception;

class OcrIndexerService
{
    private const INDEX_NAME = 'articles';
    private Client $elasticsearchClient;

    /**
     * @throws AuthenticationException
     */
    public function __construct(
    ) {
        $this->elasticsearchClient = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
//            ->setBasicAuthentication('elastic', 'votre_mot_de_passe') // Si sécurité activée
            ->build();
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    public function recreateIndex(): void
    {
        if ($this->elasticsearchClient->indices()->exists(['index' => self::INDEX_NAME])->asBool()) {
            $this->elasticsearchClient->indices()->delete(['index' => self::INDEX_NAME]);
        }
        $this->createIndex();
    }

    // Créer un index avec le mapping si nécessaire
    public function createIndex(): void
    {
        $params = [
            'index' => self::INDEX_NAME,
            'body' => [
                "settings" => [
                    "analysis" => [
                        "tokenizer" => [
                            "standard" => [
                                "type" => "standard"
                            ]
                        ],
                        "filter" => [
                            "french_stop" => [
                                "type" => "stop",
                                "stopwords" => "_french_"
                            ],
                            "french_stemmer" => [
                                "type" => "stemmer",
                                "language" => "french"
                            ]
                        ],
                        "analyzer" => [
                            "french_custom" => [
                                "type" => "custom",
                                "tokenizer" => "standard",
                                "filter" => ["lowercase", "french_stop", "french_stemmer"]
                            ]
                        ]
                    ]
                ],
                "mappings" => [
                    "properties" => [
                        "article_text" => [
                            "type" => "text",
                            "term_vector" => "with_positions_offsets",
                            "analyzer" => "french_custom"
                        ],
                        "decree_id" => ["type" => "keyword"],
                        "decree_title" => ["type" => "text"],
                        "chapter_title" => ["type" => "text"],
                        "section_title" => ["type" => "text"],
                        "article_number" => ["type" => "keyword"],
                        "article_page" => ["type" => "integer"]
                    ]
                ]
            ]
        ];

        try {
            $this->elasticsearchClient->indices()->create($params);
        } catch (Exception $e) {
            dump('createIndex()');
            dd($e);
        }
    }


//    private function getIndexMapping(): array
//    {
//        return [
//            "settings" => [
//                "analysis" => [
//                    "analyzer" => [
//                        "french_custom" => [
//                            "type" => "custom",
//                            "tokenizer" => "standard",
//                            "filter" => ["lowercase", "stop_french", "stemmer_french"]
//                        ]
//                    ],
//                    "filter" => [
//                        "stop_french" => ["type" => "stop", "stopwords" => "_french_"],
//                        "stemmer_french" => ["type" => "stemmer", "name" => "light_french"]
//                    ]
//                ]
//            ],
//            "mappings" => [
//                "dynamic" => "strict",
//                "properties" => [
//                    "reference" => ["type" => "keyword"],
//                    "year" => ["type" => "integer"],
//                    "file_name" => ["type" => "keyword"],
//                    "decrees" => [
//                        "type" => "nested",
//                        "properties" => [
//                            "id" => ["type" => "keyword"],
//                            "title" => ["type" => "text", "analyzer" => "french_custom"],
//                            "page" => ["type" => "integer"],
//
//                            // ✅ Ajout : Articles directement sous decrees
//                            "articles" => [
//                                "type" => "nested",
//                                "properties" => [
//                                    "number" => ["type" => "keyword"],
//                                    "text" => [
//                                        "type" => "text",
//                                        "analyzer" => "french_custom",
//                                        "fields" => [
//                                            "raw" => ["type" => "keyword"]  // ✅ Correct
//                                        ]
//                                    ],
//                                    "page" => ["type" => "integer"]
//                                ]
//                            ],
//
//                            // ✅ Chapitres inchangés
//                            "chapters" => [
//                                "type" => "nested",
//                                "properties" => [
//                                    "number" => ["type" => "keyword"],
//                                    "title" => ["type" => "text", "analyzer" => "french_custom"],
//                                    "page" => ["type" => "integer"],
//                                    "articles" => [
//                                        "type" => "nested",
//                                        "properties" => [
//                                            "number" => ["type" => "keyword"],
//                                            "text" => [
//                                                "type" => "text",
//                                                "analyzer" => "french_custom",
//                                                "fields" => [
//                                                    "raw" => ["type" => "keyword"]
//                                                ]
//                                            ],
//                                            "page" => ["type" => "integer"]
//                                        ]
//                                    ],
//                                    "sections" => [
//                                        "type" => "nested",
//                                        "properties" => [
//                                            "number" => ["type" => "keyword"],
//                                            "title" => ["type" => "text", "analyzer" => "french_custom"],
//                                            "page" => ["type" => "integer"],
//                                            "articles" => [
//                                                "type" => "nested",
//                                                "properties" => [
//                                                    "number" => ["type" => "keyword"],
//                                                    "text" => [
//                                                        "type" => "text",
//                                                        "analyzer" => "french_custom",
//                                                        "fields" => [
//                                                            "raw" => ["type" => "keyword"]
//                                                        ]
//                                                    ],
//                                                    "page" => ["type" => "integer"]
//                                                ]
//                                            ]
//                                        ]
//                                    ]
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//            ]
//        ];
//    }

    public function indexArticles(array $data, string $fileName, string $reference): void
    {
        $year = substr($reference, 0, 4);

        foreach ($data['decrees'] as $decree) {
            $params = [
                'index' => self::INDEX_NAME,
                'id'    => $decree['decree_id'], // Tu peux indexer avec un ID unique, par exemple
                'body'  => [
                    'reference'   => $reference,
                    'year'        => (int)$year,
                    'file_name'   => $fileName,
                    'decree_id'   => $decree['decree_id'],
                    'decree_title'=> $decree['decree_title'],
                    'chapter_title'=> $decree['chapter_title'],
                    'section_title'=> $decree['section_title'],
                    'article_number'=> $decree['article_number'],
                    'article_page' => $decree['article_page'],
                    'article_text' => $decree['article_text'], // Assure-toi que ce champ est bien du texte
                ]
            ];

            try {
                $this->elasticsearchClient->index($params);
            } catch (Exception $e) {
                dump('indexArticles()');
                dd($e);
                // Gestion des erreurs
            }
        }
    }
}