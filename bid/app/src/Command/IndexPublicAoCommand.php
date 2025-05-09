<?php

namespace App\Command;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'app:index-public-ao',
    description: 'Indexe tous les appels d\'offres publics depuis les JSON',
)]
class IndexPublicAoCommand extends Command
{
    private const INDEX = 'ao';
    private Client $client;

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        parent::__construct();

        $this->client = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Chemin du projet
        $projectDir = $this->getApplication()?->getKernel()?->getProjectDir();

        // 1) on récupère tous les JSON du dossier
        $jsonFiles = glob($projectDir . '/public_aos/json/*.json');

        if (empty($jsonFiles)) {
            $io->error("Aucun fichier JSON trouvé dans public_aos/json/");
            return Command::FAILURE;
        }

        $indexed = 0;

        foreach ($jsonFiles as $jsonPath) {
            $io->text("Lecture de $jsonPath …");

            $content = @file_get_contents($jsonPath);
            if (false === $content) {
                $io->warning("Impossible de lire $jsonPath, fichier ignoré.");
                continue;
            }

            $data = json_decode($content, true);
            if (!is_array($data)) {
                $io->warning("JSON invalide dans $jsonPath, document ignoré.");
                continue;
            }

            foreach ($data as $doc) {
                if (empty($doc['hash_id'])) {
                    $io->warning("Document ignoré dans $jsonPath : pas de hash_id.");
                    continue;
                }

                try {
                    $this->client->index([
                        'index' => self::INDEX,
                        'id'    => $doc['hash_id'],
                        'body'  => $doc,
                    ]);
                    $indexed++;
                } catch (Throwable $e) {
                    $io->warning("Erreur indexation de {$doc['hash_id']}: " . $e->getMessage());
                }
            }
        }

        $io->success("$indexed appels d'offres indexés dans Elasticsearch.");
        return Command::SUCCESS;
    }
}