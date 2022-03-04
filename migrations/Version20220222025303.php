<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222025303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY type');
        $this->addSql('DROP INDEX type ON exercice');
        $this->addSql('ALTER TABLE exercice DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice ADD type INT NOT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT type FOREIGN KEY (type) REFERENCES type_exercice (id)');
        $this->addSql('CREATE INDEX type ON exercice (type)');
    }
}
