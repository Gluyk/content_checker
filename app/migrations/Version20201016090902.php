<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201016090902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page_to_check (id INT AUTO_INCREMENT NOT NULL, url LONGTEXT NOT NULL, filter LONGTEXT NOT NULL, cron SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results (id INT AUTO_INCREMENT NOT NULL, page_id_id INT NOT NULL, body LONGTEXT NOT NULL, date DATETIME NOT NULL, row SMALLINT NOT NULL, INDEX IDX_9FA3E41419C56181 (page_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E41419C56181 FOREIGN KEY (page_id_id) REFERENCES page_to_check (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE results DROP FOREIGN KEY FK_9FA3E41419C56181');
        $this->addSql('DROP TABLE page_to_check');
        $this->addSql('DROP TABLE results');
    }
}
