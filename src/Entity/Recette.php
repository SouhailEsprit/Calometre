<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Float_;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseinger ce champ")
     * @Assert\Length(min=2,minMessage="Le nom de la comporte au moins 2 caractére",max=25,maxMessage="Le nom de la recette comporte au plus 25 caractére")
     */
    private $Name;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $regime;

    /**
     * @ORM\ManyToMany(targetEntity=Aliment::class)
     */
    private $aliments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\OneToMany(targetEntity=RecetteLike::class, mappedBy="Recette")
     */
    private $likes;

    public function __construct()
    {
        $this->aliments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Name;
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

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getRegime(): ?string
    {
        return $this->regime;
    }

    public function setRegime(string $regime): self
    {
        $this->regime = $regime;

        return $this;
    }

    /**
     * @return Collection<int, Aliment>
     */
    public function getAliments(): Collection
    {
        return $this->aliments;
    }

    public function addAliment(Aliment $aliment): self
    {
        if (!$this->aliments->contains($aliment)) {
            $this->aliments[] = $aliment;
        }

        return $this;
    }

    public function removeAliment(Aliment $aliment): self
    {
        $this->aliments->removeElement($aliment);

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

    public function nbrcal(): Float
    {  $a=0 ;
        foreach ($this->aliments as $cal) {
            $a=$a+$cal->getCalories();
        }
        return $a ;
    }

    /**
     * @return Collection<int, RecetteLike>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(RecetteLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setRecette($this);
        }

        return $this;
    }

    public function removeLike(RecetteLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getRecette() === $this) {
                $like->setRecette(null);
            }
        }

        return $this;
    }
    public function isLikedByUser(User $user): bool
    {
        Foreach( $this->likes as $like)
        {
            if ($like->getUser() === $user) return true;

        }
        return false;


    }

}
