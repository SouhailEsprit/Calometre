<?php

namespace App\Entity;

use App\Repository\ReclamerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ReclamerRepository::class)
 */
class Reclamer
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
    private $idreclamation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\Length(
        
        *      min = 5,
        *      max = 10,
        *      minMessage = "zid ekteb {{ limit }} ",
        *      maxMessage = "kathart ale me wasawek hihihi{{ limit }} "
        * )
     */
    private $message;

    /**
     * @ORM\OneToOne(targetEntity=Reclamer::class, cascade={"persist", "remove"})
     
  
        */
    private $idreponse;

    /**
     * @ORM\OneToOne(targetEntity=Reponse::class, cascade={"persist", "remove"})
     */
    private $Id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdreclamation(): ?string
    {
        return $this->idreclamation;
    }

    public function setIdreclamation(string $idreclamation): self
    {
        $this->idreclamation = $idreclamation;

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

    public function getIdreponse(): ?self
    {
        return $this->idreponse;
    }

    public function setIdreponse(?self $idreponse): self
    {
        $this->idreponse = $idreponse;

        return $this;
    }

    public function setId(?Reponse $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
