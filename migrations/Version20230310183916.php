<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310183916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address_mixing DROP FOREIGN KEY FK_6BF6E7AA712520F3');
        $this->addSql('DROP INDEX IDX_6BF6E7AA712520F3 ON address_mixing');
        $this->addSql('ALTER TABLE address_mixing DROP wallet_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address_mixing ADD wallet_id INT NOT NULL');
        $this->addSql('ALTER TABLE address_mixing ADD CONSTRAINT FK_6BF6E7AA712520F3 FOREIGN KEY (wallet_id) REFERENCES wallets (id)');
        $this->addSql('CREATE INDEX IDX_6BF6E7AA712520F3 ON address_mixing (wallet_id)');
    }
}
