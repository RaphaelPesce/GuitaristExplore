<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112035354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE regulation ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE regulation ADD CONSTRAINT FK_53ECC299A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_53ECC299A76ED395 ON regulation (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE regulation DROP FOREIGN KEY FK_53ECC299A76ED395');
        $this->addSql('DROP INDEX IDX_53ECC299A76ED395 ON regulation');
        $this->addSql('ALTER TABLE regulation DROP user_id');
    }
}
