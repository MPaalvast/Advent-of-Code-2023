<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205132105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, title INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day_part (id INT AUTO_INCREMENT NOT NULL, title INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_day (id INT AUTO_INCREMENT NOT NULL, year_id INT NOT NULL, day_id INT NOT NULL, title VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_FEFA3A5540C1FEA7 (year_id), INDEX IDX_FEFA3A559C24126 (day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_day_input (id INT AUTO_INCREMENT NOT NULL, day_part_id INT NOT NULL, game_day_id INT NOT NULL, input LONGTEXT NOT NULL, INDEX IDX_B3434F31B4263B6E (day_part_id), INDEX IDX_B3434F3174F7ECEE (game_day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_day_result (id INT AUTO_INCREMENT NOT NULL, game_day_id INT NOT NULL, day_part_id INT NOT NULL, solved TINYINT(1) NOT NULL, INDEX IDX_5A68ED2374F7ECEE (game_day_id), INDEX IDX_5A68ED23B4263B6E (day_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, title INT NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_day ADD CONSTRAINT FK_FEFA3A5540C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE game_day ADD CONSTRAINT FK_FEFA3A559C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE game_day_input ADD CONSTRAINT FK_B3434F31B4263B6E FOREIGN KEY (day_part_id) REFERENCES day_part (id)');
        $this->addSql('ALTER TABLE game_day_input ADD CONSTRAINT FK_B3434F3174F7ECEE FOREIGN KEY (game_day_id) REFERENCES game_day (id)');
        $this->addSql('ALTER TABLE game_day_result ADD CONSTRAINT FK_5A68ED2374F7ECEE FOREIGN KEY (game_day_id) REFERENCES game_day (id)');
        $this->addSql('ALTER TABLE game_day_result ADD CONSTRAINT FK_5A68ED23B4263B6E FOREIGN KEY (day_part_id) REFERENCES day_part (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_day DROP FOREIGN KEY FK_FEFA3A5540C1FEA7');
        $this->addSql('ALTER TABLE game_day DROP FOREIGN KEY FK_FEFA3A559C24126');
        $this->addSql('ALTER TABLE game_day_input DROP FOREIGN KEY FK_B3434F31B4263B6E');
        $this->addSql('ALTER TABLE game_day_input DROP FOREIGN KEY FK_B3434F3174F7ECEE');
        $this->addSql('ALTER TABLE game_day_result DROP FOREIGN KEY FK_5A68ED2374F7ECEE');
        $this->addSql('ALTER TABLE game_day_result DROP FOREIGN KEY FK_5A68ED23B4263B6E');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE day_part');
        $this->addSql('DROP TABLE game_day');
        $this->addSql('DROP TABLE game_day_input');
        $this->addSql('DROP TABLE game_day_result');
        $this->addSql('DROP TABLE year');
    }
}
