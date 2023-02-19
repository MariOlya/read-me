<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219082139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE subscribe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subscribe (id INT NOT NULL, author_id_id INT NOT NULL, subscriber_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_68B95F3E69CCBE9A ON subscribe (author_id_id)');
        $this->addSql('CREATE INDEX IDX_68B95F3E44E41CB0 ON subscribe (subscriber_id_id)');
        $this->addSql('ALTER TABLE subscribe ADD CONSTRAINT FK_68B95F3E69CCBE9A FOREIGN KEY (author_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscribe ADD CONSTRAINT FK_68B95F3E44E41CB0 FOREIGN KEY (subscriber_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE subscribe_id_seq CASCADE');
        $this->addSql('ALTER TABLE subscribe DROP CONSTRAINT FK_68B95F3E69CCBE9A');
        $this->addSql('ALTER TABLE subscribe DROP CONSTRAINT FK_68B95F3E44E41CB0');
        $this->addSql('DROP TABLE subscribe');
    }
}
