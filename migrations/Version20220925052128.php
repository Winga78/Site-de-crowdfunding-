<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220925052128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publication_projet (id INT AUTO_INCREMENT NOT NULL, get_projet_id INT DEFAULT NULL, financed_by_id INT DEFAULT NULL, INDEX IDX_B4FE8DE42C29EBF4 (get_projet_id), INDEX IDX_B4FE8DE4A0D4B9B0 (financed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_projet ADD CONSTRAINT FK_B4FE8DE42C29EBF4 FOREIGN KEY (get_projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE publication_projet ADD CONSTRAINT FK_B4FE8DE4A0D4B9B0 FOREIGN KEY (financed_by_id) REFERENCES financer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication_projet DROP FOREIGN KEY FK_B4FE8DE42C29EBF4');
        $this->addSql('ALTER TABLE publication_projet DROP FOREIGN KEY FK_B4FE8DE4A0D4B9B0');
        $this->addSql('DROP TABLE publication_projet');
    }
}
