<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216223352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tour_request ADD tour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tour_request ADD CONSTRAINT FK_7B7D0A1E15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id)');
        $this->addSql('CREATE INDEX IDX_7B7D0A1E15ED8D43 ON tour_request (tour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tour_request DROP FOREIGN KEY FK_7B7D0A1E15ED8D43');
        $this->addSql('DROP INDEX IDX_7B7D0A1E15ED8D43 ON tour_request');
        $this->addSql('ALTER TABLE tour_request DROP tour_id');
    }
}
