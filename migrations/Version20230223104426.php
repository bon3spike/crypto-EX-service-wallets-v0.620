<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223104426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD temp VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mix_order DROP wallet_of_service, DROP address_of_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP temp');
        $this->addSql('ALTER TABLE mix_order ADD wallet_of_service INT NOT NULL, ADD address_of_user VARCHAR(100) NOT NULL');
    }
}
