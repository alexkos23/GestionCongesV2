<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'date')]
    private $dateDebut;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateFin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $commentaire;

    #[ORM\Column(type: 'string', length: 255)]
    private $statut;

    #[ORM\ManyToOne(targetEntity: Employes::class, inversedBy: 'demandes')]
    private $idEmploye;

    #[ORM\ManyToOne(targetEntity: demande::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $typeConge;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdEmploye(): ?Employes
    {
        return $this->idEmploye;
    }

    public function setIdEmploye(?Employes $idEmploye): self
    {
        $this->idEmploye = $idEmploye;

        return $this;
    }

    public function getTypeConge(): ?demande
    {
        return $this->typeConge;
    }

    public function setTypeConge(?demande $typeConge): self
    {
        $this->typeConge = $typeConge;

        return $this;
    }
}
