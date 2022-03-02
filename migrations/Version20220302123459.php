<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302123459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliment CHANGE calories calories DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE recette DROP listaliment, CHANGE regime regime VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliment CHANGE calories calories DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD listaliment LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', CHANGE regime regime LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
    }
}
