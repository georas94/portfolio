<?php

namespace App\Service;


use DateTime;
use DateTimeInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Exception;
use Throwable;

class OcrIndexerService
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

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     * @throws Exception
     */
    public function processAndIndexPdf(string $pdfPath): void
    {
        $pdfHash  = md5_file($pdfPath);
        $outputDir = "/app/storage/ocr/$pdfHash";
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Nombre de pages
        $pageCount = (int) shell_exec("pdfinfo $pdfPath | grep Pages | awk '{print $2}'");

        // Génération des .png
        shell_exec("pdftoppm -png -r 300 $pdfPath $outputDir/page");

        $fullText = '';

        for ($i = 1; $i <= $pageCount; $i++) {
            // correspond maintenant à page-1.png, page-2.png, etc.
            $pageImage     = "$outputDir/page-$i.png";
            // on donne à tesseract le préfixe SANS extension : il créera page-X.txt
            $pageTextBase  = "$outputDir/page-$i";

            // Lancement de l'OCR
            exec("tesseract $pageImage $pageTextBase -l fra+eng", $output, $returnCode);

            $txtFile = $pageTextBase . '.txt';
            if ($returnCode === 0 && file_exists($txtFile)) {
                $fullText .= "\n\nPAGE $i:\n" . file_get_contents($txtFile);
            }
        }

        // Enfin, si on a bien récupéré du texte, on indexe
        if (!empty($fullText)) {
            $this->indexContent($pdfHash, [
                'content'  => $fullText,
                'metadata' => [
                    'source'    => basename($pdfPath),
                    'pages'     => $pageCount,
                    'timestamp' => time(),
                    'hash'      => $pdfHash,
                ]
            ]);
        }
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     * @throws Exception
     */
    public function processAndIndexFromTxt(string $txtPath): void
    {
        // Vérifier que le fichier .txt existe
        if (!file_exists($txtPath)) {
            throw new Exception("Fichier TXT introuvable : $txtPath");
        }

        // Générer un hash unique basé sur le contenu
        $fileHash = md5_file($txtPath);

        // Vérifier si le document existe déjà
        $exists = $this->elasticClient->exists([
            'index' => 'documents',
            'id' => $fileHash
        ]);

        if (!$exists) {
            // Lire directement le contenu du fichier .txt
            $content = file_get_contents($txtPath);

            // Nettoyer le contenu si nécessaire
            $content = $this->cleanTextContent($content);

            if (!empty($content)) {
                $this->indexContent($fileHash, [
                    'content' => $content,
                    'metadata' => [
                        'source' => basename($txtPath),
                        'timestamp' => time(),
                        'hash' => $fileHash,
                        'pages' => $this->countPagesInTxt($content) // Fonction optionnelle
                    ]
                ]);
            }
        }
    }

    private function cleanTextContent(string $content): string
    {
        // Nettoyage basique
        return preg_replace('/\s+/', ' ', trim($content));
    }

    private function countPagesInTxt(string $content): int
    {
        // Compter le nombre de "PAGE X:" dans le contenu
        preg_match_all('/\nPAGE \d+:\n/', $content, $matches);
        return count($matches[0]);
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    private function indexContent(string $docId, array $data): void
    {
        $params = [
            'index' => 'documents',
            'id' => $docId,
            'body' => [
                'content' => $data['content'],
                'metadata' => [ // Doit correspondre au mapping
                    'source' => $data['metadata']['source'],
                    'timestamp' => $data['metadata']['timestamp'],
                    'pages' => $data['metadata']['pages'] ?? 1
                ]
            ]
        ];

        $this->elasticClient->index($params);
    }

    /**
     * Supprime et recrée l'index avec mapping POC
     */
    public function recreateIndex(): void
    {
        try {
//            if ($this->elasticClient->indices()->exists(['index' => 'articles'])) {
//                $this->elasticClient->indices()->delete(['index' => 'articles']);
//            }
            $this->elasticClient->indices()->create([
                'index' => 'articles',
                'body'  => [
                    'settings' => [
                        'analysis' => [
                            'analyzer' => [
                                'french' => [
                                    'type' => 'french',
                                    'stopwords' => '_french_'
                                ]
                            ]
                        ]
                    ],
                    'mappings' => [
                        'properties' => [
                            'article' => ['type' => 'keyword'],
                            'content' => [
                                'type' => 'text',
                                'analyzer' => 'french',
                                'fields' => [ // Ajout recommandé
                                    'keyword' => ['type' => 'keyword']
                                ],
                                'term_vector' => 'with_positions_offsets'
                            ],
                            'structure' => [
                                'properties' => [
                                    'titre' => ['type' => 'keyword'],
                                    'chapitre' => ['type' => 'keyword'],
                                    'section' => ['type' => 'keyword'],
                                    'pages' => [ // Modification clé pour la pagination
                                        'properties' => [
                                            'start' => ['type' => 'integer'],
                                            'end' => ['type' => 'integer']
                                        ]
                                    ]
                                ]
                            ],
                            'metadata' => [
                                'properties' => [
                                    'source' => [ // Doit être un objet
                                        'properties' => [
                                            'filename' => ['type' => 'keyword'],
                                            'full_path' => ['type' => 'keyword']
                                        ]
                                    ],
                                    'reference' => ['type' => 'keyword'], // Nom corrigé (pas reference_number)
                                    'timestamp' => ['type' => 'date'],
                                    // Supprimer 'page' et 'article' qui sont déjà ailleurs
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        } catch (Throwable $e) {
            dump('erreur recreateIndex()');
            dd($e);
        }
    }

    /**
     */
    public function indexArticles(array $jsonData, string $sourceDocument): void
    {
        foreach ($jsonData as $article) {
            // 1. Génération de l'ID unique
            $reference = preg_replace('/[^0-9-]/', '', pathinfo($sourceDocument, PATHINFO_FILENAME));
            $docId = $reference . '-' . $article['article'];

            // 2. Structure propre avec nesting logique
            $body = [
                'article' => $article['article'],
                'content' => $article['content'],
                'structure' => [
                    'titre' => $article['titre_reference'],
                    'chapitre' => $article['chapitre_reference'],
                    'section' => $article['section_reference'],
                    'pages' => [
                        'start' => $article['start_page'],
                        'end' => $article['end_page']
                    ]
                ],
                'metadata' => [
                    'source' => [
                        'filename' => pathinfo($sourceDocument, PATHINFO_FILENAME), // Sans extension
                        'full_path' => $sourceDocument // Optionnel pour debug
                    ],
                    'reference' => $reference, // Utilisation de la référence générée
                    'timestamp' => (new DateTime())->format(DateTimeInterface::ATOM)
                ]
            ];

            // 3. Indexation avec vérification d'erreurs
            try {
                $this->elasticClient->index([
                    'index' => 'articles',
                    'id' => $docId,
                    'body' => $body
                ]);
            } catch (Throwable $e) {
                dump("Erreur d'indexation pour $docId : " . $e->getMessage());
                dd($e);
            }
        }
    }

    /**
     * OCR et indexation page par page de tous les PDFs
     * Retourne le nombre total de pages indexées
     */
//    public function indexAllPdfsPerPage(callable $progressCallback = null): int
//    {
//        $pdfFiles = glob('/app/textes_officiels/decrets/*.pdf');
//        $totalPages = 0;
//
//        foreach ($pdfFiles as $pdfPath) {
//            // Extraction du nombre de pages
//            $raw = shell_exec("pdfinfo " . escapeshellarg($pdfPath) . " | grep '^Pages:' | awk '{print $2}'");
//            $pageCount = (int) trim($raw);
//
//            for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
//                $txt = shell_exec(
//                    "pdftoppm -f $pageNumber -singlefile -r 300 -png "
//                    . escapeshellarg($pdfPath) . " /tmp/page"
//                    . " && tesseract /tmp/page.png stdout -l fra+eng"
//                );
//                $docId = md5_file($pdfPath) . '-' . $pageNumber;
//
//                list($beforeDash, $afterDash) = explode('-', basename($pdfPath));
//                $year = substr($beforeDash, 0, 4);
//                $numberPart = pathinfo($afterDash, PATHINFO_FILENAME);
//
//                $articlesNumbers = [];
//                if (preg_match_all('/^\s*(Article)\s+(\d+)\s*:\s*(.+)$/mu', $txt, $matches)) {
//                    foreach ($matches[1] as $i => $type) {
//                        $numero = $matches[2][$i];
//                        if (strtolower($type) === 'article') {
//                            $articlesNumbers[] = $numero;
//                        }
//                    }
//                }
//
//                $reference = $year . '-' . $numberPart;
//                try {
//                    $this->elasticClient->index([
//                        'index' => 'documents',
//                        'id' => $docId,
//                        'body' => [
//                            'content' => $txt,
//                            'metadata' => [
//                                'source' => basename($pdfPath),
//                                'page' => $pageNumber,
//                                'timestamp' => time(),
//                                'reference_number' => $reference,
//                                'articles' => $articlesNumbers
//                            ]
//                        ]
//                    ]);
//                } catch (Throwable $e) {
//                    dump('erreur indexAllPdfsPerPage()');
//                    dd($e);
//                }
//                $totalPages++;
//                if ($progressCallback) {
//                    $progressCallback($totalPages, $pageCount, $articlesNumbers);
//                }
//            }
//        }
//
//        return $totalPages;
//    }
//
//    /**
//     * Indexation de tous les fichiers TXT OCR existants
//     */
//    public function indexAllTxtFiles(callable $progressCallback = null): int
//    {
//        $txtFiles = glob('/app/storage/ocr/*/*.txt');
//        $count = 0;
//        $total = count($txtFiles);
//
//        foreach ($txtFiles as $index => $txtPath) {
//            $text = file_get_contents($txtPath);
//            if (trim($text) !== '') {
//                $id = pathinfo($txtPath, PATHINFO_FILENAME);
//                try {
//                    $this->elasticClient->index([
//                        'index' => 'documents',
//                        'id' => $id,
//                        'body' => [
//                            'content' => $text,
//                            'metadata' => [
//                                'source' => basename($txtPath),
//                                'page' => null,
//                                'timestamp' => time()
//                            ]
//                        ]
//                    ]);
//                } catch (Throwable $e) {
//                    dump('erreur indexAllTxtFiles()');
//                    dd($e);
//                }
//                $count++;
//            }
//            if ($progressCallback) {
//                $progressCallback($index + 1, $total);
//            }
//        }
//
//        return $count;
//    }
}