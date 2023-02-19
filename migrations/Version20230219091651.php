<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219091651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE post_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post_image (id INT NOT NULL, image_id_id INT NOT NULL, post_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_522688B068011AFE ON post_image (image_id_id)');
        $this->addSql('CREATE INDEX IDX_522688B0E85F12B8 ON post_image (post_id_id)');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B068011AFE FOREIGN KEY (image_id_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B0E85F12B8 FOREIGN KEY (post_id_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_image_id_seq CASCADE');
        $this->addSql('ALTER TABLE post_image DROP CONSTRAINT FK_522688B068011AFE');
        $this->addSql('ALTER TABLE post_image DROP CONSTRAINT FK_522688B0E85F12B8');
        $this->addSql('DROP TABLE post_image');
    }
}
