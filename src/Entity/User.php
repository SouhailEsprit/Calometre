<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=24)
     */
    private $password;

    /**
     * @ORM\OneToMany (targetEntity=Comment::class, mappedBy="user")
     */
    private $usercomments;

    /**
     * @return mixed
     */
    public function getUsercomments()
    {
        return $this->usercomments;
    }

    /**
     * @param mixed $usercomments
     */
    public function setUsercomments($usercomments): void
    {
        $this->usercomments = $usercomments;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
