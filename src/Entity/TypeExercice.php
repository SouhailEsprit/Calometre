<?php

namespace App\Entity;

use App\Repository\TypeexerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeexerciceRepository::class)
 */
class Typeexercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="nomtype")
     */
    private $type;

    public function __construct()
    {
        $this->type = new ArrayCollection();
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

    /**
     * @return Collection<int, Exercice>
     */
    public function getType(): Collection
    {
        return $this->type;
    }
    public function __toString(){
        return $this->nom;
    }

    public function addType(Exercice $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setNomtype($this);
        }

        return $this;
    }

    public function removeType(Exercice $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getNomtype() === $this) {
                $type->setNomtype(null);
            }
        }

        return $this;
    }
}
