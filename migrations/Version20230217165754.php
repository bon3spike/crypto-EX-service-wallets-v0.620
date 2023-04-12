<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217165754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ex_order (id INT AUTO_INCREMENT NOT NULL, address_of_service VARCHAR(100) NOT NULL, wallet_of_service INT NOT NULL, number INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status_id INT NOT NULL, currency_to_recieve VARCHAR(20) NOT NULL, currency_to_send VARCHAR(20) NOT NULL, amount_to_recieve DOUBLE PRECISION NOT NULL, amount_to_send DOUBLE PRECISION NOT NULL, sending_low_risk TINYINT(1) NOT NULL, recieve_btc_b TINYINT(1) NOT NULL, commission_persents DOUBLE PRECISION DEFAULT NULL, commission_of_risk_for_sending DOUBLE PRECISION DEFAULT NULL, commission_of_risk_of_recieving DOUBLE PRECISION DEFAULT NULL, comission_of_service DOUBLE PRECISION NOT NULL, letter_of_guarantee_uri VARCHAR(255) NOT NULL, address_of_user VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ex_order');
    }
}
