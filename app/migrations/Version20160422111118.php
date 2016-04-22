<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160422111118 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ck_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ck_product_has_categories (category_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_D071C86312469DE2 (category_id), INDEX IDX_D071C8634584665A (product_id), PRIMARY KEY(category_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ck_products (id INT AUTO_INCREMENT NOT NULL, tax_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, enabled TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F0C5B5C6B2A824D8 (tax_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ck_taxs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ck_product_has_categories ADD CONSTRAINT FK_D071C86312469DE2 FOREIGN KEY (category_id) REFERENCES ck_categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ck_product_has_categories ADD CONSTRAINT FK_D071C8634584665A FOREIGN KEY (product_id) REFERENCES ck_products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ck_products ADD CONSTRAINT FK_F0C5B5C6B2A824D8 FOREIGN KEY (tax_id) REFERENCES ck_taxs (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ck_product_has_categories DROP FOREIGN KEY FK_D071C86312469DE2');
        $this->addSql('ALTER TABLE ck_product_has_categories DROP FOREIGN KEY FK_D071C8634584665A');
        $this->addSql('ALTER TABLE ck_products DROP FOREIGN KEY FK_F0C5B5C6B2A824D8');
        $this->addSql('DROP TABLE ck_categories');
        $this->addSql('DROP TABLE ck_product_has_categories');
        $this->addSql('DROP TABLE ck_products');
        $this->addSql('DROP TABLE ck_taxs');
    }
}
