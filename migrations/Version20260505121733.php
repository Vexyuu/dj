<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260505121733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN tel VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN url_portfolio VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN date_soiree DATE NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN materiel BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN couleur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN nb_enceintes INTEGER NOT NULL');
        $this->addSql('ALTER TABLE dj_entity ADD COLUMN puissance INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__dj_entity AS SELECT id, nom, prenom FROM dj_entity');
        $this->addSql('DROP TABLE dj_entity');
        $this->addSql('CREATE TABLE dj_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO dj_entity (id, nom, prenom) SELECT id, nom, prenom FROM __temp__dj_entity');
        $this->addSql('DROP TABLE __temp__dj_entity');
    }
}
