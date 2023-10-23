<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516090145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_contract_type (job_id INT NOT NULL, contract_type_id INT NOT NULL, INDEX IDX_4F75478DBE04EA9 (job_id), INDEX IDX_4F75478DCD1DF15B (contract_type_id), PRIMARY KEY(job_id, contract_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_contract_type ADD CONSTRAINT FK_4F75478DBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_contract_type ADD CONSTRAINT FK_4F75478DCD1DF15B FOREIGN KEY (contract_type_id) REFERENCES contract_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job ADD contract_sector_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8F30290F1 FOREIGN KEY (contract_sector_id) REFERENCES contract_sector (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8F30290F1 ON job (contract_sector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_contract_type DROP FOREIGN KEY FK_4F75478DBE04EA9');
        $this->addSql('ALTER TABLE job_contract_type DROP FOREIGN KEY FK_4F75478DCD1DF15B');
        $this->addSql('DROP TABLE job_contract_type');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8F30290F1');
        $this->addSql('DROP INDEX IDX_FBD8E0F8F30290F1 ON job');
        $this->addSql('ALTER TABLE job DROP contract_sector_id');
    }
}
