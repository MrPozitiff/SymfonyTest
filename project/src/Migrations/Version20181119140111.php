<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181119140111 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_admin_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, username_canonical VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, password_reset_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, email_verification_token VARCHAR(255) DEFAULT NULL, verified_at DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, credentials_expire_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', email VARCHAR(255) DEFAULT NULL, email_canonical VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, locale_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_client_customer (id INT AUTO_INCREMENT NOT NULL, default_address_id INT DEFAULT NULL, user_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL, gender VARCHAR(1) DEFAULT \'u\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, subscribed_to_newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F5059B45E7927C74 (email), UNIQUE INDEX UNIQ_F5059B45A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_F5059B45BD94FB16 (default_address_id), UNIQUE INDEX UNIQ_F5059B45A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_shop_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, username_canonical VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, password_reset_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, email_verification_token VARCHAR(255) DEFAULT NULL, verified_at DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, credentials_expire_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', email VARCHAR(255) DEFAULT NULL, email_canonical VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_client_customer_address (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, postcode VARCHAR(255) DEFAULT NULL, apartments VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, house VARCHAR(255) DEFAULT NULL, INDEX IDX_25AD2E2D9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_product (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, category_id INT DEFAULT NULL, address_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, partner_price DOUBLE PRECISION NOT NULL, storage_count INT NOT NULL, storage_limited TINYINT(1) NOT NULL, purchased_count INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, enabled TINYINT(1) DEFAULT \'0\' NOT NULL, slug VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_12F75E06F47645AE (url), INDEX IDX_12F75E069393F8FE (partner_id), INDEX IDX_12F75E0612469DE2 (category_id), INDEX IDX_12F75E06F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_product_option (product_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_F6E5A8D74584665A (product_id), INDEX IDX_F6E5A8D7A7C41D6F (option_id), PRIMARY KEY(product_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_option_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_E11057352C2AC5D3 (translatable_id), UNIQUE INDEX app_shop_option_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_product_image (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_1A6C23747E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_product_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_5F8759442C2AC5D3 (translatable_id), UNIQUE INDEX app_shop_product_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_category_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_220132332C2AC5D3 (translatable_id), UNIQUE INDEX app_shop_category_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, statistics_id INT DEFAULT NULL, position INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, enabled TINYINT(1) DEFAULT \'0\' NOT NULL, slug VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_4789DEFBF47645AE (url), INDEX IDX_4789DEFB727ACA70 (parent_id), UNIQUE INDEX UNIQ_4789DEFB9A2595B2 (statistics_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_option (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, enabled TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_category_image (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_E311A2D57E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_category_statistics (id INT AUTO_INCREMENT NOT NULL, total_products_count INT NOT NULL, min_product_price DOUBLE PRECISION DEFAULT NULL, max_product_price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner_address_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, city_area VARCHAR(255) DEFAULT NULL, office VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, house VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_DDC97B722C2AC5D3 (translatable_id), UNIQUE INDEX app_partner_partner_address_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner (id INT AUTO_INCREMENT NOT NULL, enabled TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner_address_partner (partner_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_A5B920469393F8FE (partner_id), INDEX IDX_A5B92046F5B7AF75 (address_id), PRIMARY KEY(partner_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner_address (id INT AUTO_INCREMENT NOT NULL, postcode VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner_image (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_82A582847E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_FF17BEBF2C2AC5D3 (translatable_id), UNIQUE INDEX app_partner_partner_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_partner_partner_user (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, username_canonical VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, password_reset_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, email_verification_token VARCHAR(255) DEFAULT NULL, verified_at DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, credentials_expire_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', email VARCHAR(255) DEFAULT NULL, email_canonical VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_A7DA72A79393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_user_oauth (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, provider VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, access_token VARCHAR(255) DEFAULT NULL, refresh_token VARCHAR(255) DEFAULT NULL, INDEX IDX_C3471B78A76ED395 (user_id), UNIQUE INDEX user_provider (user_id, provider), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_customer_group (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7FCF9B0577153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_customer (id INT AUTO_INCREMENT NOT NULL, customer_group_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL, gender VARCHAR(1) DEFAULT \'u\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, subscribed_to_newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_7E82D5E6E7927C74 (email), UNIQUE INDEX UNIQ_7E82D5E6A0D96FBF (email_canonical), INDEX IDX_7E82D5E6D2919A68 (customer_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_client_customer ADD CONSTRAINT FK_F5059B45BD94FB16 FOREIGN KEY (default_address_id) REFERENCES app_client_customer_address (id)');
        $this->addSql('ALTER TABLE app_client_customer ADD CONSTRAINT FK_F5059B45A76ED395 FOREIGN KEY (user_id) REFERENCES app_shop_shop_user (id)');
        $this->addSql('ALTER TABLE app_client_customer_address ADD CONSTRAINT FK_25AD2E2D9395C3F3 FOREIGN KEY (customer_id) REFERENCES app_client_customer (id)');
        $this->addSql('ALTER TABLE app_shop_product ADD CONSTRAINT FK_12F75E069393F8FE FOREIGN KEY (partner_id) REFERENCES app_partner_partner (id)');
        $this->addSql('ALTER TABLE app_shop_product ADD CONSTRAINT FK_12F75E0612469DE2 FOREIGN KEY (category_id) REFERENCES app_shop_category (id)');
        $this->addSql('ALTER TABLE app_shop_product ADD CONSTRAINT FK_12F75E06F5B7AF75 FOREIGN KEY (address_id) REFERENCES app_partner_partner_address (id)');
        $this->addSql('ALTER TABLE app_shop_product_option ADD CONSTRAINT FK_F6E5A8D74584665A FOREIGN KEY (product_id) REFERENCES app_shop_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_product_option ADD CONSTRAINT FK_F6E5A8D7A7C41D6F FOREIGN KEY (option_id) REFERENCES app_shop_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_option_translation ADD CONSTRAINT FK_E11057352C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_shop_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_product_image ADD CONSTRAINT FK_1A6C23747E3C61F9 FOREIGN KEY (owner_id) REFERENCES app_shop_product (id)');
        $this->addSql('ALTER TABLE app_shop_product_translation ADD CONSTRAINT FK_5F8759442C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_shop_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_category_translation ADD CONSTRAINT FK_220132332C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_shop_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_category ADD CONSTRAINT FK_4789DEFB727ACA70 FOREIGN KEY (parent_id) REFERENCES app_shop_category (id)');
        $this->addSql('ALTER TABLE app_shop_category ADD CONSTRAINT FK_4789DEFB9A2595B2 FOREIGN KEY (statistics_id) REFERENCES app_shop_category_statistics (id)');
        $this->addSql('ALTER TABLE app_shop_category_image ADD CONSTRAINT FK_E311A2D57E3C61F9 FOREIGN KEY (owner_id) REFERENCES app_shop_category (id)');
        $this->addSql('ALTER TABLE app_partner_partner_address_translation ADD CONSTRAINT FK_DDC97B722C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_partner_partner_address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_partner_partner_address_partner ADD CONSTRAINT FK_A5B920469393F8FE FOREIGN KEY (partner_id) REFERENCES app_partner_partner (id)');
        $this->addSql('ALTER TABLE app_partner_partner_address_partner ADD CONSTRAINT FK_A5B92046F5B7AF75 FOREIGN KEY (address_id) REFERENCES app_partner_partner_address (id)');
        $this->addSql('ALTER TABLE app_partner_partner_image ADD CONSTRAINT FK_82A582847E3C61F9 FOREIGN KEY (owner_id) REFERENCES app_partner_partner (id)');
        $this->addSql('ALTER TABLE app_partner_partner_translation ADD CONSTRAINT FK_FF17BEBF2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_partner_partner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_partner_partner_user ADD CONSTRAINT FK_A7DA72A79393F8FE FOREIGN KEY (partner_id) REFERENCES app_partner_partner (id)');
        $this->addSql('ALTER TABLE sylius_user_oauth ADD CONSTRAINT FK_C3471B78A76ED395 FOREIGN KEY (user_id) REFERENCES app_shop_shop_user (id)');
        $this->addSql('ALTER TABLE sylius_customer ADD CONSTRAINT FK_7E82D5E6D2919A68 FOREIGN KEY (customer_group_id) REFERENCES sylius_customer_group (id)');
        $this->addSql('INSERT INTO app_shop_category (slug, enabled) VALUES ("root", 1)');
        $this->addSql('INSERT INTO app_shop_category_translation (translatable_id, locale, name) VALUES (1, "en", "Root Category")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_client_customer_address DROP FOREIGN KEY FK_25AD2E2D9395C3F3');
        $this->addSql('ALTER TABLE app_client_customer DROP FOREIGN KEY FK_F5059B45A76ED395');
        $this->addSql('ALTER TABLE sylius_user_oauth DROP FOREIGN KEY FK_C3471B78A76ED395');
        $this->addSql('ALTER TABLE app_client_customer DROP FOREIGN KEY FK_F5059B45BD94FB16');
        $this->addSql('ALTER TABLE app_shop_product_option DROP FOREIGN KEY FK_F6E5A8D74584665A');
        $this->addSql('ALTER TABLE app_shop_product_image DROP FOREIGN KEY FK_1A6C23747E3C61F9');
        $this->addSql('ALTER TABLE app_shop_product_translation DROP FOREIGN KEY FK_5F8759442C2AC5D3');
        $this->addSql('ALTER TABLE app_shop_product DROP FOREIGN KEY FK_12F75E0612469DE2');
        $this->addSql('ALTER TABLE app_shop_category_translation DROP FOREIGN KEY FK_220132332C2AC5D3');
        $this->addSql('ALTER TABLE app_shop_category DROP FOREIGN KEY FK_4789DEFB727ACA70');
        $this->addSql('ALTER TABLE app_shop_category_image DROP FOREIGN KEY FK_E311A2D57E3C61F9');
        $this->addSql('ALTER TABLE app_shop_product_option DROP FOREIGN KEY FK_F6E5A8D7A7C41D6F');
        $this->addSql('ALTER TABLE app_shop_option_translation DROP FOREIGN KEY FK_E11057352C2AC5D3');
        $this->addSql('ALTER TABLE app_shop_category DROP FOREIGN KEY FK_4789DEFB9A2595B2');
        $this->addSql('ALTER TABLE app_shop_product DROP FOREIGN KEY FK_12F75E069393F8FE');
        $this->addSql('ALTER TABLE app_partner_partner_address_partner DROP FOREIGN KEY FK_A5B920469393F8FE');
        $this->addSql('ALTER TABLE app_partner_partner_image DROP FOREIGN KEY FK_82A582847E3C61F9');
        $this->addSql('ALTER TABLE app_partner_partner_translation DROP FOREIGN KEY FK_FF17BEBF2C2AC5D3');
        $this->addSql('ALTER TABLE app_partner_partner_user DROP FOREIGN KEY FK_A7DA72A79393F8FE');
        $this->addSql('ALTER TABLE app_shop_product DROP FOREIGN KEY FK_12F75E06F5B7AF75');
        $this->addSql('ALTER TABLE app_partner_partner_address_translation DROP FOREIGN KEY FK_DDC97B722C2AC5D3');
        $this->addSql('ALTER TABLE app_partner_partner_address_partner DROP FOREIGN KEY FK_A5B92046F5B7AF75');
        $this->addSql('ALTER TABLE sylius_customer DROP FOREIGN KEY FK_7E82D5E6D2919A68');
        $this->addSql('DROP TABLE app_admin_user');
        $this->addSql('DROP TABLE app_client_customer');
        $this->addSql('DROP TABLE app_shop_shop_user');
        $this->addSql('DROP TABLE app_client_customer_address');
        $this->addSql('DROP TABLE app_shop_product');
        $this->addSql('DROP TABLE app_shop_product_option');
        $this->addSql('DROP TABLE app_shop_option_translation');
        $this->addSql('DROP TABLE app_shop_product_image');
        $this->addSql('DROP TABLE app_shop_product_translation');
        $this->addSql('DROP TABLE app_shop_category_translation');
        $this->addSql('DROP TABLE app_shop_category');
        $this->addSql('DROP TABLE app_shop_option');
        $this->addSql('DROP TABLE app_shop_category_image');
        $this->addSql('DROP TABLE app_shop_category_statistics');
        $this->addSql('DROP TABLE app_partner_partner_address_translation');
        $this->addSql('DROP TABLE app_partner_partner');
        $this->addSql('DROP TABLE app_partner_partner_address_partner');
        $this->addSql('DROP TABLE app_partner_partner_address');
        $this->addSql('DROP TABLE app_partner_partner_image');
        $this->addSql('DROP TABLE app_partner_partner_translation');
        $this->addSql('DROP TABLE app_partner_partner_user');
        $this->addSql('DROP TABLE sylius_user_oauth');
        $this->addSql('DROP TABLE sylius_customer_group');
        $this->addSql('DROP TABLE sylius_customer');
    }
}
