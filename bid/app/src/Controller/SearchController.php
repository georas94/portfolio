<?php

namespace App\Controller;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Throwable;

#[IsGranted('ROLE_USER')]
class SearchController extends AbstractController
{
    private Client $elasticClient;

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        // Configuration unique d'Elasticsearch
        $this->elasticClient = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
//            ->setBasicAuthentication('elastic', 'votre_mot_de_passe') // Si sécurité activée
            ->build();
    }

    #[Route('/search', name: 'app_search_live', methods: ['GET'])]
    public function live(): Response
    {
        return $this->render('search/live.html.twig');
    }

    #[Route('/api/search', name: 'app_api_search', methods: ['GET'])]
    public function apiSearch(Request $request): JsonResponse
    {
        try {
            $query = trim($request->query->get('q', ''));
            $reference = trim($request->query->get('reference', ''));
            $results = [];

            if (empty($query)) {
                return new JsonResponse(['error' => 'Le paramètre "q" est requis'], 400);
            }

            $searchParams = [
                'index' => 'articles',
                'body' => [
                    'size' => 20,
                    '_source' => ['article', 'content', 'structure', 'metadata'], // Optimisation du retour
                    'query' => [
                        'bool' => [
                            'must' => [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => ['content^3', 'metadata.source.filename'],
                                    'operator' => 'and',
                                    'fuzziness' => 'AUTO',
                                ]
                            ],
                            'filter' => []
                        ]
                    ],
                    'highlight' => [
                        'pre_tags' => ['<mark>'],
                        'post_tags' => ['</mark>'],
                        'fields' => [
                            'content' => [
                                'type' => 'fvh',
                                'fragment_size' => 200,
                                'number_of_fragments' => 3
                            ]
                        ]
                    ]
                ]
            ];

            // Ajout du filtre référence si spécifié
            if (!empty($reference)) {
                $searchParams['body']['query']['bool']['filter'][] = [
                    'term' => ['metadata.reference' => $reference]
                ];
            }

            $response = $this->elasticClient->search($searchParams);

            foreach ($response['hits']['hits'] as $hit) {
                $source = $hit['_source'];
                $metadata = $source['metadata'] ?? [];
                $structure = $source['structure'] ?? [];

                $results[] = [
                    'id' => $hit['_id'],
                    'score' => $hit['_score'],
                    'source' => $metadata['source']['filename'] ?? null,
                    'reference' => $metadata['reference'] ?? null,
                    'article' => $source['article'] ?? null, // Champ racine pas metadata
                    'pages' => [
                        'start' => $structure['pages']['start'] ?? null,
                        'end' => $structure['pages']['end'] ?? null
                    ],
                    'highlight' => $hit['highlight']['content'] ?? [],
                    'excerpt' => implode('... ', $hit['highlight']['content'] ?? [])
                ];
            }

            return new JsonResponse($results);

        } catch (Throwable $e) {
            // Loguer l'erreur
            return new JsonResponse(
                ['error' => 'Erreur de recherche', 'details' => $e->getMessage()],
                500
            );
        }
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    #[Route('/api/references', name: 'app_api_references', methods: ['GET'])]
    public function apiReferences(): JsonResponse
    {
        $response = $this->elasticClient->search([
            'index' => 'articles',
            'body' => [
                'size' => 0,
                'aggs' => [
                    'references' => [
                        'terms' => [
                            'field' => 'metadata.reference',
                            'size' => 100,
                            'order' => ['_key' => 'desc'] // ordre décroissant des années
                        ]
                    ]
                ]
            ]
        ]);

        $references = [];
        foreach ($response['aggregations']['references']['buckets'] as $bucket) {
            $references[] = $bucket['key'];
        }

        return new JsonResponse($references);
    }
}