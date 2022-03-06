<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
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
    private $exercice;

    /**
     * @ORM\OneToMany(targetEntity=typeexercice::class, mappedBy="exercice")
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

    public function getExercice(): ?string
    {
        return $this->exercice;
    }

    public function setExercice(string $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }

    /**
     * @return Collection<int, typeexercice>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(typeexercice $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setExercice($this);
        }

        return $this;
    }

    public function removeType(typeexercice $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getExercice() === $this) {
                $type->setExercice(null);
            }
        }

        return $this;
    }
}
