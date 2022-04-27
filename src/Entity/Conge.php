<?php

namespace App\Entity;

use App\Repository\CongeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CongeRepository::class)]
class Conge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'typeDemande', targetEntity: Demandev2::class, orphanRemoval: true)]
    private $demandev2s;

    public function __construct()
    {
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

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
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
            $demandev2->setTypeDemande($this);
        }

        return $this;
    }

    public function removeDemandev2(Demandev2 $demandev2): self
    {
        if ($this->demandev2s->removeElement($demandev2)) {
            // set the owning side to null (unless already changed)
            if ($demandev2->getTypeDemande() === $this) {
                $demandev2->setTypeDemande(null);
            }
        }

        return $this;
    }
}
