<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AlimentRepository::class)
 */
class Aliment
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
    private $categorie;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Veuillez renseinger ce champ")
     * @Assert\LessThan(900000)
     * @Assert\GreaterThan(10000)
     */
    private $calories;

    /**
     * @var \Doctrine\Common\Collections
     * @ORM\ManyToMany(targetEntity=Recette::class, inversedBy="aliments")
     * @ORM\JoinTable(name="aliment_recette")
     */
    private $Listerecette;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseinger ce champ")
     * @Assert\Length(min=3,minMessage="Le nom de l'aliment comporte au moins 3 caractére",max=25,maxMessage="Le nom de l'aliment comporte au plus 25 caractére")
     */
    private $name;

    public function __construct()
    {
        $this->Listerecette = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCalories(): ?float
    {
        return $this->calories;
    }

    public function setCalories(float $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getListerecette(): Collection
    {
        return $this->Listerecette;
    }

    public function addListerecette(Recette $listerecette): self
    {
        if (!$this->Listerecette->contains($listerecette)) {
            $this->Listerecette[] = $listerecette;
        }

        return $this;
    }

    public function removeListerecette(Recette $listerecette): self
    {
        $this->Listerecette->removeElement($listerecette);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
