<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220925031928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE financer (id INT AUTO_INCREMENT NOT NULL, funded_by_id INT DEFAULT NULL, funded_for_id INT DEFAULT NULL, montant VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_CCCD350F8B81BE4F (funded_by_id), INDEX IDX_CCCD350FCD1427CB (funded_for_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE financer ADD CONSTRAINT FK_CCCD350F8B81BE4F FOREIGN KEY (funded_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE financer ADD CONSTRAINT FK_CCCD350FCD1427CB FOREIGN KEY (funded_for_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE financer DROP FOREIGN KEY FK_CCCD350F8B81BE4F');
        $this->addSql('ALTER TABLE financer DROP FOREIGN KEY FK_CCCD350FCD1427CB');
        $this->addSql('DROP TABLE financer');
    }
}
