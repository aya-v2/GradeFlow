<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251227090602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affectation (id INT AUTO_INCREMENT NOT NULL, coefficient DOUBLE PRECISION NOT NULL, user_id INT NOT NULL, module_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_F4DD61D3A76ED395 (user_id), INDEX IDX_F4DD61D3AFC2B591 (module_id), INDEX IDX_F4DD61D38F5EA509 (classe_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE assessment (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, coefficient DOUBLE PRECISION NOT NULL, semester VARCHAR(50) NOT NULL, affectation_id INT NOT NULL, INDEX IDX_F7523D706D0ABA22 (affectation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, school_year VARCHAR(20) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, value DOUBLE PRECISION NOT NULL, user_id INT NOT NULL, assessment_id INT NOT NULL, INDEX IDX_595AAE34A76ED395 (user_id), INDEX IDX_595AAE34DD3DD5F1 (assessment_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, classe_id INT DEFAULT NULL, INDEX IDX_8D93D6498F5EA509 (classe_id), UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE assessment ADD CONSTRAINT FK_F7523D706D0ABA22 FOREIGN KEY (affectation_id) REFERENCES affectation (id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34DD3DD5F1 FOREIGN KEY (assessment_id) REFERENCES assessment (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3A76ED395');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3AFC2B591');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D38F5EA509');
        $this->addSql('ALTER TABLE assessment DROP FOREIGN KEY FK_F7523D706D0ABA22');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE34A76ED395');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE34DD3DD5F1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('DROP TABLE affectation');
        $this->addSql('DROP TABLE assessment');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
