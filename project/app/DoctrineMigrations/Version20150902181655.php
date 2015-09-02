<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150902181655 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articles_tags (article_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_354053617294869C (article_id), INDEX IDX_35405361BAD26311 (tag_id), PRIMARY KEY(article_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE directory (id INT AUTO_INCREMENT NOT NULL, parent_directory_id INT DEFAULT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, full_path VARCHAR(255) NOT NULL, INDEX IDX_467844DA7CFA5BB1 (parent_directory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_roles (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_51498A8EA76ED395 (user_id), INDEX IDX_51498A8ED60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_tags ADD CONSTRAINT FK_354053617294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE articles_tags ADD CONSTRAINT FK_35405361BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE directory ADD CONSTRAINT FK_467844DA7CFA5BB1 FOREIGN KEY (parent_directory_id) REFERENCES directory (id)');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8ED60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('DROP TABLE image_type');
        $this->addSql('ALTER TABLE article DROP INDEX UNIQ_23A0E664162C001, ADD INDEX IDX_23A0E664162C001 (related_id)');
        $this->addSql('ALTER TABLE article ADD publish_at DATETIME DEFAULT NULL, ADD published TINYINT(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE category ADD published TINYINT(1) NOT NULL, ADD priority INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD published TINYINT(1) NOT NULL, CHANGE start_at start_at DATE NOT NULL, CHANGE end_at end_at DATE NOT NULL');
        $this->addSql('ALTER TABLE image ADD parent_directory_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL, ADD description LONGTEXT NOT NULL, ADD full_path VARCHAR(255) NOT NULL, CHANGE alt_text path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7CFA5BB1 FOREIGN KEY (parent_directory_id) REFERENCES directory (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F7CFA5BB1 ON image (parent_directory_id)');
        $this->addSql('ALTER TABLE page ADD publish_at DATETIME DEFAULT NULL, ADD published TINYINT(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE profile ADD user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FA76ED395 ON profile (user_id)');
        $this->addSql('ALTER TABLE related ADD game_id INT DEFAULT NULL, ADD published TINYINT(1) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE slug slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE related ADD CONSTRAINT FK_60577090E48FD905 FOREIGN KEY (game_id) REFERENCES related (id)');
        $this->addSql('CREATE INDEX IDX_60577090E48FD905 ON related (game_id)');
        $this->addSql('ALTER TABLE tag ADD published TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC ON user');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL, ADD valid_until DATETIME DEFAULT NULL, DROP role_id, CHANGE is_active is_active TINYINT(1) NOT NULL');
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
        $this->addSql('CREATE TABLE image_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE articles_tags');
        $this->addSql('DROP TABLE directory');
        $this->addSql('DROP TABLE users_roles');
        $this->addSql('ALTER TABLE article DROP INDEX IDX_23A0E664162C001, ADD UNIQUE INDEX UNIQ_23A0E664162C001 (related_id)');
        $this->addSql('ALTER TABLE article DROP publish_at, DROP published, CHANGE content content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category DROP published, DROP priority');
        $this->addSql('ALTER TABLE event DROP published, CHANGE start_at start_at DATETIME NOT NULL, CHANGE end_at end_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX IDX_C53D045F7CFA5BB1 ON image');
        $this->addSql('ALTER TABLE image ADD alt_text VARCHAR(255) NOT NULL, DROP parent_directory_id, DROP created_at, DROP modified_at, DROP description, DROP path, DROP full_path');
        $this->addSql('ALTER TABLE page DROP publish_at, DROP published, CHANGE content content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('DROP INDEX UNIQ_8157AA0FA76ED395 ON profile');
        $this->addSql('ALTER TABLE profile DROP user_id, DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE related DROP FOREIGN KEY FK_60577090E48FD905');
        $this->addSql('DROP INDEX IDX_60577090E48FD905 ON related');
        $this->addSql('ALTER TABLE related DROP game_id, DROP published, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag DROP published');
        $this->addSql('ALTER TABLE user ADD role_id INT DEFAULT NULL, DROP created_at, DROP modified_at, DROP valid_until, CHANGE is_active is_active INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }
}
