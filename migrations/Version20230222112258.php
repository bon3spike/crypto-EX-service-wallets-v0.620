<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222112258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE output_transaction DROP FOREIGN KEY FK_A8601EC27EF396F5');
        $this->addSql('ALTER TABLE output_transaction DROP FOREIGN KEY FK_A8601EC22B2CC405');
        $this->addSql('ALTER TABLE output_transaction DROP FOREIGN KEY FK_A8601EC2778274DE');
        $this->addSql('ALTER TABLE input_transaction DROP FOREIGN KEY FK_87FD3994778274DE');
        $this->addSql('DROP TABLE commission');
        $this->addSql('DROP TABLE output_transaction');
        $this->addSql('DROP TABLE input_transaction');
        $this->addSql('DROP TABLE mix_order');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commission (id INT AUTO_INCREMENT NOT NULL, exchange_min DOUBLE PRECISION NOT NULL, exchange_max DOUBLE PRECISION NOT NULL, exchange_for_sending_high_risk DOUBLE PRECISION NOT NULL, exchange_for_reciving_low_risk DOUBLE PRECISION NOT NULL, mix_btc_min DOUBLE PRECISION NOT NULL, mix_btc_max DOUBLE PRECISION NOT NULL, mix_eth_min DOUBLE PRECISION NOT NULL, mix_eth_max DOUBLE PRECISION NOT NULL, mix_usdt_min DOUBLE PRECISION NOT NULL, mix_usdt_max DOUBLE PRECISION NOT NULL, mix_usdc_min DOUBLE PRECISION NOT NULL, mix_usdc_max DOUBLE PRECISION NOT NULL, mix_for_sending_high_risk DOUBLE PRECISION NOT NULL, mix_for_reciving_low_risk DOUBLE PRECISION NOT NULL, btc_per_address DOUBLE PRECISION NOT NULL, eth_per_address DOUBLE PRECISION NOT NULL, usdt_per_address DOUBLE PRECISION NOT NULL, usdc_per_address DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE output_transaction (id INT AUTO_INCREMENT NOT NULL, sender_wallet_id INT NOT NULL, exorder_id INT DEFAULT NULL, mixorder_id INT DEFAULT NULL, number INT NOT NULL, currency VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hash VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, receiver VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, output DOUBLE PRECISION NOT NULL, input DOUBLE PRECISION NOT NULL, risk_is_low TINYINT(1) NOT NULL, INDEX IDX_A8601EC27EF396F5 (mixorder_id), INDEX IDX_A8601EC22B2CC405 (sender_wallet_id), INDEX IDX_A8601EC2778274DE (exorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE input_transaction (id INT AUTO_INCREMENT NOT NULL, exorder_id INT DEFAULT NULL, mixorder_id INT DEFAULT NULL, number INT NOT NULL, hash VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, currency VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, receiver VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, output DOUBLE PRECISION NOT NULL, risk_is_low TINYINT(1) NOT NULL, INDEX IDX_87FD3994778274DE (exorder_id), INDEX IDX_87FD39947EF396F5 (mixorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mix_order (id INT AUTO_INCREMENT NOT NULL, address_of_service VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, currency_to_mix VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, number INT NOT NULL, created_at DATETIME NOT NULL, status INT NOT NULL, commission_persents DOUBLE PRECISION NOT NULL, commission_of_risk_for_sending DOUBLE PRECISION NOT NULL, commission_of_risk_of_recieving DOUBLE PRECISION NOT NULL, comission_of_service DOUBLE PRECISION NOT NULL, low_risk TINYINT(1) NOT NULL, mix_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, amount_to_send DOUBLE PRECISION NOT NULL, over_max TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE output_transaction ADD CONSTRAINT FK_A8601EC27EF396F5 FOREIGN KEY (mixorder_id) REFERENCES mix_order (id)');
        $this->addSql('ALTER TABLE output_transaction ADD CONSTRAINT FK_A8601EC22B2CC405 FOREIGN KEY (sender_wallet_id) REFERENCES wallets (id)');
        $this->addSql('ALTER TABLE output_transaction ADD CONSTRAINT FK_A8601EC2778274DE FOREIGN KEY (exorder_id) REFERENCES ex_order (id)');
        $this->addSql('ALTER TABLE input_transaction ADD CONSTRAINT FK_87FD3994778274DE FOREIGN KEY (exorder_id) REFERENCES ex_order (id)');
    }
}
