<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191225204621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE country_phone_code (calling_code INT NOT NULL, country_id INT NOT NULL, UNIQUE INDEX UNIQ_D916E0D7F92F3E70 (country_id), PRIMARY KEY(calling_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL, type_code VARCHAR(100) NOT NULL, calling_code INT NOT NULL, number VARCHAR(100) NOT NULL, object_id INT NOT NULL, INDEX IDX_444F97DDEA000C8B (object_code), INDEX IDX_444F97DDA01AF590 (type_code), INDEX IDX_444F97DD2901A375 (calling_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE country_phone_code ADD CONSTRAINT FK_D916E0D7F92F3E70 FOREIGN KEY (country_id) REFERENCES locality (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDEA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDA01AF590 FOREIGN KEY (type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD2901A375 FOREIGN KEY (calling_code) REFERENCES country_phone_code (calling_code)');
        $this->addSql('ALTER TABLE currency CHANGE symbol symbol VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE locality CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE code code VARCHAR(30) DEFAULT NULL, CHANGE iso2_code iso2_code VARCHAR(30) DEFAULT NULL, CHANGE iso3_code iso3_code VARCHAR(30) DEFAULT NULL, CHANGE longitude longitude NUMERIC(19, 8) DEFAULT NULL, CHANGE latitude latitude NUMERIC(18, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE master_parameter_value CHANGE parent_value_code parent_value_code VARCHAR(100) DEFAULT NULL, CHANGE rank rank INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parameter_value CHANGE parent_value_code parent_value_code VARCHAR(100) DEFAULT NULL, CHANGE rank rank INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parameter_value_translation RENAME INDEX idx_e24ff4acdefa6b41 TO IDX_1608E6F5DEFA6B41');
        $this->addSql('ALTER TABLE product CHANGE sub_type_code sub_type_code VARCHAR(100) DEFAULT NULL, CHANGE operator_id operator_id INT DEFAULT NULL, CHANGE group_code group_code VARCHAR(100) DEFAULT NULL, CHANGE sub_group_code sub_group_code VARCHAR(100) DEFAULT NULL, CHANGE external_reference external_reference VARCHAR(100) DEFAULT NULL, CHANGE duration_days duration_days INT DEFAULT NULL, CHANGE duration_nights duration_nights INT DEFAULT NULL, CHANGE duration_hours duration_hours INT DEFAULT NULL, CHANGE duration_minutes duration_minutes INT DEFAULT NULL, CHANGE child_min_age child_min_age INT DEFAULT NULL, CHANGE child_max_age child_max_age INT DEFAULT NULL, CHANGE baby_min_age baby_min_age INT DEFAULT NULL, CHANGE baby_max_age baby_max_age INT DEFAULT NULL, CHANGE call_price_before_discount call_price_before_discount INT DEFAULT NULL, CHANGE call_price call_price INT DEFAULT NULL, CHANGE discount_pourcentage discount_pourcentage NUMERIC(4, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE third_party CHANGE group_code group_code VARCHAR(100) DEFAULT NULL, CHANGE sub_group_code sub_group_code VARCHAR(100) DEFAULT NULL, CHANGE civility_code civility_code VARCHAR(100) DEFAULT NULL, CHANGE first_name first_name VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE third_party_id third_party_id INT DEFAULT NULL, CHANGE business_unit_code business_unit_code VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE login login VARCHAR(100) DEFAULT NULL, CHANGE password password VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD2901A375');
        $this->addSql('DROP TABLE country_phone_code');
        $this->addSql('DROP TABLE phone');
        $this->addSql('ALTER TABLE currency CHANGE symbol symbol VARCHAR(30) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE locality CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE code code VARCHAR(30) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE iso2_code iso2_code VARCHAR(30) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE iso3_code iso3_code VARCHAR(30) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE longitude longitude NUMERIC(19, 8) DEFAULT \'NULL\', CHANGE latitude latitude NUMERIC(18, 8) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE master_parameter_value CHANGE parent_value_code parent_value_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rank rank INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parameter_value CHANGE parent_value_code parent_value_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rank rank INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parameter_value_translation RENAME INDEX idx_1608e6f5defa6b41 TO IDX_E24FF4ACDEFA6B41');
        $this->addSql('ALTER TABLE product CHANGE sub_type_code sub_type_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE operator_id operator_id INT DEFAULT NULL, CHANGE group_code group_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE sub_group_code sub_group_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE external_reference external_reference VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE duration_days duration_days INT DEFAULT NULL, CHANGE duration_nights duration_nights INT DEFAULT NULL, CHANGE duration_hours duration_hours INT DEFAULT NULL, CHANGE duration_minutes duration_minutes INT DEFAULT NULL, CHANGE child_min_age child_min_age INT DEFAULT NULL, CHANGE child_max_age child_max_age INT DEFAULT NULL, CHANGE baby_min_age baby_min_age INT DEFAULT NULL, CHANGE baby_max_age baby_max_age INT DEFAULT NULL, CHANGE call_price_before_discount call_price_before_discount INT DEFAULT NULL, CHANGE call_price call_price INT DEFAULT NULL, CHANGE discount_pourcentage discount_pourcentage NUMERIC(4, 2) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE third_party CHANGE group_code group_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE sub_group_code sub_group_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE civility_code civility_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE first_name first_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE third_party_id third_party_id INT DEFAULT NULL, CHANGE business_unit_code business_unit_code VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE login login VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
