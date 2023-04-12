<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222135358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE input_transaction CHANGE output amount DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE output_transaction ADD amount DOUBLE PRECISION NOT NULL, ADD risk_is_low TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE output_transaction DROP amount, DROP risk_is_low');
        $this->addSql('ALTER TABLE input_transaction CHANGE amount output DOUBLE PRECISION NOT NULL');
    }
}
