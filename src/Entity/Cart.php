<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\JoinColumn(name="CartProds", referencedColumnName="idcart", onDelete="CASCADE")
     * @ORM\OneToMany(targetEntity=CartProds::class, mappedBy="idcart", cascade={"remove"})
     */
    private $cartProds;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="cart", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCart;


    public function __construct()
    {
        $this->cartProds = new ArrayCollection();
    }
    public function __toString()
    {

        return (string) $this->getId();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection<int, CartProds>
     */
    public function getCartProds(): Collection
    {
        return $this->cartProds;
    }

    public function addCartProd(CartProds $cartProd): self
    {
        if (!$this->cartProds->contains($cartProd)) {
            $this->cartProds[] = $cartProd;
            $cartProd->setIdcart($this);
        }

        return $this;
    }

    public function removeCartProd(CartProds $cartProd): self
    {
        if ($this->cartProds->removeElement($cartProd)) {
            // set the owning side to null (unless already changed)
            if ($cartProd->getIdcart() === $this) {
                $cartProd->setIdcart(null);
            }
        }

        return $this;
    }

    public function getUserCart(): ?User
    {
        return $this->userCart;
    }

    public function setUserCart(User $userCart): self
    {
        $this->userCart = $userCart;

        return $this;
    }


}
