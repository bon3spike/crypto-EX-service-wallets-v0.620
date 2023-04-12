<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223111118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address_mixing (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, mixorder_id INT NOT NULL, number INT NOT NULL, address VARCHAR(255) NOT NULL, percentage INT NOT NULL, delay TIME NOT NULL, wallets_ids VARCHAR(255) NOT NULL, INDEX IDX_6BF6E7AA712520F3 (wallet_id), INDEX IDX_6BF6E7AA7EF396F5 (mixorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mixing_code (id INT AUTO_INCREMENT NOT NULL, mixorder_id INT NOT NULL, mixing_code VARCHAR(10) NOT NULL, wallet_ids VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7B8020F07EF396F5 (mixorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address_mixing ADD CONSTRAINT FK_6BF6E7AA712520F3 FOREIGN KEY (wallet_id) REFERENCES wallets (id)');
        $this->addSql('ALTER TABLE address_mixing ADD CONSTRAINT FK_6BF6E7AA7EF396F5 FOREIGN KEY (mixorder_id) REFERENCES mix_order (id)');
        $this->addSql('ALTER TABLE mixing_code ADD CONSTRAINT FK_7B8020F07EF396F5 FOREIGN KEY (mixorder_id) REFERENCES mix_order (id)');
        $this->addSql('ALTER TABLE addresses_mixing DROP FOREIGN KEY FK_369DA73F712520F3');
        $this->addSql('DROP TABLE addresses_mixing');
        $this->addSql('DROP TABLE mixing_codes');
        $this->addSql('ALTER TABLE mix_order ADD wallet_of_service INT NOT NULL, ADD address_of_user VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses_mixing (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, percentage INT NOT NULL, delay TIME NOT NULL, INDEX IDX_369DA73F712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mixing_codes (id INT AUTO_INCREMENT NOT NULL, mixing_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, wallet_ids VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE addresses_mixing ADD CONSTRAINT FK_369DA73F712520F3 FOREIGN KEY (wallet_id) REFERENCES wallets (id)');
        $this->addSql('ALTER TABLE address_mixing DROP FOREIGN KEY FK_6BF6E7AA712520F3');
        $this->addSql('ALTER TABLE address_mixing DROP FOREIGN KEY FK_6BF6E7AA7EF396F5');
        $this->addSql('ALTER TABLE mixing_code DROP FOREIGN KEY FK_7B8020F07EF396F5');
        $this->addSql('DROP TABLE address_mixing');
        $this->addSql('DROP TABLE mixing_code');
        $this->addSql('ALTER TABLE mix_order DROP wallet_of_service, DROP address_of_user');
    }
}
