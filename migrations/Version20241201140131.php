<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201140131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_day (id INT AUTO_INCREMENT NOT NULL, year_id INT NOT NULL, day_id INT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_FEFA3A5540C1FEA7 (year_id), INDEX IDX_FEFA3A559C24126 (day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_day ADD CONSTRAINT FK_FEFA3A5540C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE game_day ADD CONSTRAINT FK_FEFA3A559C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_day DROP FOREIGN KEY FK_FEFA3A5540C1FEA7');
        $this->addSql('ALTER TABLE game_day DROP FOREIGN KEY FK_FEFA3A559C24126');
        $this->addSql('DROP TABLE game_day');
    }
}
