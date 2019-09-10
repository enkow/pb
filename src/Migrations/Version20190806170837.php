<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806170837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_marks ADD portal_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE post_marks ADD CONSTRAINT FK_AB7176BCA6AB0B8C FOREIGN KEY (portal_user_id) REFERENCES portal_users (id)');
        $this->addSql('CREATE INDEX IDX_AB7176BCA6AB0B8C ON post_marks (portal_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_marks DROP FOREIGN KEY FK_AB7176BCA6AB0B8C');
        $this->addSql('DROP INDEX IDX_AB7176BCA6AB0B8C ON post_marks');
        $this->addSql('ALTER TABLE post_marks DROP portal_user_id');
    }
}
