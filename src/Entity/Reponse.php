<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Reclamation::class, cascade={"persist", "remove"})
     */
    private $repondre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponse;

    /**
     * @ORM\OneToOne(targetEntity=Reclamation::class, cascade={"persist", "remove"})
     */
    private $Id;

    // /**
    //  * @ORM\OneToOne(targetEntity=reclamation::class, inversedBy="rec_reponse", cascade={"persist", "remove"})
    //  */
    // private $reponse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    // public function getReponse(): ?reclamation
    // {
    //     return $this->reponse;
    // }

    // public function setReponse(?reclamation $reponse): self
    // {
    //     $this->reponse = $reponse;

    //     return $this;
    // }

    public function getRepondre(): ?Reclamation
    {
        return $this->repondre;
    }

    public function setRepondre(?Reclamation $repondre): self
    {
        $this->repondre = $repondre;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function setId(?Reclamation $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
