<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222112733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commission (id INT AUTO_INCREMENT NOT NULL, exchange_min DOUBLE PRECISION NOT NULL, exchange_max DOUBLE PRECISION NOT NULL, exchange_for_sending_high_risk DOUBLE PRECISION NOT NULL, exchange_for_reciving_low_risk DOUBLE PRECISION NOT NULL, mix_btc_min DOUBLE PRECISION NOT NULL, mix_btc_max DOUBLE PRECISION NOT NULL, mix_eth_min DOUBLE PRECISION NOT NULL, mix_eth_max DOUBLE PRECISION NOT NULL, mix_usdt_min DOUBLE PRECISION NOT NULL, mix_usdt_max DOUBLE PRECISION NOT NULL, mix_usdc_min DOUBLE PRECISION NOT NULL, mix_usdc_max DOUBLE PRECISION NOT NULL, mix_for_sending_high_risk DOUBLE PRECISION NOT NULL, mix_for_reciving_low_risk DOUBLE PRECISION NOT NULL, btc_per_address DOUBLE PRECISION NOT NULL, eth_per_address DOUBLE PRECISION NOT NULL, usdt_per_address DOUBLE PRECISION NOT NULL, usdc_per_address DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mix_order (id INT AUTO_INCREMENT NOT NULL, address_of_service VARCHAR(255) NOT NULL, currency_to_mix VARCHAR(255) NOT NULL, number INT NOT NULL, created_at DATETIME NOT NULL, status INT NOT NULL, commission_persents DOUBLE PRECISION NOT NULL, commission_of_risk_for_sending DOUBLE PRECISION NOT NULL, commission_of_risk_of_recieving DOUBLE PRECISION NOT NULL, comission_of_service DOUBLE PRECISION NOT NULL, low_risk TINYINT(1) NOT NULL, mix_code VARCHAR(255) NOT NULL, amount_to_send DOUBLE PRECISION NOT NULL, over_max TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commission');
        $this->addSql('DROP TABLE mix_order');
    }
}
