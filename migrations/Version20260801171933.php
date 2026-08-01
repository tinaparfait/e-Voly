<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260801171933 extends AbstractMigration
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
        $this->addSql('ALTER TABLE cultivation_step ADD vegetable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cultivation_step ADD CONSTRAINT FK_7D90BD233D33F4D6 FOREIGN KEY (vegetable_id) REFERENCES vegetable (id)');
        $this->addSql('CREATE INDEX IDX_7D90BD233D33F4D6 ON cultivation_step (vegetable_id)');
        $this->addSql('ALTER TABLE tip ADD vegetable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tip ADD CONSTRAINT FK_4883B84C3D33F4D6 FOREIGN KEY (vegetable_id) REFERENCES vegetable (id)');
        $this->addSql('CREATE INDEX IDX_4883B84C3D33F4D6 ON tip (vegetable_id)');
        $this->addSql('ALTER TABLE vegetable ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vegetable ADD CONSTRAINT FK_DB9894F712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_DB9894F712469DE2 ON vegetable (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disease_vegetable DROP FOREIGN KEY FK_E6DB648DD8355341');
        $this->addSql('ALTER TABLE disease_vegetable DROP FOREIGN KEY FK_E6DB648D3D33F4D6');
        $this->addSql('ALTER TABLE season_vegetable DROP FOREIGN KEY FK_50AADA184EC001D1');
        $this->addSql('ALTER TABLE season_vegetable DROP FOREIGN KEY FK_50AADA183D33F4D6');
        $this->addSql('DROP TABLE disease_vegetable');
        $this->addSql('DROP TABLE season_vegetable');
        $this->addSql('ALTER TABLE cultivation_step DROP FOREIGN KEY FK_7D90BD233D33F4D6');
        $this->addSql('DROP INDEX IDX_7D90BD233D33F4D6 ON cultivation_step');
        $this->addSql('ALTER TABLE cultivation_step DROP vegetable_id');
        $this->addSql('ALTER TABLE tip DROP FOREIGN KEY FK_4883B84C3D33F4D6');
        $this->addSql('DROP INDEX IDX_4883B84C3D33F4D6 ON tip');
        $this->addSql('ALTER TABLE tip DROP vegetable_id');
        $this->addSql('ALTER TABLE vegetable DROP FOREIGN KEY FK_DB9894F712469DE2');
        $this->addSql('DROP INDEX IDX_DB9894F712469DE2 ON vegetable');
        $this->addSql('ALTER TABLE vegetable DROP category_id');
    }
}
