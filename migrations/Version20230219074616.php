<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219074616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, author_id_id INT NOT NULL, origin_post_id INT DEFAULT NULL, type_id_id INT NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, title VARCHAR(255) NOT NULL, text TEXT DEFAULT NULL, author_quote VARCHAR(100) DEFAULT NULL, view_amount INT NOT NULL, repost BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D69CCBE9A ON post (author_id_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DFEFE1641 ON post (origin_post_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D714819A0 ON post (type_id_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D69CCBE9A FOREIGN KEY (author_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DFEFE1641 FOREIGN KEY (origin_post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D714819A0 FOREIGN KEY (type_id_id) REFERENCES post_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D69CCBE9A');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DFEFE1641');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D714819A0');
        $this->addSql('DROP TABLE post');
    }
}
