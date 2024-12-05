<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204213459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_day_input ADD game_day_id INT NOT NULL');
        $this->addSql('ALTER TABLE game_day_input ADD CONSTRAINT FK_B3434F3174F7ECEE FOREIGN KEY (game_day_id) REFERENCES game_day (id)');
        $this->addSql('CREATE INDEX IDX_B3434F3174F7ECEE ON game_day_input (game_day_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_day_input DROP FOREIGN KEY FK_B3434F3174F7ECEE');
        $this->addSql('DROP INDEX IDX_B3434F3174F7ECEE ON game_day_input');
        $this->addSql('ALTER TABLE game_day_input DROP game_day_id');
    }
}
