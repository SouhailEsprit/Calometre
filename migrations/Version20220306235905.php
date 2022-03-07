<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306235905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA21214B7');
        $this->addSql('CREATE TABLE aliment_recette (aliment_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_AE96FF5C415B9F11 (aliment_id), INDEX IDX_AE96FF5C89312FE9 (recette_id), PRIMARY KEY(aliment_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_cart_id INT DEFAULT NULL, total DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_BA388B742D8D3B5 (user_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_prods (id INT AUTO_INCREMENT NOT NULL, idprod_id INT DEFAULT NULL, idcart_id INT DEFAULT NULL, qty DOUBLE PRECISION NOT NULL, INDEX IDX_2A3A10F5DECC6D1B (idprod_id), INDEX IDX_2A3A10F5C5D19FD1 (idcart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_aliment (recette_id INT NOT NULL, aliment_id INT NOT NULL, INDEX IDX_B4874D5189312FE9 (recette_id), INDEX IDX_B4874D51415B9F11 (aliment_id), PRIMARY KEY(recette_id, aliment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aliment_recette ADD CONSTRAINT FK_AE96FF5C415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aliment_recette ADD CONSTRAINT FK_AE96FF5C89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B742D8D3B5 FOREIGN KEY (user_cart_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_prods ADD CONSTRAINT FK_2A3A10F5DECC6D1B FOREIGN KEY (idprod_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart_prods ADD CONSTRAINT FK_2A3A10F5C5D19FD1 FOREIGN KEY (idcart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE recette_aliment ADD CONSTRAINT FK_B4874D5189312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_aliment ADD CONSTRAINT FK_B4874D51415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE categories');
        $this->addSql('ALTER TABLE aliment ADD name VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL, CHANGE calories calories DOUBLE PRECISION NOT NULL');
        $this->addSql('DROP INDEX IDX_D34A04ADA21214B7 ON product');
        $this->addSql('ALTER TABLE product ADD category_id INT NOT NULL, ADD quantity INT NOT NULL, ADD image VARCHAR(255) NOT NULL, DROP categories_id, DROP quantite, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE categorie description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('ALTER TABLE recette ADD name VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL, DROP listaliment, CHANGE regime regime VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_prods DROP FOREIGN KEY FK_2A3A10F5C5D19FD1');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE aliment_recette');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_prods');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE recette_aliment');
        $this->addSql('ALTER TABLE aliment DROP name, DROP image, CHANGE calories calories DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product ADD categories_id INT DEFAULT NULL, ADD categorie VARCHAR(255) NOT NULL, ADD quantite INT DEFAULT NULL, DROP category_id, DROP description, DROP quantity, DROP image, CHANGE price price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA21214B7 ON product (categories_id)');
        $this->addSql('ALTER TABLE recette ADD listaliment LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', DROP name, DROP image, CHANGE regime regime LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
    }
}
