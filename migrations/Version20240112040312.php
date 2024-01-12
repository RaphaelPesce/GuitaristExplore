<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112040312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting ADD guitarist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B898A3B58E79 FOREIGN KEY (guitarist_id) REFERENCES guitarist (id)');
        $this->addSql('CREATE INDEX IDX_9F74B898A3B58E79 ON setting (guitarist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B898A3B58E79');
        $this->addSql('DROP INDEX IDX_9F74B898A3B58E79 ON setting');
        $this->addSql('ALTER TABLE setting DROP guitarist_id');
    }
}