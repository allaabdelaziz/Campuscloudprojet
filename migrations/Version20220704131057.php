<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704131057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, objet_id INT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_3AF34668F520CF5A (objet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_details (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, objet_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5A2CDA2ABCF5E72D (categorie_id), UNIQUE INDEX UNIQ_5A2CDA2AF520CF5A (objet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, secondname VARCHAR(255) NOT NULL, email VARCHAR(150) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, sender_id_id INT NOT NULL, reciipent_id_id INT NOT NULL, message LONGTEXT NOT NULL, title VARCHAR(20) NOT NULL, isread TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DB021E966061F7CF (sender_id_id), INDEX IDX_DB021E9625691580 (reciipent_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, lost_adress VARCHAR(255) NOT NULL, lost_zip VARCHAR(5) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_46CD4C38A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id)');
        $this->addSql('ALTER TABLE categories_details ADD CONSTRAINT FK_5A2CDA2ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE categories_details ADD CONSTRAINT FK_5A2CDA2AF520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E966061F7CF FOREIGN KEY (sender_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E9625691580 FOREIGN KEY (reciipent_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_details DROP FOREIGN KEY FK_5A2CDA2ABCF5E72D');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668F520CF5A');
        $this->addSql('ALTER TABLE categories_details DROP FOREIGN KEY FK_5A2CDA2AF520CF5A');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_details');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE objet');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
