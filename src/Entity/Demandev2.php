<?php

namespace App\Entity;

use App\Repository\Demandev2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Demandev2Repository::class)]
class Demandev2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Conge::class, inversedBy: 'demandev2s')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeDemande;

    #[ORM\ManyToOne(targetEntity: Employes::class, inversedBy: 'demandev2s')]
    #[ORM\JoinColumn(nullable: false)]
    private $nomEmploye;

    #[ORM\Column(type: 'date')]
    private $dateDebut;

    #[ORM\Column(type: 'date')]
    private $dateFin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $commentaire;

    #[ORM\Column(type: 'string', length: 255)]
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeDemande(): ?Conge
    {
        return $this->typeDemande;
    }

    public function setTypeDemande(?Conge $typeDemande): self
    {
        $this->typeDemande = $typeDemande;

        return $this;
    }

    public function getNomEmploye(): ?Employes
    {
        return $this->nomEmploye;
    }

    public function setNomEmploye(?Employes $nomEmploye): self
    {
        $this->nomEmploye = $nomEmploye;

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

    public function setDateFin(\DateTimeInterface $dateFin): self
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
}
