<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417011657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE aofile (id INT AUTO_INCREMENT NOT NULL, ao_id INT NOT NULL, filename VARCHAR(255) NOT NULL, original_filename VARCHAR(255) NOT NULL, INDEX IDX_C4D374CC98355297 (ao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ao ADD pdf_path VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ao ADD entreprise VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aofile ADD CONSTRAINT FK_C4D374CC98355297 FOREIGN KEY (ao_id) REFERENCES ao (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE aofile DROP FOREIGN KEY FK_C4D374CC98355297
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ao DROP pdf_path
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ao DROP entreprise
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE aofile
        SQL);
    }
}
