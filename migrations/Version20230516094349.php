<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516094349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_shop ADD article_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE work_shop ADD CONSTRAINT FK_55A9FD9A88C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id)');
        $this->addSql('CREATE INDEX IDX_55A9FD9A88C5F785 ON work_shop (article_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_shop DROP FOREIGN KEY FK_55A9FD9A88C5F785');
        $this->addSql('DROP INDEX IDX_55A9FD9A88C5F785 ON work_shop');
        $this->addSql('ALTER TABLE work_shop DROP article_category_id');
    }
}
