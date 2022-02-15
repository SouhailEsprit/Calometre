<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213092251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamer ADD id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamer ADD CONSTRAINT FK_E56F8A997F449E57 FOREIGN KEY (id_id) REFERENCES reponse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E56F8A997F449E57 ON reclamer (id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamer DROP FOREIGN KEY FK_E56F8A997F449E57');
        $this->addSql('DROP INDEX UNIQ_E56F8A997F449E57 ON reclamer');
        $this->addSql('ALTER TABLE reclamer DROP id_id, CHANGE idreclamation idreclamation VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reponse CHANGE idreponse idreponse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse reponse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
