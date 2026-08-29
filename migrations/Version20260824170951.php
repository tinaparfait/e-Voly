<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260824170951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disease_vegetable (disease_id INT NOT NULL, vegetable_id INT NOT NULL, INDEX IDX_E6DB648DD8355341 (disease_id), INDEX IDX_E6DB648D3D33F4D6 (vegetable_id), PRIMARY KEY (disease_id, vegetable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE season_vegetable (season_id INT NOT NULL, vegetable_id INT NOT NULL, INDEX IDX_50AADA184EC001D1 (season_id), INDEX IDX_50AADA183D33F4D6 (vegetable_id), PRIMARY KEY (season_id, vegetable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE disease_vegetable ADD CONSTRAINT FK_E6DB648DD8355341 FOREIGN KEY (disease_id) REFERENCES disease (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disease_vegetable ADD CONSTRAINT FK_E6DB648D3D33F4D6 FOREIGN KEY (vegetable_id) REFERENCES vegetable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season_vegetable ADD CONSTRAINT FK_50AADA184EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season_vegetable ADD CONSTRAINT FK_50AADA183D33F4D6 FOREIGN KEY (vegetable_id) REFERENCES vegetable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vegetable_season DROP FOREIGN KEY `FK_3EDABE613D33F4D6`');
        $this->addSql('ALTER TABLE vegetable_season DROP FOREIGN KEY `FK_3EDABE614EC001D1`');
        $this->addSql('DROP TABLE vegetable_season');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vegetable_season (vegetable_id INT NOT NULL, season_id INT NOT NULL, INDEX IDX_3EDABE613D33F4D6 (vegetable_id), INDEX IDX_3EDABE614EC001D1 (season_id), PRIMARY KEY (vegetable_id, season_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vegetable_season ADD CONSTRAINT `FK_3EDABE613D33F4D6` FOREIGN KEY (vegetable_id) REFERENCES vegetable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vegetable_season ADD CONSTRAINT `FK_3EDABE614EC001D1` FOREIGN KEY (season_id) REFERENCES season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disease_vegetable DROP FOREIGN KEY FK_E6DB648DD8355341');
        $this->addSql('ALTER TABLE disease_vegetable DROP FOREIGN KEY FK_E6DB648D3D33F4D6');
        $this->addSql('ALTER TABLE season_vegetable DROP FOREIGN KEY FK_50AADA184EC001D1');
        $this->addSql('ALTER TABLE season_vegetable DROP FOREIGN KEY FK_50AADA183D33F4D6');
        $this->addSql('DROP TABLE disease_vegetable');
        $this->addSql('DROP TABLE season_vegetable');
    }
}
