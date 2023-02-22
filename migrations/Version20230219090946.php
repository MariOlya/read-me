<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219090946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, author_id_id INT NOT NULL, chat_id_id INT NOT NULL, text TEXT DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT NOW(), PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307F69CCBE9A ON message (author_id_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F7E3973CC ON message (chat_id_id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F69CCBE9A FOREIGN KEY (author_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F7E3973CC FOREIGN KEY (chat_id_id) REFERENCES chat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F69CCBE9A');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F7E3973CC');
        $this->addSql('DROP TABLE message');
    }
}
