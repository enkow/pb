<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806170718 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_marks ADD portal_post_id INT NOT NULL');
        $this->addSql('ALTER TABLE post_marks ADD CONSTRAINT FK_AB7176BC4A4CDB35 FOREIGN KEY (portal_post_id) REFERENCES portal_posts (id)');
        $this->addSql('CREATE INDEX IDX_AB7176BC4A4CDB35 ON post_marks (portal_post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_marks DROP FOREIGN KEY FK_AB7176BC4A4CDB35');
        $this->addSql('DROP INDEX IDX_AB7176BC4A4CDB35 ON post_marks');
        $this->addSql('ALTER TABLE post_marks DROP portal_post_id');
    }
}
