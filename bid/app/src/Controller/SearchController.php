<?php

namespace App\Controller;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Exception;
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

            if (empty($query)) {
                return new JsonResponse(['error' => 'Le paramètre "q" est requis'], 400);
            }

            $searchParams = [
                'index' => 'articles', // Utilise l'index 'articles'
                'body'  => [
                    'size'    => 20,
                    '_source' => true, // On ne récupère pas tout le document source
                    'query'   => [
                        'multi_match' => [
                            'query'     => $query,
                            'fields'    => [
                                'decree_title^3', // Le titre du décret est plus important
                                'chapter_title^2', // Le titre du chapitre
                                'section_title^2', // Le titre de la section
                                'article_text', // Le texte de l'article
                            ],
                            'operator'  => 'and',
                            'fuzziness' => 'AUTO',
                        ],
                    ],
                    'highlight' => [
                        'pre_tags'  => ['<mark>'],
                        'post_tags' => ['</mark>'],
                        'fields'    => [
                            'article_text' => [ // Corrige le nom du champ ici
                                'type'               => 'fvh',
                                'fragment_size'      => 200,
                                'number_of_fragments'=> 3,
                            ],
                        ],
                    ],
                    'sort' => [
                        [
                            'decree_id' => [ // Utilise le keyword pour l'ordre
                                'order'  => 'desc',
                            ],
                        ],
                    ],
                ],
            ];

            // Filtre sur 'reference' si nécessaire
            if (!empty($reference)) {
                $searchParams['body']['query'] = [
                    'bool' => [
                        'must'   => $searchParams['body']['query'],
                        'filter' => [
                            ['term' => ['decree_id' => $reference]],
                        ],
                    ],
                ];
            }

            $response = $this->elasticClient->search($searchParams);
            $results  = [];

            foreach ($response['hits']['hits'] as $hit) {
                $article = $hit['_source'];
                $highlights = $hit['highlight']['article_text'] ?? [];

                // On récupère les autres informations à partir des champs plats
                $decreeId    = $article['decree_id'] ?? null;
                $decreeTitle = $article['decree_title'] ?? null;
                $chapterTitle = $article['chapter_title'] ?? null;
                $sectionTitle = $article['section_title'] ?? null;
                $articleNumber = $article['article_number'] ?? null;
                $articlePage = $article['article_page'] ?? null;

                $results[] = [
                    'decree_id'     => $decreeId,
                    'decree_title'  => $decreeTitle,
                    'chapter_title' => $chapterTitle,
                    'section_title' => $sectionTitle,
                    'article_number'=> $articleNumber,
                    'article_page'  => $articlePage,
                    'highlight'     => $highlights,
                    'excerpt'       => implode('…', $highlights),
                ];
            }

            return new JsonResponse([
                'results' => $results,
                'total_hits' => $response['hits']['total']['value'] ?? 0,
            ]);

        } catch (Throwable $e) {
            dd($e);
            // Gérer l'exception proprement
        }
    }

    /**
     * @throws Exception
     */
    #[Route('/api/references', name: 'app_api_references', methods: ['GET'])]
    public function apiReferences(): JsonResponse
    {
        try {
            $response = $this->elasticClient->search([
                'index' => 'articles', // Index des articles
                'body'  => [
                    'size' => 0, // Pas besoin de récupérer les hits, seulement les agrégations
                    'aggs' => [
                        'decree_ids' => [
                            'terms' => [
                                'field' => 'decree_id', // Utilise 'decrees.id.keyword' pour éviter l'analyse du champ
                                'size'  => 100, // Limite à 100 références (ajuste si nécessaire)
                                'order' => ['_key' => 'desc'], // Trie par ID décroissant
                            ],
                        ],
                    ],
                ],
            ]);

            $buckets = $response['aggregations']['decree_ids']['buckets'] ?? [];
            $references = array_column($buckets, 'key'); // On récupère les IDs des décrets

            return new JsonResponse([
                'decree_ids' => $references, // Renvoie les références
                'status'     => 'success',
            ]);

        } catch (Exception $e) {
            return new JsonResponse([
                'error'   => 'Erreur de chargement',
                'details' => $e->getMessage(),
                'status'  => 'error',
            ], 500);
        }
    }
}