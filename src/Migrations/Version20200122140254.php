<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122140254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE business_object DROP FOREIGN KEY FK_F30DE416EA000C8B');
        $this->addSql('ALTER TABLE master_code_translation DROP FOREIGN KEY FK_6DA0649577153098');
        $this->addSql('ALTER TABLE master_parameter_value DROP FOREIGN KEY FK_5A6779B7D81B339D');
        $this->addSql('ALTER TABLE master_parameter_value DROP FOREIGN KEY FK_5A6779B7DEFA6B41');
        $this->addSql('ALTER TABLE tenant_excluded_master_code DROP FOREIGN KEY FK_4A649F2677153098');
        $this->addSql('ALTER TABLE tenant_parameter_value DROP FOREIGN KEY FK_6EBEAAD3D81B339D');
        $this->addSql('ALTER TABLE object_media DROP FOREIGN KEY FK_EE0FF5EEEA9FDD75');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C44FB371E');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CFE54D947');
        $this->addSql('ALTER TABLE object_detail DROP FOREIGN KEY FK_6086DF93FE54D947');
        $this->addSql('ALTER TABLE object_tag DROP FOREIGN KEY FK_C4C20B06BAD26311');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44FB371E');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADFE54D947');
        $this->addSql('ALTER TABLE tenant_parameter_value DROP FOREIGN KEY FK_6EBEAAD366ED1773');
        $this->addSql('ALTER TABLE tenant_parameter_value_translation DROP FOREIGN KEY FK_D6BA13FDF920BBA2');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E2244FB371E');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E22FE54D947');
        $this->addSql('CREATE TABLE master_parameter_value_translation (value_code VARCHAR(100) NOT NULL, locale VARCHAR(2) NOT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_BB8AFF6DDEFA6B41 (value_code), PRIMARY KEY(value_code, locale)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_value_translation (value_code VARCHAR(100) NOT NULL, locale VARCHAR(2) NOT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_1608E6F5DEFA6B41 (value_code), PRIMARY KEY(value_code, locale)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_value (value_code VARCHAR(100) NOT NULL, object_code VARCHAR(100) NOT NULL, parameter_code VARCHAR(100) NOT NULL, parent_value_code VARCHAR(100) DEFAULT NULL, rank INT DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_6DB2A2B8EA000C8B (object_code), INDEX IDX_6DB2A2B8D81B339D (parameter_code), INDEX IDX_6DB2A2B899B9EF11 (parent_value_code), PRIMARY KEY(value_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL, type_code VARCHAR(100) NOT NULL, calling_code INT NOT NULL, number VARCHAR(100) NOT NULL, object_id INT NOT NULL, INDEX IDX_444F97DDEA000C8B (object_code), INDEX IDX_444F97DDA01AF590 (type_code), INDEX IDX_444F97DD2901A375 (calling_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter (code VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, master TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE master_parameter_value_translation ADD CONSTRAINT FK_BB8AFF6DDEFA6B41 FOREIGN KEY (value_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE parameter_value_translation ADD CONSTRAINT FK_1608E6F5DEFA6B41 FOREIGN KEY (value_code) REFERENCES parameter_value (value_code)');
        $this->addSql('ALTER TABLE parameter_value ADD CONSTRAINT FK_6DB2A2B8EA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE parameter_value ADD CONSTRAINT FK_6DB2A2B8D81B339D FOREIGN KEY (parameter_code) REFERENCES parameter (code)');
        $this->addSql('ALTER TABLE parameter_value ADD CONSTRAINT FK_6DB2A2B899B9EF11 FOREIGN KEY (parent_value_code) REFERENCES parameter_value (value_code)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDEA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDA01AF590 FOREIGN KEY (type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD2901A375 FOREIGN KEY (calling_code) REFERENCES country_phone_code (calling_code)');
        $this->addSql('DROP TABLE airline');
        $this->addSql('DROP TABLE master_code');
        $this->addSql('DROP TABLE master_code_translation');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE object_address');
        $this->addSql('DROP TABLE object_detail');
        $this->addSql('DROP TABLE object_media');
        $this->addSql('DROP TABLE object_phone');
        $this->addSql('DROP TABLE object_tag');
        $this->addSql('DROP TABLE product_locality');
        $this->addSql('DROP TABLE tenant_excluded_master_code');
        $this->addSql('DROP TABLE tenant_locality');
        $this->addSql('DROP TABLE tenant_parameter_value');
        $this->addSql('DROP TABLE tenant_parameter_value_translation');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499033212A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A01AF590');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6499033212A ON user');
        $this->addSql('DROP INDEX IDX_8D93D649A01AF590 ON user');
        $this->addSql('ALTER TABLE user ADD login VARCHAR(100) DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP tenant_id, DROP type_code, DROP username, DROP roles, CHANGE password password VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE locality CHANGE code code VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE master_parameter_value DROP FOREIGN KEY FK_5A6779B7D81B339D');
        $this->addSql('ALTER TABLE master_parameter_value CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE master_parameter_value ADD CONSTRAINT FK_5A6779B7D81B339D FOREIGN KEY (parameter_code) REFERENCES parameter (code)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9033212A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE1ECE19');
        $this->addSql('DROP INDEX IDX_D34A04ADFE54D947 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADE1ECE19 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD44FB371E ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD9033212A ON product');
        $this->addSql('ALTER TABLE product ADD operator_id INT DEFAULT NULL, ADD group_code VARCHAR(100) DEFAULT NULL, ADD sub_group_code VARCHAR(100) DEFAULT NULL, ADD child_min_age INT DEFAULT NULL, ADD child_max_age INT DEFAULT NULL, ADD baby_min_age INT DEFAULT NULL, ADD baby_max_age INT DEFAULT NULL, ADD call_price_before_discount INT DEFAULT NULL, ADD call_price INT DEFAULT NULL, ADD discount_pourcentage NUMERIC(4, 2) DEFAULT NULL, DROP tenant_id, DROP external_system_code, DROP group_id, DROP sub_group_id, DROP producer_reference, DROP vat_percentage, DROP longitude, DROP latitude, DROP departure_time, DROP arrival_time, DROP arrival_day_plus, DROP stars, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD584598A3 FOREIGN KEY (operator_id) REFERENCES third_party (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5E4F6BE8 FOREIGN KEY (group_code) REFERENCES parameter_value (value_code)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD7284F825 FOREIGN KEY (sub_group_code) REFERENCES parameter_value (value_code)');
        $this->addSql('CREATE INDEX IDX_D34A04AD584598A3 ON product (operator_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD5E4F6BE8 ON product (group_code)');
        $this->addSql('CREATE INDEX IDX_D34A04AD7284F825 ON product (sub_group_code)');
        $this->addSql('ALTER TABLE business_object ADD name VARCHAR(100) NOT NULL, DROP has_group, DROP has_file, DROP has_media, DROP has_comment, DROP has_member, DROP has_tag, DROP has_address, DROP has_phone, DROP table_name, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE locality_translation MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_D776A4F988823A92 ON locality_translation');
        $this->addSql('ALTER TABLE locality_translation DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE locality_translation DROP id');
        $this->addSql('ALTER TABLE locality_translation ADD PRIMARY KEY (locality_id)');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E229033212A');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E22A01AF590');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E22B217B32E');
        $this->addSql('DROP INDEX uniq_name_tenant ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E22B217B32E ON third_party');
        $this->addSql('DROP INDEX uniq_accounting_reference_tenant ON third_party');
        $this->addSql('DROP INDEX uniq_vat_reference_tenant ON third_party');
        $this->addSql('DROP INDEX uniq_company_reference_tenant ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E2244FB371E ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E22A01AF590 ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E229033212A ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E22FE54D947 ON third_party');
        $this->addSql('ALTER TABLE third_party ADD relation_type_code VARCHAR(100) NOT NULL, ADD group_code VARCHAR(100) DEFAULT NULL, ADD sub_group_code VARCHAR(100) DEFAULT NULL, ADD organization TINYINT(1) DEFAULT \'1\' NOT NULL, ADD operator TINYINT(1) DEFAULT \'0\' NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP tenant_id, DROP type_code, DROP sub_type_code, DROP group_id, DROP sub_group_id, DROP accounting_reference, DROP company_reference, DROP vat_reference, DROP web_site, DROP language_code');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E226587D514 FOREIGN KEY (relation_type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E225E4F6BE8 FOREIGN KEY (group_code) REFERENCES parameter_value (value_code)');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E227284F825 FOREIGN KEY (sub_group_code) REFERENCES parameter_value (value_code)');
        $this->addSql('CREATE INDEX IDX_346F1E226587D514 ON third_party (relation_type_code)');
        $this->addSql('CREATE INDEX IDX_346F1E225E4F6BE8 ON third_party (group_code)');
        $this->addSql('CREATE INDEX IDX_346F1E227284F825 ON third_party (sub_group_code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5E4F6BE8');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD7284F825');
        $this->addSql('ALTER TABLE parameter_value_translation DROP FOREIGN KEY FK_1608E6F5DEFA6B41');
        $this->addSql('ALTER TABLE parameter_value DROP FOREIGN KEY FK_6DB2A2B899B9EF11');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E225E4F6BE8');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E227284F825');
        $this->addSql('ALTER TABLE master_parameter_value DROP FOREIGN KEY FK_5A6779B7D81B339D');
        $this->addSql('ALTER TABLE parameter_value DROP FOREIGN KEY FK_6DB2A2B8D81B339D');
        $this->addSql('CREATE TABLE airline (code VARCHAR(2) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE master_code (code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, is_master_parameter TINYINT(1) DEFAULT \'0\' NOT NULL, is_tenant_parameter TINYINT(1) DEFAULT \'0\' NOT NULL, is_master_parameter_value TINYINT(1) DEFAULT \'0\' NOT NULL, is_business_object TINYINT(1) DEFAULT \'0\' NOT NULL, is_attribute TINYINT(1) DEFAULT \'0\' NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE master_code_translation (code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, locale VARCHAR(2) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_6DA0649577153098 (code), PRIMARY KEY(code, locale)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, tenant_id INT NOT NULL, type_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, group_id INT DEFAULT NULL, sub_group_id INT DEFAULT NULL, url VARCHAR(400) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX uniq_MediaTenant (url, tenant_id), INDEX IDX_6A2CA10CFE54D947 (group_id), INDEX IDX_6A2CA10CA01AF590 (type_code), INDEX IDX_6A2CA10C44FB371E (sub_group_id), INDEX IDX_6A2CA10C9033212A (tenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE object_address (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, country_id INT NOT NULL, object_id INT NOT NULL, name VARCHAR(400) NOT NULL COLLATE utf8mb4_unicode_ci, city_name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, zip_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, billing TINYINT(1) DEFAULT \'1\' NOT NULL, shipping TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_D00EF21EA000C8B (object_code), INDEX IDX_D00EF21F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE object_detail (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, group_id INT DEFAULT NULL, locale_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, object_id INT NOT NULL, title VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, text LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_6086DF93EA000C8B (object_code), INDEX IDX_6086DF939037F84C (locale_code), INDEX IDX_6086DF93FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE object_media (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, media_id INT NOT NULL, object_id INT NOT NULL, rank INT DEFAULT NULL, UNIQUE INDEX uniq_tenant_media_object (media_id, object_id, object_code), INDEX IDX_EE0FF5EEEA9FDD75 (media_id), INDEX IDX_EE0FF5EEEA000C8B (object_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE object_phone (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, type_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, calling_code INT DEFAULT NULL, number VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, object_id INT NOT NULL, INDEX IDX_C06CC33FEA000C8B (object_code), INDEX IDX_C06CC33F2901A375 (calling_code), INDEX IDX_C06CC33FA01AF590 (type_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE object_tag (id INT AUTO_INCREMENT NOT NULL, object_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, tag_id INT NOT NULL, object_id INT NOT NULL, rank INT DEFAULT NULL, UNIQUE INDEX uniq_tenant_tag_object (tag_id, object_id, object_code), INDEX IDX_C4C20B06BAD26311 (tag_id), INDEX IDX_C4C20B06EA000C8B (object_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_locality (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, locality_id INT NOT NULL, role_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_2A66D2714584665A (product_id), INDEX IDX_2A66D271C9AA420C (role_code), INDEX IDX_2A66D27188823A92 (locality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tenant_excluded_master_code (id INT AUTO_INCREMENT NOT NULL, tenant_id INT NOT NULL, code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX uniq_tenant_excluded_code (tenant_id, code), INDEX IDX_4A649F269033212A (tenant_id), INDEX IDX_4A649F2677153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tenant_locality (id INT AUTO_INCREMENT NOT NULL, tenant_id INT NOT NULL, locality_id INT NOT NULL, UNIQUE INDEX uniq_tenant_locality (tenant_id, locality_id), INDEX IDX_C070DA119033212A (tenant_id), INDEX IDX_C070DA1188823A92 (locality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tenant_parameter_value (id INT AUTO_INCREMENT NOT NULL, tenant_id INT NOT NULL, parameter_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, object_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, parent_value_id INT DEFAULT NULL, value_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, rank INT DEFAULT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, public TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX uniq_parameterValueTenant (value_code, tenant_id), INDEX IDX_6EBEAAD39033212A (tenant_id), INDEX IDX_6EBEAAD3EA000C8B (object_code), INDEX IDX_6EBEAAD3D81B339D (parameter_code), INDEX IDX_6EBEAAD366ED1773 (parent_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tenant_parameter_value_translation (id INT AUTO_INCREMENT NOT NULL, value_id INT DEFAULT NULL, locale VARCHAR(2) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX uniq_tenant_parameter_value_name (value_id, locale), INDEX IDX_D6BA13FDF920BBA2 (value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE master_code_translation ADD CONSTRAINT FK_6DA0649577153098 FOREIGN KEY (code) REFERENCES master_code (code)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C44FB371E FOREIGN KEY (sub_group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C9033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA01AF590 FOREIGN KEY (type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CFE54D947 FOREIGN KEY (group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE object_address ADD CONSTRAINT FK_D00EF21EA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE object_address ADD CONSTRAINT FK_D00EF21F92F3E70 FOREIGN KEY (country_id) REFERENCES locality (id)');
        $this->addSql('ALTER TABLE object_detail ADD CONSTRAINT FK_6086DF939037F84C FOREIGN KEY (locale_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE object_detail ADD CONSTRAINT FK_6086DF93EA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE object_detail ADD CONSTRAINT FK_6086DF93FE54D947 FOREIGN KEY (group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE object_media ADD CONSTRAINT FK_EE0FF5EEEA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE object_media ADD CONSTRAINT FK_EE0FF5EEEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE object_phone ADD CONSTRAINT FK_C06CC33F2901A375 FOREIGN KEY (calling_code) REFERENCES country_phone_code (calling_code)');
        $this->addSql('ALTER TABLE object_phone ADD CONSTRAINT FK_C06CC33FA01AF590 FOREIGN KEY (type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE object_phone ADD CONSTRAINT FK_C06CC33FEA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE object_tag ADD CONSTRAINT FK_C4C20B06BAD26311 FOREIGN KEY (tag_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE object_tag ADD CONSTRAINT FK_C4C20B06EA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE product_locality ADD CONSTRAINT FK_2A66D2714584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_locality ADD CONSTRAINT FK_2A66D27188823A92 FOREIGN KEY (locality_id) REFERENCES locality (id)');
        $this->addSql('ALTER TABLE product_locality ADD CONSTRAINT FK_2A66D271C9AA420C FOREIGN KEY (role_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE tenant_excluded_master_code ADD CONSTRAINT FK_4A649F2677153098 FOREIGN KEY (code) REFERENCES master_code (code)');
        $this->addSql('ALTER TABLE tenant_excluded_master_code ADD CONSTRAINT FK_4A649F269033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE tenant_locality ADD CONSTRAINT FK_C070DA1188823A92 FOREIGN KEY (locality_id) REFERENCES locality (id)');
        $this->addSql('ALTER TABLE tenant_locality ADD CONSTRAINT FK_C070DA119033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE tenant_parameter_value ADD CONSTRAINT FK_6EBEAAD366ED1773 FOREIGN KEY (parent_value_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE tenant_parameter_value ADD CONSTRAINT FK_6EBEAAD39033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE tenant_parameter_value ADD CONSTRAINT FK_6EBEAAD3D81B339D FOREIGN KEY (parameter_code) REFERENCES master_code (code)');
        $this->addSql('ALTER TABLE tenant_parameter_value ADD CONSTRAINT FK_6EBEAAD3EA000C8B FOREIGN KEY (object_code) REFERENCES business_object (object_code)');
        $this->addSql('ALTER TABLE tenant_parameter_value_translation ADD CONSTRAINT FK_D6BA13FDF920BBA2 FOREIGN KEY (value_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('DROP TABLE master_parameter_value_translation');
        $this->addSql('DROP TABLE parameter_value_translation');
        $this->addSql('DROP TABLE parameter_value');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('ALTER TABLE business_object ADD has_group TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_file TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_media TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_comment TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_member TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_tag TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_address TINYINT(1) DEFAULT \'0\' NOT NULL, ADD has_phone TINYINT(1) DEFAULT \'0\' NOT NULL, ADD table_name VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP name, CHANGE active active TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE business_object ADD CONSTRAINT FK_F30DE416EA000C8B FOREIGN KEY (object_code) REFERENCES master_code (code)');
        $this->addSql('ALTER TABLE locality CHANGE code code VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE locality_translation DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE locality_translation ADD id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE INDEX IDX_D776A4F988823A92 ON locality_translation (locality_id)');
        $this->addSql('ALTER TABLE locality_translation ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE master_parameter_value DROP FOREIGN KEY FK_5A6779B7D81B339D');
        $this->addSql('ALTER TABLE master_parameter_value CHANGE active active TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE master_parameter_value ADD CONSTRAINT FK_5A6779B7DEFA6B41 FOREIGN KEY (value_code) REFERENCES master_code (code)');
        $this->addSql('ALTER TABLE master_parameter_value ADD CONSTRAINT FK_5A6779B7D81B339D FOREIGN KEY (parameter_code) REFERENCES master_code (code)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD584598A3');
        $this->addSql('DROP INDEX IDX_D34A04AD584598A3 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD5E4F6BE8 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD7284F825 ON product');
        $this->addSql('ALTER TABLE product ADD tenant_id INT NOT NULL, ADD external_system_code VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD group_id INT DEFAULT NULL, ADD sub_group_id INT DEFAULT NULL, ADD producer_reference VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD vat_percentage NUMERIC(4, 2) DEFAULT \'0.00\' NOT NULL, ADD longitude NUMERIC(19, 8) DEFAULT NULL, ADD latitude NUMERIC(18, 8) DEFAULT NULL, ADD departure_time VARCHAR(5) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD arrival_time VARCHAR(5) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD arrival_day_plus INT DEFAULT 0 NOT NULL, ADD stars INT DEFAULT NULL, DROP operator_id, DROP group_code, DROP sub_group_code, DROP child_min_age, DROP child_max_age, DROP baby_min_age, DROP baby_max_age, DROP call_price_before_discount, DROP call_price, DROP discount_pourcentage, CHANGE active active TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44FB371E FOREIGN KEY (sub_group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE1ECE19 FOREIGN KEY (external_system_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADFE54D947 FOREIGN KEY (group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADFE54D947 ON product (group_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADE1ECE19 ON product (external_system_code)');
        $this->addSql('CREATE INDEX IDX_D34A04AD44FB371E ON product (sub_group_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD9033212A ON product (tenant_id)');
        $this->addSql('ALTER TABLE third_party DROP FOREIGN KEY FK_346F1E226587D514');
        $this->addSql('DROP INDEX IDX_346F1E226587D514 ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E225E4F6BE8 ON third_party');
        $this->addSql('DROP INDEX IDX_346F1E227284F825 ON third_party');
        $this->addSql('ALTER TABLE third_party ADD tenant_id INT NOT NULL, ADD sub_type_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD group_id INT DEFAULT NULL, ADD sub_group_id INT DEFAULT NULL, ADD accounting_reference VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD company_reference VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD vat_reference VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD web_site VARCHAR(400) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD language_code VARCHAR(2) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP group_code, DROP sub_group_code, DROP organization, DROP operator, DROP created_at, DROP updated_at, CHANGE relation_type_code type_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E2244FB371E FOREIGN KEY (sub_group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E229033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E22A01AF590 FOREIGN KEY (type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E22B217B32E FOREIGN KEY (sub_type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E22FE54D947 FOREIGN KEY (group_id) REFERENCES tenant_parameter_value (id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_name_tenant ON third_party (name, tenant_id)');
        $this->addSql('CREATE INDEX IDX_346F1E22B217B32E ON third_party (sub_type_code)');
        $this->addSql('CREATE UNIQUE INDEX uniq_accounting_reference_tenant ON third_party (accounting_reference, tenant_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_vat_reference_tenant ON third_party (vat_reference, tenant_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_company_reference_tenant ON third_party (company_reference, tenant_id)');
        $this->addSql('CREATE INDEX IDX_346F1E2244FB371E ON third_party (sub_group_id)');
        $this->addSql('CREATE INDEX IDX_346F1E22A01AF590 ON third_party (type_code)');
        $this->addSql('CREATE INDEX IDX_346F1E229033212A ON third_party (tenant_id)');
        $this->addSql('CREATE INDEX IDX_346F1E22FE54D947 ON third_party (group_id)');
        $this->addSql('ALTER TABLE user ADD tenant_id INT NOT NULL, ADD type_code VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD username VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, ADD roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, DROP login, DROP created_at, DROP updated_at, CHANGE password password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A01AF590 FOREIGN KEY (type_code) REFERENCES master_parameter_value (value_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE INDEX IDX_8D93D6499033212A ON user (tenant_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A01AF590 ON user (type_code)');
    }
}
