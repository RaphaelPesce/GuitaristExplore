<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112040409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting ADD material_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B898E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('CREATE INDEX IDX_9F74B898E308AC6F ON setting (material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B898E308AC6F');
        $this->addSql('DROP INDEX IDX_9F74B898E308AC6F ON setting');
        $this->addSql('ALTER TABLE setting DROP material_id');
    }
}
