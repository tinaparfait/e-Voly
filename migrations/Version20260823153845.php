<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260823153845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vegetable_disease (vegetable_id INT NOT NULL, disease_id INT NOT NULL, INDEX IDX_9A4A1EA63D33F4D6 (vegetable_id), INDEX IDX_9A4A1EA6D8355341 (disease_id), PRIMARY KEY (vegetable_id, disease_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vegetable_disease ADD CONSTRAINT FK_9A4A1EA63D33F4D6 FOREIGN KEY (vegetable_id) REFERENCES vegetable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vegetable_disease ADD CONSTRAINT FK_9A4A1EA6D8355341 FOREIGN KEY (disease_id) REFERENCES disease (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disease DROP FOREIGN KEY `FK_F3B6AC13D33F4D6`');
        $this->addSql('DROP INDEX IDX_F3B6AC13D33F4D6 ON disease');
        $this->addSql('ALTER TABLE disease DROP vegetable_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vegetable_disease DROP FOREIGN KEY FK_9A4A1EA63D33F4D6');
        $this->addSql('ALTER TABLE vegetable_disease DROP FOREIGN KEY FK_9A4A1EA6D8355341');
        $this->addSql('DROP TABLE vegetable_disease');
        $this->addSql('ALTER TABLE disease ADD vegetable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE disease ADD CONSTRAINT `FK_F3B6AC13D33F4D6` FOREIGN KEY (vegetable_id) REFERENCES vegetable (id)');
        $this->addSql('CREATE INDEX IDX_F3B6AC13D33F4D6 ON disease (vegetable_id)');
    }
}
