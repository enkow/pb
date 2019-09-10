<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806170444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_photos ADD portal_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE portal_photos ADD CONSTRAINT FK_16DFFF98A6AB0B8C FOREIGN KEY (portal_user_id) REFERENCES portal_users (id)');
        $this->addSql('CREATE INDEX IDX_16DFFF98A6AB0B8C ON portal_photos (portal_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portal_photos DROP FOREIGN KEY FK_16DFFF98A6AB0B8C');
        $this->addSql('DROP INDEX IDX_16DFFF98A6AB0B8C ON portal_photos');
        $this->addSql('ALTER TABLE portal_photos DROP portal_user_id');
    }
}
