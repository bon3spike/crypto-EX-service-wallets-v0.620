<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223095134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commission ADD exchange_for_btc_b DOUBLE PRECISION NOT NULL, ADD mix_for_btc_b DOUBLE PRECISION NOT NULL, DROP exchange_for_reciving_low_risk, DROP mix_for_reciving_low_risk');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commission ADD exchange_for_reciving_low_risk DOUBLE PRECISION NOT NULL, ADD mix_for_reciving_low_risk DOUBLE PRECISION NOT NULL, DROP exchange_for_btc_b, DROP mix_for_btc_b');
    }
}
