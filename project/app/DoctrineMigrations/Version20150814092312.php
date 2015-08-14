<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150814092312 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE category ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE franchise ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE game ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE page ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE publisher ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE studio ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tag ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE category DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE event DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE franchise DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE game DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE page DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE publisher DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE studio DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE tag DROP created_at, DROP modified_at');
    }
}
