<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222113320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE output_transaction (id INT AUTO_INCREMENT NOT NULL, sender_wallet_id INT NOT NULL, exorder_id INT DEFAULT NULL, mixorder_id INT DEFAULT NULL, number INT NOT NULL, currency VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, receiver VARCHAR(255) NOT NULL, sender VARCHAR(255) NOT NULL, INDEX IDX_A8601EC22B2CC405 (sender_wallet_id), INDEX IDX_A8601EC2778274DE (exorder_id), INDEX IDX_A8601EC27EF396F5 (mixorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE output_transaction ADD CONSTRAINT FK_A8601EC22B2CC405 FOREIGN KEY (sender_wallet_id) REFERENCES wallets (id)');
        $this->addSql('ALTER TABLE output_transaction ADD CONSTRAINT FK_A8601EC2778274DE FOREIGN KEY (exorder_id) REFERENCES ex_order (id)');
        $this->addSql('ALTER TABLE output_transaction ADD CONSTRAINT FK_A8601EC27EF396F5 FOREIGN KEY (mixorder_id) REFERENCES mix_order (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE output_transaction DROP FOREIGN KEY FK_A8601EC22B2CC405');
        $this->addSql('ALTER TABLE output_transaction DROP FOREIGN KEY FK_A8601EC2778274DE');
        $this->addSql('ALTER TABLE output_transaction DROP FOREIGN KEY FK_A8601EC27EF396F5');
        $this->addSql('DROP TABLE output_transaction');
    }
}
