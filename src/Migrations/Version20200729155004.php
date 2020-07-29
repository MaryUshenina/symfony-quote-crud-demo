<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Quote;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729155004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('Update quotes SET `type` = ?', [Quote::TYPE_OTHER]);
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quotes CHANGE type type INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quotes CHANGE type type VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('Update quotes SET `type` = ?', ['other']);
    }
}
