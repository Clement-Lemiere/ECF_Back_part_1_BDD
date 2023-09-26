<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230924151359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD emprunteur_id_id INT NOT NULL, ADD livres_id INT DEFAULT NULL, ADD livres_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7ADB071EC FOREIGN KEY (emprunteur_id_id) REFERENCES emprunteur (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7EBF07F38 FOREIGN KEY (livres_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D75923E6D6 FOREIGN KEY (livres_id_id) REFERENCES livres (id)');
        $this->addSql('CREATE INDEX IDX_364071D7ADB071EC ON emprunt (emprunteur_id_id)');
        $this->addSql('CREATE INDEX IDX_364071D7EBF07F38 ON emprunt (livres_id)');
        $this->addSql('CREATE INDEX IDX_364071D75923E6D6 ON emprunt (livres_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7ADB071EC');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7EBF07F38');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D75923E6D6');
        $this->addSql('DROP INDEX IDX_364071D7ADB071EC ON emprunt');
        $this->addSql('DROP INDEX IDX_364071D7EBF07F38 ON emprunt');
        $this->addSql('DROP INDEX IDX_364071D75923E6D6 ON emprunt');
        $this->addSql('ALTER TABLE emprunt DROP emprunteur_id_id, DROP livres_id, DROP livres_id_id');
    }
}
