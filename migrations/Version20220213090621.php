<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213090621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamer ADD reponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamer ADD CONSTRAINT FK_E56F8A99CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reclamer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E56F8A99CF18BB82 ON reclamer (reponse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamer DROP FOREIGN KEY FK_E56F8A99CF18BB82');
        $this->addSql('DROP INDEX UNIQ_E56F8A99CF18BB82 ON reclamer');
        $this->addSql('ALTER TABLE reclamer DROP reponse_id, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE idreclamation idreclamation VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reponse CHANGE repondre repondre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE idreclamation idreclamation VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
