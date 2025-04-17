<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416215344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ao (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(50) NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_limite DATETIME NOT NULL, budget DOUBLE PRECISION NOT NULL, statut VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE soumission (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, ao_id INT DEFAULT NULL, date_soumission DATETIME NOT NULL, statut VARCHAR(20) NOT NULL, INDEX IDX_9495AA2EA4AEAFEA (entreprise_id), INDEX IDX_9495AA2E98355297 (ao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE soumission ADD CONSTRAINT FK_9495AA2EA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE soumission ADD CONSTRAINT FK_9495AA2E98355297 FOREIGN KEY (ao_id) REFERENCES ao (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE soumission DROP FOREIGN KEY FK_9495AA2EA4AEAFEA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE soumission DROP FOREIGN KEY FK_9495AA2E98355297
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ao
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE soumission
        SQL);
    }
}
