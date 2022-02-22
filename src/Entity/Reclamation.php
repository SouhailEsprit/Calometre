<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\OneToOne(targetEntity=Reponse::class, mappedBy="reponse", cascade={"persist", "remove"})
     */
    private $rec_reponse;

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

    public function getRecReponse(): ?Reponse
    {
        return $this->rec_reponse;
    }

    public function setRecReponse(?Reponse $rec_reponse): self
    {
        // unset the owning side of the relation if necessary
        if ($rec_reponse === null && $this->rec_reponse !== null) {
            $this->rec_reponse->setReponse(null);
        }

        // set the owning side of the relation if necessary
        if ($rec_reponse !== null && $rec_reponse->getReponse() !== $this) {
            $rec_reponse->setReponse($this);
        }

        $this->rec_reponse = $rec_reponse;

        return $this;
    }
}
