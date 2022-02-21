<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    // @Assert\Length(
    //     *    min = 10s,
    //     *    max = 50,
    //     *    minMessage = "Your first name must be at least {{ limit }} characters long",
    //     *    maxMessage = "Your first name cannot be longer than {{ limit }} characters")

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\OneToOne(targetEntity=Reclamation::class, cascade={"persist", "remove"})
     */
    private $Id;

    /**
     * @ORM\OneToOne(targetEntity=Reponse::class, inversedBy="reclamation", cascade={"persist", "remove"})
     */
    private $reponse;

    // /**
    //  * @ORM\OneToOne(targetEntity=Reponse::class, mappedBy="reponse", cascade={"persist", "remove"})
    //  */
    // private $rec_reponse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function __toString() {
        return (string)$this->id;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setId(?self $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getReponse(): ?Reponse
    {
        return $this->reponse;
    }

    public function setReponse(?Reponse $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }
}
