<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516095526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news_image (news_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_BF828301B5A459A0 (news_id), INDEX IDX_BF8283013DA5256D (image_id), PRIMARY KEY(news_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news_image ADD CONSTRAINT FK_BF828301B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_image ADD CONSTRAINT FK_BF8283013DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news_image DROP FOREIGN KEY FK_BF828301B5A459A0');
        $this->addSql('ALTER TABLE news_image DROP FOREIGN KEY FK_BF8283013DA5256D');
        $this->addSql('DROP TABLE news_image');
    }
}
