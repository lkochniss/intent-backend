<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150904090932 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD thumbnail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66FDFF2E92 ON article (thumbnail_id)');
        $this->addSql('ALTER TABLE event ADD background_image_id INT DEFAULT NULL, ADD thumbnail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7E6DA28AA FOREIGN KEY (background_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7FDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7E6DA28AA ON event (background_image_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7FDFF2E92 ON event (thumbnail_id)');
        $this->addSql('ALTER TABLE related ADD background_image_id INT DEFAULT NULL, ADD thumbnail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_60577090E6DA28AA FOREIGN KEY (background_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_60577090FDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_60577090E6DA28AA ON related (background_image_id)');
        $this->addSql('CREATE INDEX IDX_60577090FDFF2E92 ON related (thumbnail_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FDFF2E92');
        $this->addSql('DROP INDEX IDX_23A0E66FDFF2E92 ON article');
        $this->addSql('ALTER TABLE article DROP thumbnail_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7E6DA28AA');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7FDFF2E92');
        $this->addSql('DROP INDEX IDX_3BAE0AA7E6DA28AA ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA7FDFF2E92 ON event');
        $this->addSql('ALTER TABLE event DROP background_image_id, DROP thumbnail_id');
        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_60577090E6DA28AA');
        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_60577090FDFF2E92');
        $this->addSql('DROP INDEX IDX_60577090E6DA28AA ON related');
        $this->addSql('DROP INDEX IDX_60577090FDFF2E92 ON related');
        $this->addSql('ALTER TABLE related DROP background_image_id, DROP thumbnail_id');
    }
}
