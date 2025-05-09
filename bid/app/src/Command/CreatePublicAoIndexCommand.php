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
    name: 'app:create-public-ao-index',
    description: 'Add a short description for your command',
)]
class CreatePublicAoIndexCommand extends Command
{
    private Client $client;
    private const INDEX = 'ao';

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


        try {
            if ($this->client->indices()->exists(['index' => self::INDEX])->asBool()) {
                $io->warning("L'index ". self::INDEX . " existe déjà. Suppression...");
                $this->client->indices()->delete(['index' => self::INDEX]);
            }

            $this->client->indices()->create([
                'index' => self::INDEX,
                'body' => [
                    'settings' => [
                        'analysis' => [
                            'analyzer' => [
                                'french_custom' => [
                                    'type' => 'custom',
                                    'tokenizer' => 'standard',
                                    'filter' => ['lowercase', 'french_stop', 'french_stemmer'],
                                ]
                            ],
                            'filter' => [
                                'french_stop' => [
                                    'type' => 'stop',
                                    'stopwords' => '_french_',
                                ],
                                'french_stemmer' => [
                                    'type' => 'stemmer',
                                    'language' => 'light_french',
                                ]
                            ]
                        ]
                    ],
                    'mappings' => [
                        'properties' => [
                            'reference' => ['type' => 'keyword'],
                            'reference_number' => ['type' => 'keyword'],
                            'hash_id' => ['type' => 'keyword'],
                            'entity' => ['type' => 'text', 'analyzer' => 'french_custom'],
                            'type' => ['type' => 'text', 'analyzer' => 'french_custom'],
                            'objet' => ['type' => 'text', 'analyzer' => 'french_custom'],
                            'financement' => ['type' => 'text', 'analyzer' => 'french_custom'],
                            'lots' => ['type' => 'text', 'analyzer' => 'french_custom'],
                            'delaiExecution' => ['type' => 'text', 'analyzer' => 'french_custom'],
                            'full_text' => [
                                'type' => 'text',
                                'analyzer' => 'french_custom',
                                'term_vector' => 'with_positions_offsets',
                            ],
                            'source_page' => ['type' => 'integer'],
                            'source_position' => [
                                'properties' => [
                                    'top' => ['type' => 'float'],
                                    'bottom' => ['type' => 'float'],
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            $io->success("Index 'self::INDEX' créé avec succès.");
            return Command::SUCCESS;

        } catch (Throwable $e) {
            $io->error("Erreur Elasticsearch : " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
