<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150902124850 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE related ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_60577090E48FD905 FOREIGN KEY (game_id) REFERENCES related (id)');
        $this->addSql('CREATE INDEX IDX_60577090E48FD905 ON related (game_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_60577090E48FD905');
        $this->addSql('DROP INDEX IDX_60577090E48FD905 ON related');
        $this->addSql('ALTER TABLE related DROP game_id');
    }
}
