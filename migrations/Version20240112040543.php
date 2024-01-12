<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112040543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guitarist_material (guitarist_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_CB6AD752A3B58E79 (guitarist_id), INDEX IDX_CB6AD752E308AC6F (material_id), PRIMARY KEY(guitarist_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guitarist_material ADD CONSTRAINT FK_CB6AD752A3B58E79 FOREIGN KEY (guitarist_id) REFERENCES guitarist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guitarist_material ADD CONSTRAINT FK_CB6AD752E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guitarist_material DROP FOREIGN KEY FK_CB6AD752A3B58E79');
        $this->addSql('ALTER TABLE guitarist_material DROP FOREIGN KEY FK_CB6AD752E308AC6F');
        $this->addSql('DROP TABLE guitarist_material');
    }
}
