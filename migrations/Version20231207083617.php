<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207083617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_sub_division (id INT AUTO_INCREMENT NOT NULL, sub_division_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_271C8B26A47CE717 (sub_division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_sub_division ADD CONSTRAINT FK_271C8B26A47CE717 FOREIGN KEY (sub_division_id) REFERENCES product_division (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sub_division DROP FOREIGN KEY FK_271C8B26A47CE717');
        $this->addSql('DROP TABLE product_sub_division');
    }
}
