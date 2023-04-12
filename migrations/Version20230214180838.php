<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214180838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency ADD id INT AUTO_INCREMENT NOT NULL, ADD balance DOUBLE PRECISION DEFAULT NULL, ADD currency VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE currency ADD CONSTRAINT FK_6956883FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE currency DROP FOREIGN KEY FK_6956883FF5B7AF75');
        $this->addSql('DROP INDEX `primary` ON currency');
        $this->addSql('ALTER TABLE currency DROP id, DROP balance, DROP currency');
    }
}
