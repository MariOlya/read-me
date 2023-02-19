<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219085829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE chat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chat (id INT NOT NULL, first_user_id_id INT NOT NULL, second_user_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_659DF2AAC1E0408 ON chat (first_user_id_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA7ED8859C ON chat (second_user_id_id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAC1E0408 FOREIGN KEY (first_user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA7ED8859C FOREIGN KEY (second_user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE chat_id_seq CASCADE');
        $this->addSql('ALTER TABLE chat DROP CONSTRAINT FK_659DF2AAC1E0408');
        $this->addSql('ALTER TABLE chat DROP CONSTRAINT FK_659DF2AA7ED8859C');
        $this->addSql('DROP TABLE chat');
    }
}
