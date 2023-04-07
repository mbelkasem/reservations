<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230406142235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE show_artist_type (show_id INT NOT NULL, artist_type_id INT NOT NULL, INDEX IDX_9F6421FED0C1FC64 (show_id), INDEX IDX_9F6421FE7203D2A4 (artist_type_id), PRIMARY KEY(show_id, artist_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE show_artist_type ADD CONSTRAINT FK_9F6421FED0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_artist_type ADD CONSTRAINT FK_9F6421FE7203D2A4 FOREIGN KEY (artist_type_id) REFERENCES artist_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE locations CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE website website VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE shows CHANGE poster_url poster_url VARCHAR(255) DEFAULT NULL, CHANGE price price NUMERIC(12, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_artist_type DROP FOREIGN KEY FK_9F6421FED0C1FC64');
        $this->addSql('ALTER TABLE show_artist_type DROP FOREIGN KEY FK_9F6421FE7203D2A4');
        $this->addSql('DROP TABLE show_artist_type');
        $this->addSql('ALTER TABLE locations CHANGE adress adress VARCHAR(255) DEFAULT \'NULL\', CHANGE website website VARCHAR(255) DEFAULT \'NULL\', CHANGE phone phone VARCHAR(30) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE shows CHANGE poster_url poster_url VARCHAR(255) DEFAULT \'NULL\', CHANGE price price NUMERIC(12, 2) DEFAULT \'NULL\'');
    }
}
