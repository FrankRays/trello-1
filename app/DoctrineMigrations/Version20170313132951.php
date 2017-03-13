<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170313132951 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY fk_taches_colonnes');
        $this->addSql('DROP INDEX id_colonne ON taches');
        $this->addSql('ALTER TABLE taches ADD category_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, DROP id_colonne');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD9812469DE2 FOREIGN KEY (category_id) REFERENCES colonnes (id)');
        $this->addSql('CREATE INDEX IDX_3BF2CD9812469DE2 ON taches (category_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD9812469DE2');
        $this->addSql('DROP INDEX IDX_3BF2CD9812469DE2 ON taches');
        $this->addSql('ALTER TABLE taches ADD id_colonne INT NOT NULL, DROP category_id, DROP name');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT fk_taches_colonnes FOREIGN KEY (id_colonne) REFERENCES colonnes (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_colonne ON taches (id_colonne)');
    }
}
