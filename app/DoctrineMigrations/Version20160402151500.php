<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160402151500 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_version ADD modified_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE977499049ECE FOREIGN KEY (modified_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_52CE977499049ECE ON article_version (modified_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_version DROP FOREIGN KEY FK_52CE977499049ECE');
        $this->addSql('DROP INDEX IDX_52CE977499049ECE ON article_version');
        $this->addSql('ALTER TABLE article_version DROP modified_by_id');
    }
}
