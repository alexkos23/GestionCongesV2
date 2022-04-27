<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployesRepository::class)]
class Employes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeContrat;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateEmbauche;

    #[ORM\OneToMany(mappedBy: 'idEmploye', targetEntity: Demande::class)]
    private $demandes;

    #[ORM\OneToMany(mappedBy: 'nomEmploye', targetEntity: Demandev2::class, orphanRemoval: true)]
    private $demandev2s;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->demandev2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeInterface
    {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(?\DateTimeInterface $dateEmbauche): self
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setIdEmploye($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getIdEmploye() === $this) {
                $demande->setIdEmploye(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, Demandev2>
     */
    public function getDemandev2s(): Collection
    {
        return $this->demandev2s;
    }

    public function addDemandev2(Demandev2 $demandev2): self
    {
        if (!$this->demandev2s->contains($demandev2)) {
            $this->demandev2s[] = $demandev2;
            $demandev2->setNomEmploye($this);
        }

        return $this;
    }

    public function removeDemandev2(Demandev2 $demandev2): self
    {
        if ($this->demandev2s->removeElement($demandev2)) {
            // set the owning side to null (unless already changed)
            if ($demandev2->getNomEmploye() === $this) {
                $demandev2->setNomEmploye(null);
            }
        }

        return $this;
    }
}
