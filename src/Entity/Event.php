<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message = " the name of the event is required")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\GreaterThan(propertyPath="dateDebut")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $nombreParticipants;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $lieu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="event",cascade={"remove"})
     */
    private $posts;

    /**
     * @ORM\Column(type="string")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="event")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="events" )
     */
    private $users;

    /**
     * @return mixed
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->comments = new ArrayCollection();

    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }
        return $this;
    }
    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);
        return $this;
    }



    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }







    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(string $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(string $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNombreParticipants(): ?int
    {
        return $this->nombreParticipants;
    }

    public function setNombreParticipants(int $nombreParticipants): self
    {
        $this->nombreParticipants = $nombreParticipants;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }


}

