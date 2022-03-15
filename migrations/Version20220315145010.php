<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315145010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aliment (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, calories DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aliment_recette (aliment_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_AE96FF5C415B9F11 (aliment_id), INDEX IDX_AE96FF5C89312FE9 (recette_id), PRIMARY KEY(aliment_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_cart_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_BA388B742D8D3B5 (user_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_prods (id INT AUTO_INCREMENT NOT NULL, idprod_id INT DEFAULT NULL, idcart_id INT DEFAULT NULL, qty DOUBLE PRECISION NOT NULL, INDEX IDX_2A3A10F5DECC6D1B (idprod_id), INDEX IDX_2A3A10F5C5D19FD1 (idcart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, user_id INT DEFAULT NULL, commentdate DATE NOT NULL, likecount INT NOT NULL, commentcontent VARCHAR(255) NOT NULL, INDEX IDX_9474526C71F7E88B (event_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, date_debut VARCHAR(50) NOT NULL, date_fin VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, nombre_participants INT NOT NULL, lieu VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, nomtype_id INT NOT NULL, nom VARCHAR(255) NOT NULL, video VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, objectif VARCHAR(255) NOT NULL, INDEX IDX_E418C74DBCB0F447 (nomtype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, creation_date VARCHAR(29) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_5A8A6C8D71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, quantity INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, regime VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_aliment (recette_id INT NOT NULL, aliment_id INT NOT NULL, INDEX IDX_B4874D5189312FE9 (recette_id), INDEX IDX_B4874D51415B9F11 (aliment_id), PRIMARY KEY(recette_id, aliment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_like (id INT AUTO_INCREMENT NOT NULL, recette_id INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_E163AAE889312FE9 (recette_id), INDEX IDX_E163AAE8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, id_id INT DEFAULT NULL, reponse_id INT DEFAULT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, views INT DEFAULT NULL, UNIQUE INDEX UNIQ_CE6064047F449E57 (id_id), UNIQUE INDEX UNIQ_CE606404CF18BB82 (reponse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, repondre_id INT DEFAULT NULL, id_id INT DEFAULT NULL, date DATE NOT NULL, reponse VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5FB6DEC75D693660 (repondre_id), UNIQUE INDEX UNIQ_5FB6DEC77F449E57 (id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_exercice (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phonenumber INT NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, isbanned TINYINT(1) NOT NULL, country_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aliment_recette ADD CONSTRAINT FK_AE96FF5C415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aliment_recette ADD CONSTRAINT FK_AE96FF5C89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B742D8D3B5 FOREIGN KEY (user_cart_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_prods ADD CONSTRAINT FK_2A3A10F5DECC6D1B FOREIGN KEY (idprod_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart_prods ADD CONSTRAINT FK_2A3A10F5C5D19FD1 FOREIGN KEY (idcart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DBCB0F447 FOREIGN KEY (nomtype_id) REFERENCES type_exercice (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE recette_aliment ADD CONSTRAINT FK_B4874D5189312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_aliment ADD CONSTRAINT FK_B4874D51415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_like ADD CONSTRAINT FK_E163AAE889312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette_like ADD CONSTRAINT FK_E163AAE8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064047F449E57 FOREIGN KEY (id_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC75D693660 FOREIGN KEY (repondre_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC77F449E57 FOREIGN KEY (id_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliment_recette DROP FOREIGN KEY FK_AE96FF5C415B9F11');
        $this->addSql('ALTER TABLE recette_aliment DROP FOREIGN KEY FK_B4874D51415B9F11');
        $this->addSql('ALTER TABLE cart_prods DROP FOREIGN KEY FK_2A3A10F5C5D19FD1');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C71F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D71F7E88B');
        $this->addSql('ALTER TABLE cart_prods DROP FOREIGN KEY FK_2A3A10F5DECC6D1B');
        $this->addSql('ALTER TABLE aliment_recette DROP FOREIGN KEY FK_AE96FF5C89312FE9');
        $this->addSql('ALTER TABLE recette_aliment DROP FOREIGN KEY FK_B4874D5189312FE9');
        $this->addSql('ALTER TABLE recette_like DROP FOREIGN KEY FK_E163AAE889312FE9');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064047F449E57');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC75D693660');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC77F449E57');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404CF18BB82');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DBCB0F447');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B742D8D3B5');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE recette_like DROP FOREIGN KEY FK_E163AAE8A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE aliment');
        $this->addSql('DROP TABLE aliment_recette');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_prods');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_aliment');
        $this->addSql('DROP TABLE recette_like');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE type_exercice');
        $this->addSql('DROP TABLE user');
    }
}
