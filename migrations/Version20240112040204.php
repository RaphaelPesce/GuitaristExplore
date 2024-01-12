<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112040204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notice ADD guitarist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notice ADD CONSTRAINT FK_480D45C2A3B58E79 FOREIGN KEY (guitarist_id) REFERENCES guitarist (id)');
        $this->addSql('CREATE INDEX IDX_480D45C2A3B58E79 ON notice (guitarist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notice DROP FOREIGN KEY FK_480D45C2A3B58E79');
        $this->addSql('DROP INDEX IDX_480D45C2A3B58E79 ON notice');
        $this->addSql('ALTER TABLE notice DROP guitarist_id');
    }
}
