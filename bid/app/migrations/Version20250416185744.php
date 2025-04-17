<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416185744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Met à jour le champ numéro de téléphone afin de limiter sa taille';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE phone_number phone_number VARCHAR(20) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` CHANGE phone_number phone_number VARCHAR(255) NOT NULL
        SQL);
    }
}
