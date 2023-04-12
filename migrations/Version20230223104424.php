<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223104424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE addresses_mixing DROP FOREIGN KEY FK_369DA73F712520F3');
        $this->addSql('DROP TABLE addresses_mixing');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses_mixing (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, percentage INT NOT NULL, delay TIME NOT NULL, INDEX IDX_369DA73F712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE addresses_mixing ADD CONSTRAINT FK_369DA73F712520F3 FOREIGN KEY (wallet_id) REFERENCES wallets (id)');
    }
}
