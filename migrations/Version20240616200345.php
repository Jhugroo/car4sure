<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616200345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, zip INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coverage (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, limit_coverage INT NOT NULL, deductible INT NOT NULL, INDEX IDX_5556F36B545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, gender_id INT DEFAULT NULL, marital_status_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, age INT NOT NULL, license_number INT NOT NULL, license_state VARCHAR(255) NOT NULL, license_effective_date DATE NOT NULL, license_expiration_date DATE NOT NULL, license_class VARCHAR(1) NOT NULL, INDEX IDX_11667CD9708A0E0 (gender_id), INDEX IDX_11667CD9E559F9BF (marital_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver_policy (driver_id INT NOT NULL, policy_id INT NOT NULL, INDEX IDX_B522DBAEC3423909 (driver_id), INDEX IDX_B522DBAE2D29E3C6 (policy_id), PRIMARY KEY(driver_id, policy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marital_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE policy (id INT AUTO_INCREMENT NOT NULL, policy_holder_id INT DEFAULT NULL, policy_no INT NOT NULL, policy_status VARCHAR(255) NOT NULL, policy_type VARCHAR(255) NOT NULL, policy_effective_date DATE NOT NULL, policy_expiration_date DATE NOT NULL, UNIQUE INDEX UNIQ_F07D0516A07EC9B5 (policy_holder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE policy_holder (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FC7C85A0F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, garaging_address_id INT DEFAULT NULL, year INT NOT NULL, make VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, vin BIGINT NOT NULL, usage_vehicle VARCHAR(255) NOT NULL, primary_use VARCHAR(255) NOT NULL, annual_mileage INT NOT NULL, ownership VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1B80E4867A926313 (garaging_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_policy (vehicle_id INT NOT NULL, policy_id INT NOT NULL, INDEX IDX_59A304C5545317D1 (vehicle_id), INDEX IDX_59A304C52D29E3C6 (policy_id), PRIMARY KEY(vehicle_id, policy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coverage ADD CONSTRAINT FK_5556F36B545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD9708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD9E559F9BF FOREIGN KEY (marital_status_id) REFERENCES marital_status (id)');
        $this->addSql('ALTER TABLE driver_policy ADD CONSTRAINT FK_B522DBAEC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE driver_policy ADD CONSTRAINT FK_B522DBAE2D29E3C6 FOREIGN KEY (policy_id) REFERENCES policy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE policy ADD CONSTRAINT FK_F07D0516A07EC9B5 FOREIGN KEY (policy_holder_id) REFERENCES policy_holder (id)');
        $this->addSql('ALTER TABLE policy_holder ADD CONSTRAINT FK_FC7C85A0F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867A926313 FOREIGN KEY (garaging_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE vehicle_policy ADD CONSTRAINT FK_59A304C5545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_policy ADD CONSTRAINT FK_59A304C52D29E3C6 FOREIGN KEY (policy_id) REFERENCES policy (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coverage DROP FOREIGN KEY FK_5556F36B545317D1');
        $this->addSql('ALTER TABLE driver DROP FOREIGN KEY FK_11667CD9708A0E0');
        $this->addSql('ALTER TABLE driver DROP FOREIGN KEY FK_11667CD9E559F9BF');
        $this->addSql('ALTER TABLE driver_policy DROP FOREIGN KEY FK_B522DBAEC3423909');
        $this->addSql('ALTER TABLE driver_policy DROP FOREIGN KEY FK_B522DBAE2D29E3C6');
        $this->addSql('ALTER TABLE policy DROP FOREIGN KEY FK_F07D0516A07EC9B5');
        $this->addSql('ALTER TABLE policy_holder DROP FOREIGN KEY FK_FC7C85A0F5B7AF75');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867A926313');
        $this->addSql('ALTER TABLE vehicle_policy DROP FOREIGN KEY FK_59A304C5545317D1');
        $this->addSql('ALTER TABLE vehicle_policy DROP FOREIGN KEY FK_59A304C52D29E3C6');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE coverage');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE driver_policy');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE marital_status');
        $this->addSql('DROP TABLE policy');
        $this->addSql('DROP TABLE policy_holder');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_policy');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
