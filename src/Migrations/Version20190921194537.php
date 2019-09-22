<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190921194537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_article ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post_article ADD CONSTRAINT FK_3FD2B95512469DE2 FOREIGN KEY (category_id) REFERENCES post_category (id)');
        $this->addSql('CREATE INDEX IDX_3FD2B95512469DE2 ON post_article (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_article DROP FOREIGN KEY FK_3FD2B95512469DE2');
        $this->addSql('DROP INDEX IDX_3FD2B95512469DE2 ON post_article');
        $this->addSql('ALTER TABLE post_article DROP category_id');
    }
}
