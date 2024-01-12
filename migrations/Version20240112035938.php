<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112035938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guitarist ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guitarist ADD CONSTRAINT FK_C53E7883A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C53E7883A76ED395 ON guitarist (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guitarist DROP FOREIGN KEY FK_C53E7883A76ED395');
        $this->addSql('DROP INDEX IDX_C53E7883A76ED395 ON guitarist');
        $this->addSql('ALTER TABLE guitarist DROP user_id');
    }
}
