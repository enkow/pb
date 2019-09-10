<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806170056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_comments ADD portal_user_id INT NOT NULL, ADD portal_post_id INT NOT NULL');
        $this->addSql('ALTER TABLE portal_comments ADD CONSTRAINT FK_3BF4FB32A6AB0B8C FOREIGN KEY (portal_user_id) REFERENCES portal_users (id)');
        $this->addSql('ALTER TABLE portal_comments ADD CONSTRAINT FK_3BF4FB324A4CDB35 FOREIGN KEY (portal_post_id) REFERENCES portal_posts (id)');
        $this->addSql('CREATE INDEX IDX_3BF4FB32A6AB0B8C ON portal_comments (portal_user_id)');
        $this->addSql('CREATE INDEX IDX_3BF4FB324A4CDB35 ON portal_comments (portal_post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_comments DROP FOREIGN KEY FK_3BF4FB32A6AB0B8C');
        $this->addSql('ALTER TABLE portal_comments DROP FOREIGN KEY FK_3BF4FB324A4CDB35');
        $this->addSql('DROP INDEX IDX_3BF4FB32A6AB0B8C ON portal_comments');
        $this->addSql('DROP INDEX IDX_3BF4FB324A4CDB35 ON portal_comments');
        $this->addSql('ALTER TABLE portal_comments DROP portal_user_id, DROP portal_post_id');
    }
}
