<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302233624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recette_aliment (recette_id INT NOT NULL, aliment_id INT NOT NULL, INDEX IDX_B4874D5189312FE9 (recette_id), INDEX IDX_B4874D51415B9F11 (aliment_id), PRIMARY KEY(recette_id, aliment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recette_aliment ADD CONSTRAINT FK_B4874D5189312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_aliment ADD CONSTRAINT FK_B4874D51415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE aliment_recette');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aliment_recette (aliment_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_AE96FF5C415B9F11 (aliment_id), INDEX IDX_AE96FF5C89312FE9 (recette_id), PRIMARY KEY(aliment_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE aliment_recette ADD CONSTRAINT FK_AE96FF5C415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aliment_recette ADD CONSTRAINT FK_AE96FF5C89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE recette_aliment');
    }
}
