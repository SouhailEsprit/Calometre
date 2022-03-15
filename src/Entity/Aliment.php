<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AlimentRepository::class)
 */
class Aliment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("post:read")
     */
    private $categorie;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Veuillez renseinger ce champ")
     * @Assert\LessThan(10000)
     * @Assert\GreaterThan(12)
     * @Groups ("post:read")
     */
    private $calories;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseinger ce champ")
     * @Assert\Length(min=3,minMessage="Le nom de l'aliment comporte au moins 3 caractére",max=25,maxMessage="Le nom de l'aliment comporte au plus 25 caractére")
     * @Groups ("post:read")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Recette::class)
     */
    private $recettes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("post:read")
     */
    private $Image;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        $this->recettes->removeElement($recette);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
}
