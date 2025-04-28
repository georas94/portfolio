<?php

namespace App\Command;

use App\Service\OcrIndexerService;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'app:index-documents',
    description: 'Add a short description for your command',
)]
class IndexDocumentsCommand extends Command
{
    private OcrIndexerService $indexer;

    public function __construct(OcrIndexerService $indexer)
    {
        parent::__construct();
        $this->indexer = $indexer;
    }

    protected function configure(): void
    {
        $this
            ->setDescription("Crée l'index Elasticsearch et ingère tous les textes officiels (PDF puis TXT) page par page");
    }

    /**
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('POC Indexation textes officiels');

        // 1) Supprimer et recréer l'index
        try {
            $io->section('1) Création de l\'index Elasticsearch "articles"');
            $this->indexer->recreateIndex();
            $io->success('Index articles créé avec succès.');
        } catch (Throwable $e) {
            $io->error('Erreur création index : ' . $e->getMessage());
            return Command::FAILURE;
        }

        // 2) OCR et indexation des PDFs page par page
        $io->section('2) Indexation des JSONs fichier par fichier');

        $jsonFiles = glob('/app/textes_officiels/json/*.json');
        foreach ($jsonFiles as $jsonFile) {
            $data = json_decode(file_get_contents($jsonFile), true);
            list($beforeDash, $afterDash) = explode('-', basename($jsonFile));
            $year = substr($beforeDash, 0, 4);
            $numberPart = pathinfo($afterDash, PATHINFO_FILENAME);
            $reference = $year . '-' . $numberPart;
            $this->indexer->indexArticles($data, basename($jsonFile), $reference);
            $io->text("Fichier " . basename($jsonFile) . " indexé");
        }

        $io->success("Indexation terminée pour les JSON.");
        $io->success('POC complété.');
        return Command::SUCCESS;
    }
}