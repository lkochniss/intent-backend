<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150814120741 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE franchise DROP FOREIGN KEY FK_66F6CE2A446F285F');
        $this->addSql('DROP INDEX IDX_66F6CE2A446F285F ON franchise');
        $this->addSql('ALTER TABLE franchise DROP studio_id');
        $this->addSql('ALTER TABLE game ADD studio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C446F285F FOREIGN KEY (studio_id) REFERENCES studio (id)');
        $this->addSql('CREATE INDEX IDX_232B318C446F285F ON game (studio_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE franchise ADD studio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE franchise ADD CONSTRAINT FK_66F6CE2A446F285F FOREIGN KEY (studio_id) REFERENCES studio (id)');
        $this->addSql('CREATE INDEX IDX_66F6CE2A446F285F ON franchise (studio_id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C446F285F');
        $this->addSql('DROP INDEX IDX_232B318C446F285F ON game');
        $this->addSql('ALTER TABLE game DROP studio_id');
    }
}
