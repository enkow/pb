<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902135921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_friends ADD portal_user_1_id INT NOT NULL, ADD portal_user_2_id INT NOT NULL');
        $this->addSql('ALTER TABLE portal_friends ADD CONSTRAINT FK_202BA870995AE208 FOREIGN KEY (portal_user_1_id) REFERENCES portal_users (id)');
        $this->addSql('ALTER TABLE portal_friends ADD CONSTRAINT FK_202BA8708BEF4DE6 FOREIGN KEY (portal_user_2_id) REFERENCES portal_users (id)');
        $this->addSql('CREATE INDEX IDX_202BA870995AE208 ON portal_friends (portal_user_1_id)');
        $this->addSql('CREATE INDEX IDX_202BA8708BEF4DE6 ON portal_friends (portal_user_2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_friends DROP FOREIGN KEY FK_202BA870995AE208');
        $this->addSql('ALTER TABLE portal_friends DROP FOREIGN KEY FK_202BA8708BEF4DE6');
        $this->addSql('DROP INDEX IDX_202BA870995AE208 ON portal_friends');
        $this->addSql('DROP INDEX IDX_202BA8708BEF4DE6 ON portal_friends');
        $this->addSql('ALTER TABLE portal_friends DROP portal_user_1_id, DROP portal_user_2_id');
    }
}
