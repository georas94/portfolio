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
    description: 'Add a short description for your command',
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

        $jsonPath = 'public_aos/json/appels_offres_extraits.json';
        if (!file_exists($jsonPath)) {
            $io->error("Fichier '$jsonPath' non trouvé.");
            return Command::FAILURE;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        if (!is_array($data)) {
            $io->error("Impossible de lire le contenu de '$jsonPath'. Format JSON invalide.");
            return Command::FAILURE;
        }

        $indexed = 0;

        foreach ($data as $doc) {
            if (!isset($doc['hash_id'])) {
                $io->warning("Document ignoré : pas de hash_id.");
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
                $io->warning("Erreur indexation : " . $e->getMessage());
            }
        }

        $io->success("$indexed appels d'offres indexés dans Elasticsearch.");
        return Command::SUCCESS;
    }
}
