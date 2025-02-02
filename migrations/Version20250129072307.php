<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250129072307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investment ADD mandataire VARCHAR(255) NOT NULL, ADD ppi VARCHAR(255) NOT NULL, ADD lycee VARCHAR(255) NOT NULL, ADD notification_du_marche DATETIME DEFAULT NULL, ADD codeuai VARCHAR(255) NOT NULL, ADD longitude DOUBLE PRECISION NOT NULL, ADD etat_d_avancement VARCHAR(255) NOT NULL, ADD montant_des_ap_votes_en_meu DOUBLE PRECISION NOT NULL, ADD cao_attribution DATETIME NOT NULL, ADD latitude DOUBLE PRECISION NOT NULL, ADD maitrise_d_oeuvre VARCHAR(255) NOT NULL, ADD mode_de_devolution VARCHAR(255) NOT NULL, ADD annee_d_individualisation INT NOT NULL, ADD enveloppe_prev_en_meu DOUBLE PRECISION NOT NULL, CHANGE annee annee_de_livraison DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investment ADD annee DATETIME DEFAULT NULL, DROP annee_de_livraison, DROP mandataire, DROP ppi, DROP lycee, DROP notification_du_marche, DROP codeuai, DROP longitude, DROP etat_d_avancement, DROP montant_des_ap_votes_en_meu, DROP cao_attribution, DROP latitude, DROP maitrise_d_oeuvre, DROP mode_de_devolution, DROP annee_d_individualisation, DROP enveloppe_prev_en_meu');
    }
}
