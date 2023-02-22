<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219071126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, avatar_id_id INT DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT NOW(), email VARCHAR(30) NOT NULL, login VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496ED73160 ON "user" (avatar_id_id)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6496ED73160 FOREIGN KEY (avatar_id_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6496ED73160');
        $this->addSql('DROP TABLE "user"');
    }
}
