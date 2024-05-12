<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510225530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE product_catalog_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE order_order (ulid VARCHAR(26) NOT NULL, created_at DATE NOT NULL, status VARCHAR(255) NOT NULL, delivery_address VARCHAR(64) NOT NULL, delivery_type VARCHAR(255) NOT NULL, delivery_cost DOUBLE PRECISION NOT NULL, payment_type VARCHAR(255) NOT NULL, client_data_name VARCHAR(255) NOT NULL, client_data_phone_number VARCHAR(255) NOT NULL, client_data_email VARCHAR(255) NOT NULL, client_ulid_ulid VARCHAR(26) NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('COMMENT ON COLUMN order_order.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE order_order_item (ulid VARCHAR(26) NOT NULL, order_ulid VARCHAR(26) DEFAULT NULL, total_cost DOUBLE PRECISION NOT NULL, product_count INT NOT NULL, product_price DOUBLE PRECISION NOT NULL, product_name VARCHAR(64) NOT NULL, currency VARCHAR(3) NOT NULL, product_ulid_ulid VARCHAR(26) NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE INDEX IDX_E130E25C8F79F24E ON order_order_item (order_ulid)');
        $this->addSql('CREATE TABLE product_catalog_category (id INT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, title VARCHAR(64) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA17A323A977936C ON product_catalog_category (tree_root)');
        $this->addSql('CREATE INDEX IDX_BA17A323727ACA70 ON product_catalog_category (parent_id)');
        $this->addSql('CREATE TABLE product_catalog_characteristic (ulid VARCHAR(26) NOT NULL, product_ulid VARCHAR(26) DEFAULT NULL, name VARCHAR(64) NOT NULL, value VARCHAR(128) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE INDEX IDX_839C8CBB4F60EAF8 ON product_catalog_characteristic (product_ulid)');
        $this->addSql('COMMENT ON COLUMN product_catalog_characteristic.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_characteristic.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_catalog_discount (ulid VARCHAR(26) NOT NULL, discount DOUBLE PRECISION NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_ulid_ulid VARCHAR(26) NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE TABLE product_catalog_image (ulid VARCHAR(26) NOT NULL, product_ulid VARCHAR(26) DEFAULT NULL, url VARCHAR(128) NOT NULL, type VARCHAR(32) DEFAULT \'
                            additional
                        \' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE INDEX IDX_A6C379144F60EAF8 ON product_catalog_image (product_ulid)');
        $this->addSql('COMMENT ON COLUMN product_catalog_image.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_image.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_catalog_product (ulid VARCHAR(26) NOT NULL, name VARCHAR(64) NOT NULL, description VARCHAR(128) NOT NULL, price DOUBLE PRECISION NOT NULL, currency VARCHAR(255) NOT NULL, stock INT NOT NULL, category_id INT NOT NULL, is_active BOOLEAN DEFAULT true NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, user_ulid_ulid VARCHAR(26) NOT NULL, discount_ulid_ulid VARCHAR(26) DEFAULT NULL, PRIMARY KEY(ulid))');
        $this->addSql('COMMENT ON COLUMN product_catalog_product.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_product.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_catalog_review (ulid VARCHAR(26) NOT NULL, text VARCHAR(128) NOT NULL, rating INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, product_ulid_ulid VARCHAR(26) NOT NULL, user_ulid_ulid VARCHAR(26) NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('COMMENT ON COLUMN product_catalog_review.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_review.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE refresh_token (id INT NOT NULL, user_ulid VARCHAR(26) DEFAULT NULL, created_at DATE DEFAULT NULL, refresh_token VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C74F2195B8098490 ON refresh_token (user_ulid)');
        $this->addSql('COMMENT ON COLUMN refresh_token.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE user_user (ulid VARCHAR(26) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles TEXT NOT NULL, created_at DATE NOT NULL, email_email VARCHAR(255) NOT NULL, phone_phone VARCHAR(255) NOT NULL, name_name VARCHAR(255) NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A807ADF3DFB ON user_user (email_email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A80B715E2C7 ON user_user (phone_phone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A801995A471 ON user_user (name_name)');
        $this->addSql('COMMENT ON COLUMN user_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN user_user.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE order_order_item ADD CONSTRAINT FK_E130E25C8F79F24E FOREIGN KEY (order_ulid) REFERENCES order_order (ulid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_catalog_category ADD CONSTRAINT FK_BA17A323A977936C FOREIGN KEY (tree_root) REFERENCES product_catalog_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_catalog_category ADD CONSTRAINT FK_BA17A323727ACA70 FOREIGN KEY (parent_id) REFERENCES product_catalog_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_catalog_characteristic ADD CONSTRAINT FK_839C8CBB4F60EAF8 FOREIGN KEY (product_ulid) REFERENCES product_catalog_product (ulid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_catalog_image ADD CONSTRAINT FK_A6C379144F60EAF8 FOREIGN KEY (product_ulid) REFERENCES product_catalog_product (ulid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F2195B8098490 FOREIGN KEY (user_ulid) REFERENCES user_user (ulid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_catalog_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('ALTER TABLE order_order_item DROP CONSTRAINT FK_E130E25C8F79F24E');
        $this->addSql('ALTER TABLE product_catalog_category DROP CONSTRAINT FK_BA17A323A977936C');
        $this->addSql('ALTER TABLE product_catalog_category DROP CONSTRAINT FK_BA17A323727ACA70');
        $this->addSql('ALTER TABLE product_catalog_characteristic DROP CONSTRAINT FK_839C8CBB4F60EAF8');
        $this->addSql('ALTER TABLE product_catalog_image DROP CONSTRAINT FK_A6C379144F60EAF8');
        $this->addSql('ALTER TABLE refresh_token DROP CONSTRAINT FK_C74F2195B8098490');
        $this->addSql('DROP TABLE order_order');
        $this->addSql('DROP TABLE order_order_item');
        $this->addSql('DROP TABLE product_catalog_category');
        $this->addSql('DROP TABLE product_catalog_characteristic');
        $this->addSql('DROP TABLE product_catalog_discount');
        $this->addSql('DROP TABLE product_catalog_image');
        $this->addSql('DROP TABLE product_catalog_product');
        $this->addSql('DROP TABLE product_catalog_review');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE user_user');
    }
}
