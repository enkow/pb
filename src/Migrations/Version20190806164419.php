<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806164419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_posts ADD portal_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE portal_posts ADD CONSTRAINT FK_20B09368A6AB0B8C FOREIGN KEY (portal_user_id) REFERENCES portal_users (id)');
        $this->addSql('CREATE INDEX IDX_20B09368A6AB0B8C ON portal_posts (portal_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_posts DROP FOREIGN KEY FK_20B09368A6AB0B8C');
        $this->addSql('DROP INDEX IDX_20B09368A6AB0B8C ON portal_posts');
        $this->addSql('ALTER TABLE portal_posts DROP portal_user_id');
    }
}
