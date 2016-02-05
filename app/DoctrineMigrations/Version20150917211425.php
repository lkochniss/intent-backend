<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150917211425 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_version (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, category_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, event_id INT DEFAULT NULL, related_id INT DEFAULT NULL, thumbnail_id INT DEFAULT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, publish_at DATETIME DEFAULT NULL, published TINYINT(1) NOT NULL, slideshow TINYINT(1) NOT NULL, INDEX IDX_52CE97747294869C (article_id), INDEX IDX_52CE977412469DE2 (category_id), INDEX IDX_52CE9774B03A8386 (created_by_id), INDEX IDX_52CE977471F7E88B (event_id), INDEX IDX_52CE97744162C001 (related_id), INDEX IDX_52CE9774FDFF2E92 (thumbnail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE97747294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE977412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE9774B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE977471F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE97744162C001 FOREIGN KEY (related_id) REFERENCES related (id)');
        $this->addSql('ALTER TABLE article_version ADD CONSTRAINT FK_52CE9774FDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE page DROP publish_at');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_version');
        $this->addSql('ALTER TABLE page ADD publish_at DATETIME DEFAULT NULL');
    }
}
