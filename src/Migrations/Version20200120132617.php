<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200120132617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE merchant_id merchant_id INT DEFAULT NULL, CHANGE seller_id seller_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE images images JSON NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7613FECDF');
        $this->addSql('ALTER TABLE cart ADD session_time DATE NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7613FECDF FOREIGN KEY (session_id) REFERENCES cart_item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7613FECDF');
        $this->addSql('ALTER TABLE cart DROP session_time');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7613FECDF FOREIGN KEY (session_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE images images LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE user CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE merchant_id merchant_id INT DEFAULT NULL, CHANGE seller_id seller_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
