<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150818213725 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C523CAB89');
        $this->addSql('ALTER TABLE franchise DROP FOREIGN KEY FK_66F6CE2A40C86FCE');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C446F285F');
        $this->addSql('DROP TABLE franchise');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE publisher');
        $this->addSql('DROP TABLE studio');
        $this->addSql('ALTER TABLE related ADD publisher_id INT DEFAULT NULL, ADD studio_id INT DEFAULT NULL, ADD franchise_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD background_link VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_6057709040C86FCE FOREIGN KEY (publisher_id) REFERENCES related (id)');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_60577090446F285F FOREIGN KEY (studio_id) REFERENCES related (id)');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_60577090523CAB89 FOREIGN KEY (franchise_id) REFERENCES related (id)');
        $this->addSql('CREATE INDEX IDX_6057709040C86FCE ON related (publisher_id)');
        $this->addSql('CREATE INDEX IDX_60577090446F285F ON related (studio_id)');
        $this->addSql('CREATE INDEX IDX_60577090523CAB89 ON related (franchise_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE franchise (id INT AUTO_INCREMENT NOT NULL, publisher_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, background_link VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, INDEX IDX_66F6CE2A40C86FCE (publisher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, studio_id INT DEFAULT NULL, franchise_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, background_link VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, INDEX IDX_232B318C523CAB89 (franchise_id), INDEX IDX_232B318C446F285F (studio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publisher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, background_link VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studio (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, background_link VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE franchise ADD CONSTRAINT FK_66F6CE2A40C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C446F285F FOREIGN KEY (studio_id) REFERENCES studio (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C523CAB89 FOREIGN KEY (franchise_id) REFERENCES franchise (id)');
        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_6057709040C86FCE');
        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_60577090446F285F');
        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_60577090523CAB89');
        $this->addSql('DROP INDEX IDX_6057709040C86FCE ON related');
        $this->addSql('DROP INDEX IDX_60577090446F285F ON related');
        $this->addSql('DROP INDEX IDX_60577090523CAB89 ON related');
        $this->addSql('ALTER TABLE related DROP publisher_id, DROP studio_id, DROP franchise_id, DROP created_at, DROP modified_at, DROP name, DROP description, DROP background_link, DROP slug');
    }
}
