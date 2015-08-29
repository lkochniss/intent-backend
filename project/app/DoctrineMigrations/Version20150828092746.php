<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150828092746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image_type');
        $this->addSql('ALTER TABLE category ADD published TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE event ADD published TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE page ADD publish_at DATETIME DEFAULT NULL, ADD published TINYINT(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE related ADD published TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE tag ADD published TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category DROP published');
        $this->addSql('ALTER TABLE event DROP published');
        $this->addSql('ALTER TABLE page DROP publish_at, DROP published, CHANGE content content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE related DROP published');
        $this->addSql('ALTER TABLE tag DROP published');
    }
}
