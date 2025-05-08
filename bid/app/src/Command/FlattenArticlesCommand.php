<?php

namespace App\Command;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'app:index-articles',
    description: 'index articles',
)]
class FlattenArticlesCommand extends Command
{
    private const INDEX_NAME = 'articles';
    private Client $es;

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        parent::__construct();

        // Configure Elasticsearch
        $this->es = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200']) // adapte si nécessaire
            ->build();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Indexe les articles d’un JSON structuré dans Elasticsearch.')
            ->addArgument('jsonPath', InputArgument::REQUIRED, 'Chemin vers le fichier JSON');
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('POC Indexation textes officiels');

        $jsonPath = $input->getArgument('jsonPath');

        if (!file_exists($jsonPath)) {
            $output->writeln("<error>Fichier non trouvé: $jsonPath</error>");
            return Command::FAILURE;
        }
//        // 1) Supprimer et recréer l'index
        try {
            $io->section('1) Création de l\'index Elasticsearch "articles"');
            $this->recreateIndex();
            $io->success('Index articles créé avec succès.');
        } catch (Throwable $e) {
            $io->error('Erreur création index : ' . $e->getMessage());
            return Command::FAILURE;
        }

        // 2) Indexation des JSON page par page
        $io->section('2) Indexation des JSONs fichier par fichier');

        $articles = $this->flattenArticlesFromJson($jsonPath);
        $count = 0;

        foreach ($articles as $article) {
            $response = $this->es->index([
                'index' => 'articles',
                'id' => $article['decree_id'] . '-' . $article['article_number'],
                'body' => $article,
            ]);

            if ($response['result'] === 'created' || $response['result'] === 'updated') {
                $count++;
            }
        }
        $io->success("<info>Indexation terminée dans Elasticsearch pour $count articles.</info>");
        $io->success('<info>POC complété.</info>');
        return Command::SUCCESS;
    }

    private function flattenArticlesFromJson(string $jsonPath): array
    {
        $content = file_get_contents($jsonPath);
        $data = json_decode($content, true);
        $flattened = [];

        foreach ($data['decrees'] as $decree) {
            $decreeId = $decree['id'];
            $decreeTitle = $decree['title'];

            // Articles au niveau décret
            foreach ($decree['articles'] ?? [] as $article) {
                $flattened[] = $this->buildArticle($decreeId, $decreeTitle, null, null, null, null, $article);
            }

            foreach ($decree['chapters'] ?? [] as $chapter) {
                $chapterNumber = $chapter['number'];
                $chapterTitle = $chapter['title'];

                // Articles au niveau chapitre
                foreach ($chapter['articles'] ?? [] as $article) {
                    $flattened[] = $this->buildArticle($decreeId, $decreeTitle, $chapterNumber, $chapterTitle, null, null, $article);
                }

                // Articles au niveau section
                foreach ($chapter['sections'] ?? [] as $section) {
                    $sectionNumber = $section['number'];
                    $sectionTitle = $section['title'];

                    foreach ($section['articles'] ?? [] as $article) {
                        $flattened[] = $this->buildArticle($decreeId, $decreeTitle, $chapterNumber, $chapterTitle, $sectionNumber, $sectionTitle, $article);
                    }
                }
            }
        }

        return $flattened;
    }

    private function buildArticle(
        string $decreeId,
        string $decreeTitle,
        ?string $chapterNumber,
        ?string $chapterTitle,
        ?string $sectionNumber,
        ?string $sectionTitle,
        array $article
    ): array {
        return [
            'decree_id' => $decreeId,
            'decree_title' => $decreeTitle,
            'chapter_number' => $chapterNumber,
            'chapter_title' => $chapterTitle,
            'section_number' => $sectionNumber,
            'section_title' => $sectionTitle,
            'article_number' => $article['number'],
            'article_text' => $article['text'],
            'article_page' => $article['page'] ?? null,
        ];
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
            $this->es->indices()->create($params);
        } catch (Throwable $e) {
            dump('createIndex()');
            dd($e);
        }
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    public function recreateIndex(): void
    {
//        if ($this->es->indices()->exists(['index' => self::INDEX_NAME])->asBool()) {
//            $this->es->indices()->delete(['index' => self::INDEX_NAME]);
//        }
        $this->createIndex();
    }
}
