<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201140443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_day_result (id INT AUTO_INCREMENT NOT NULL, game_day_id INT NOT NULL, day_part_id INT NOT NULL, solved TINYINT(1) NOT NULL, INDEX IDX_5A68ED2374F7ECEE (game_day_id), INDEX IDX_5A68ED23B4263B6E (day_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_day_result ADD CONSTRAINT FK_5A68ED2374F7ECEE FOREIGN KEY (game_day_id) REFERENCES game_day (id)');
        $this->addSql('ALTER TABLE game_day_result ADD CONSTRAINT FK_5A68ED23B4263B6E FOREIGN KEY (day_part_id) REFERENCES day_part (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_day_result DROP FOREIGN KEY FK_5A68ED2374F7ECEE');
        $this->addSql('ALTER TABLE game_day_result DROP FOREIGN KEY FK_5A68ED23B4263B6E');
        $this->addSql('DROP TABLE game_day_result');
    }
}
