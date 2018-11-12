<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181119230438 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_12F75E06F47645AE ON app_shop_product (url)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4789DEFBF47645AE ON app_shop_category (url)');
        $this->addSql('ALTER TABLE app_partner_partner_address_translation ADD metro_station VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_partner_partner_address_translation DROP metro_station');
        $this->addSql('DROP INDEX UNIQ_4789DEFBF47645AE ON app_shop_category');
        $this->addSql('DROP INDEX UNIQ_12F75E06F47645AE ON app_shop_product');
    }
}
