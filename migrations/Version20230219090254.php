<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219090254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ad_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ad (id INT NOT NULL, image_id_id INT NOT NULL, title VARCHAR(100) NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, finish_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, url TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED5868011AFE ON ad (image_id_id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5868011AFE FOREIGN KEY (image_id_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE ad_id_seq CASCADE');
        $this->addSql('ALTER TABLE ad DROP CONSTRAINT FK_77E0ED5868011AFE');
        $this->addSql('DROP TABLE ad');
    }
}
