<?php

namespace App\Entity;

use App\Repository\InvestmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvestmentRepository::class)]
class Investment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $titreoperation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(name: 'annee_de_livraison', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $mandataire = null;

    #[ORM\Column(length: 255)]
    private ?string $ppi = null;

    #[ORM\Column(length: 255)]
    private ?string $lycee = null;

    #[ORM\Column(name: 'notification_du_marche', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $notification = null;

    #[ORM\Column(length: 255)]
    private ?string $codeuai = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column(name: 'etat_d_avancement', length: 255)]
    private ?string $etatAvancement = null;

    #[ORM\Column(name:'montant_des_ap_votes_en_meu')]
    private ?float $montantVotes = null;

    #[ORM\Column(name: 'cao_attribution', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $cao = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column(name: 'maitrise_d_oeuvre', length: 255)]
    private ?string $maitrise = null;

    #[ORM\Column(name: 'mode_de_devolution', length: 255)]
    private ?string $modeDevolution = null;

    #[ORM\Column(name: 'annee_d_individualisation')]
    private ?int $aneeIndividualisation = null;

    #[ORM\Column(name: 'enveloppe_prev_en_meu', nullable: true)]
    private ?float $enveloppePrev = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreoperation(): ?string
    {
        return $this->titreoperation;
    }

    public function setTitreoperation(string $titreoperation): static
    {
        $this->titreoperation = $titreoperation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getMandataire(): ?string
    {
        return $this->mandataire;
    }

    public function setMandataire(string $mandataire): static
    {
        $this->mandataire = $mandataire;

        return $this;
    }

    public function getPpi(): ?string
    {
        return $this->ppi;
    }

    public function setPpi(string $ppi): static
    {
        $this->ppi = $ppi;

        return $this;
    }

    public function getLycee(): ?string
    {
        return $this->lycee;
    }

    public function setLycee(string $lycee): static
    {
        $this->lycee = $lycee;

        return $this;
    }

    public function getNotification(): ?\DateTimeInterface
    {
        return $this->notification;
    }

    public function setNotification(?\DateTimeInterface $notification): static
    {
        $this->notification = $notification;

        return $this;
    }

    public function getCodeuai(): ?string
    {
        return $this->codeuai;
    }

    public function setCodeuai(string $codeuai): static
    {
        $this->codeuai = $codeuai;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getEtatAvancement(): ?string
    {
        return $this->etatAvancement;
    }

    public function setEtatAvancement(string $etatAvancement): static
    {
        $this->etatAvancement = $etatAvancement;

        return $this;
    }

    public function getMontantVotes(): ?float
    {
        return $this->montantVotes;
    }

    public function setMontantVotes(float $montantVotes): static
    {
        $this->montantVotes = $montantVotes;

        return $this;
    }

    public function getCao(): ?\DateTimeInterface
    {
        return $this->cao;
    }

    public function setCao(?\DateTimeInterface $cao): static
    {
        $this->cao = $cao;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getMaitrise(): ?string
    {
        return $this->maitrise;
    }

    public function setMaitrise(string $maitrise): static
    {
        $this->maitrise = $maitrise;

        return $this;
    }

    public function getModeDevolution(): ?string
    {
        return $this->modeDevolution;
    }

    public function setModeDevolution(string $modeDevolution): static
    {
        $this->modeDevolution = $modeDevolution;

        return $this;
    }

    public function getAneeIndividualisation(): ?int
    {
        return $this->aneeIndividualisation;
    }

    public function setAneeIndividualisation(int $aneeIndividualisation): static
    {
        $this->aneeIndividualisation = $aneeIndividualisation;

        return $this;
    }

    public function getEnveloppePrev(): ?float
    {
        return $this->enveloppePrev;
    }

    public function setEnveloppePrev(?float $enveloppePrev): static
    {
        $this->enveloppePrev = $enveloppePrev;

        return $this;
    }
}

