<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219091330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE message_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE message_file (id INT NOT NULL, file_id_id INT NOT NULL, message_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250AADC9D5C72E60 ON message_file (file_id_id)');
        $this->addSql('CREATE INDEX IDX_250AADC980E261BC ON message_file (message_id_id)');
        $this->addSql('ALTER TABLE message_file ADD CONSTRAINT FK_250AADC9D5C72E60 FOREIGN KEY (file_id_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_file ADD CONSTRAINT FK_250AADC980E261BC FOREIGN KEY (message_id_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE message_file_id_seq CASCADE');
        $this->addSql('ALTER TABLE message_file DROP CONSTRAINT FK_250AADC9D5C72E60');
        $this->addSql('ALTER TABLE message_file DROP CONSTRAINT FK_250AADC980E261BC');
        $this->addSql('DROP TABLE message_file');
    }
}
