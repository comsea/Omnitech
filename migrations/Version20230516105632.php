<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516105632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE work_shop_image (work_shop_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_1948F3DE98DD7CFF (work_shop_id), INDEX IDX_1948F3DE3DA5256D (image_id), PRIMARY KEY(work_shop_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_shop_supplier (work_shop_id INT NOT NULL, supplier_id INT NOT NULL, INDEX IDX_4FEFDC98DD7CFF (work_shop_id), INDEX IDX_4FEFDC2ADD6D8C (supplier_id), PRIMARY KEY(work_shop_id, supplier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_shop_image ADD CONSTRAINT FK_1948F3DE98DD7CFF FOREIGN KEY (work_shop_id) REFERENCES work_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_shop_image ADD CONSTRAINT FK_1948F3DE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_shop_supplier ADD CONSTRAINT FK_4FEFDC98DD7CFF FOREIGN KEY (work_shop_id) REFERENCES work_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_shop_supplier ADD CONSTRAINT FK_4FEFDC2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_shop_image DROP FOREIGN KEY FK_1948F3DE98DD7CFF');
        $this->addSql('ALTER TABLE work_shop_image DROP FOREIGN KEY FK_1948F3DE3DA5256D');
        $this->addSql('ALTER TABLE work_shop_supplier DROP FOREIGN KEY FK_4FEFDC98DD7CFF');
        $this->addSql('ALTER TABLE work_shop_supplier DROP FOREIGN KEY FK_4FEFDC2ADD6D8C');
        $this->addSql('DROP TABLE work_shop_image');
        $this->addSql('DROP TABLE work_shop_supplier');
    }
}
