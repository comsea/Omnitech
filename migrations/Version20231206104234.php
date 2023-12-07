<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206104234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD product_division_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEDAA0C96 FOREIGN KEY (product_division_id) REFERENCES product_division (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEDAA0C96 ON product (product_division_id)');
        $this->addSql('ALTER TABLE product_division ADD sub_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_division ADD CONSTRAINT FK_DBA72D83F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES product_sub_category (id)');
        $this->addSql('CREATE INDEX IDX_DBA72D83F7BFE87C ON product_division (sub_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEDAA0C96');
        $this->addSql('DROP INDEX IDX_D34A04ADEDAA0C96 ON product');
        $this->addSql('ALTER TABLE product DROP product_division_id');
        $this->addSql('ALTER TABLE product_division DROP FOREIGN KEY FK_DBA72D83F7BFE87C');
        $this->addSql('DROP INDEX IDX_DBA72D83F7BFE87C ON product_division');
        $this->addSql('ALTER TABLE product_division DROP sub_category_id');
    }
}
