<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150813221726 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE franchise ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE franchise ADD CONSTRAINT FK_66F6CE2A40C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
        $this->addSql('CREATE INDEX IDX_66F6CE2A40C86FCE ON franchise (publisher_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE franchise DROP FOREIGN KEY FK_66F6CE2A40C86FCE');
        $this->addSql('DROP INDEX IDX_66F6CE2A40C86FCE ON franchise');
        $this->addSql('ALTER TABLE franchise DROP publisher_id');
    }
}
