<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $categorie;

    /**
     * @ORM\Column(type="object")
     */
    private $regime;

    /**
     * @ORM\Column(type="object")
     */
    private $listaliment;

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

    public function getRegime()
    {
        return $this->regime;
    }

    public function setRegime($regime): self
    {
        $this->regime = $regime;

        return $this;
    }

    public function getListaliment()
    {
        return $this->listaliment;
    }

    public function setListaliment($listaliment): self
    {
        $this->listaliment = $listaliment;

        return $this;
    }
}
