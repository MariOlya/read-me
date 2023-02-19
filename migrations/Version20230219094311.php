<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219094311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "like_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "like" (id INT NOT NULL, author_id_id INT NOT NULL, post_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AC6340B369CCBE9A ON "like" (author_id_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3E85F12B8 ON "like" (post_id_id)');
        $this->addSql('ALTER TABLE "like" ADD CONSTRAINT FK_AC6340B369CCBE9A FOREIGN KEY (author_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "like" ADD CONSTRAINT FK_AC6340B3E85F12B8 FOREIGN KEY (post_id_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "like_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "like" DROP CONSTRAINT FK_AC6340B369CCBE9A');
        $this->addSql('ALTER TABLE "like" DROP CONSTRAINT FK_AC6340B3E85F12B8');
        $this->addSql('DROP TABLE "like"');
    }
}
