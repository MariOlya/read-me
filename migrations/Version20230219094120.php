<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219094120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE post_to_hashtag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post_hashtag (post_id INT NOT NULL, hashtag_id INT NOT NULL, PRIMARY KEY(post_id, hashtag_id))');
        $this->addSql('CREATE INDEX IDX_675D9D524B89032C ON post_hashtag (post_id)');
        $this->addSql('CREATE INDEX IDX_675D9D52FB34EF56 ON post_hashtag (hashtag_id)');
        $this->addSql('CREATE TABLE post_to_hashtag (id INT NOT NULL, post_id_id INT NOT NULL, hashtag_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7551E55E85F12B8 ON post_to_hashtag (post_id_id)');
        $this->addSql('CREATE INDEX IDX_F7551E55F6228C5F ON post_to_hashtag (hashtag_id_id)');
        $this->addSql('ALTER TABLE post_hashtag ADD CONSTRAINT FK_675D9D524B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_hashtag ADD CONSTRAINT FK_675D9D52FB34EF56 FOREIGN KEY (hashtag_id) REFERENCES hashtag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_to_hashtag ADD CONSTRAINT FK_F7551E55E85F12B8 FOREIGN KEY (post_id_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_to_hashtag ADD CONSTRAINT FK_F7551E55F6228C5F FOREIGN KEY (hashtag_id_id) REFERENCES hashtag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_to_hashtag_id_seq CASCADE');
        $this->addSql('ALTER TABLE post_hashtag DROP CONSTRAINT FK_675D9D524B89032C');
        $this->addSql('ALTER TABLE post_hashtag DROP CONSTRAINT FK_675D9D52FB34EF56');
        $this->addSql('ALTER TABLE post_to_hashtag DROP CONSTRAINT FK_F7551E55E85F12B8');
        $this->addSql('ALTER TABLE post_to_hashtag DROP CONSTRAINT FK_F7551E55F6228C5F');
        $this->addSql('DROP TABLE post_hashtag');
        $this->addSql('DROP TABLE post_to_hashtag');
    }
}
