<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222113026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE input_transaction (id INT AUTO_INCREMENT NOT NULL, exorder_id INT DEFAULT NULL, mixorder_id INT DEFAULT NULL, number INT NOT NULL, hash VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, receiver VARCHAR(255) NOT NULL, sender VARCHAR(255) NOT NULL, output DOUBLE PRECISION NOT NULL, risk_is_low TINYINT(1) NOT NULL, INDEX IDX_87FD3994778274DE (exorder_id), INDEX IDX_87FD39947EF396F5 (mixorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE input_transaction ADD CONSTRAINT FK_87FD3994778274DE FOREIGN KEY (exorder_id) REFERENCES ex_order (id)');
        $this->addSql('ALTER TABLE input_transaction ADD CONSTRAINT FK_87FD39947EF396F5 FOREIGN KEY (mixorder_id) REFERENCES mix_order (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE input_transaction DROP FOREIGN KEY FK_87FD3994778274DE');
        $this->addSql('ALTER TABLE input_transaction DROP FOREIGN KEY FK_87FD39947EF396F5');
        $this->addSql('DROP TABLE input_transaction');
    }
}
