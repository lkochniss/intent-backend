<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150828131447 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE directory (id INT AUTO_INCREMENT NOT NULL, parent_directory_id INT DEFAULT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, full_path VARCHAR(255) NOT NULL, INDEX IDX_467844DA7CFA5BB1 (parent_directory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE directory ADD CONSTRAINT FK_467844DA7CFA5BB1 FOREIGN KEY (parent_directory_id) REFERENCES directory (id)');
        $this->addSql('ALTER TABLE article CHANGE publish_at publish_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD parent_directory_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD path VARCHAR(255) NOT NULL, ADD full_path VARCHAR(255) NOT NULL, DROP file_name, DROP file_extension');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7CFA5BB1 FOREIGN KEY (parent_directory_id) REFERENCES directory (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F7CFA5BB1 ON image (parent_directory_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE directory DROP FOREIGN KEY FK_467844DA7CFA5BB1');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7CFA5BB1');
        $this->addSql('DROP TABLE directory');
        $this->addSql('ALTER TABLE article CHANGE publish_at publish_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX IDX_C53D045F7CFA5BB1 ON image');
        $this->addSql('ALTER TABLE image ADD file_name VARCHAR(255) NOT NULL, ADD file_extension VARCHAR(255) NOT NULL, DROP parent_directory_id, DROP name, DROP description, DROP path, DROP full_path');
    }
}
