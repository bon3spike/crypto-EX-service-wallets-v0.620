<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206215214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, exchange_order_amount_eth INT DEFAULT NULL, exchange_order_amount_btc INT DEFAULT NULL, exchange_order_amount_usdc INT DEFAULT NULL, exchange_order_amount_usdt INT DEFAULT NULL, mixing_order_amount_eth INT DEFAULT NULL, mixing_order_amount_btc INT DEFAULT NULL, mixing_order_amount_usdc INT DEFAULT NULL, mixing_order_amount_usdt INT DEFAULT NULL, exchange_order_eth DOUBLE PRECISION DEFAULT NULL, exchange_order_btc DOUBLE PRECISION DEFAULT NULL, exchange_order_usdc DOUBLE PRECISION DEFAULT NULL, exchange_order_usdt DOUBLE PRECISION DEFAULT NULL, mixing_order_eth DOUBLE PRECISION DEFAULT NULL, mixing_order_btc DOUBLE PRECISION DEFAULT NULL, mixing_order_usdt DOUBLE PRECISION DEFAULT NULL, revenue_eth DOUBLE PRECISION DEFAULT NULL, revenue_btc DOUBLE PRECISION DEFAULT NULL, revenue_usdt DOUBLE PRECISION DEFAULT NULL, revenue_usdc DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE statistics');
    }
}
