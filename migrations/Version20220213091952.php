<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213091952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamer ADD idreponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamer ADD CONSTRAINT FK_E56F8A992B1A6B8 FOREIGN KEY (idreponse_id) REFERENCES reclamer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E56F8A992B1A6B8 ON reclamer (idreponse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamer DROP FOREIGN KEY FK_E56F8A992B1A6B8');
        $this->addSql('DROP INDEX UNIQ_E56F8A992B1A6B8 ON reclamer');
        $this->addSql('ALTER TABLE reclamer DROP idreponse_id, CHANGE idreclamation idreclamation VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reponse CHANGE idreponse idreponse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse reponse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
