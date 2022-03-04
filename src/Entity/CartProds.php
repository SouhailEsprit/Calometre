<?php

namespace App\Entity;

use App\Repository\CartProdsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartProdsRepository::class)
 */
class CartProds
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="idcart", cascade={"persist"}, fetch="LAZY")
     */
    private $idprod;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="cartProds", cascade={"persist"}, fetch="LAZY")
     */
    private $idcart;

    /**
     * @ORM\Column(type="float")
     */
    private $qty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdprod(): ?Product
    {
        return $this->idprod;
    }

    public function setIdprod(?Product $idprod): self
    {
        $this->idprod = $idprod;

        return $this;
    }

    public function getIdcart(): ?Cart
    {
        return $this->idcart;
    }

    public function setIdcart(?Cart $idcart): self
    {
        $this->idcart = $idcart;

        return $this;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function setQty(float $qty): self
    {
        $this->qty = $qty;

        return $this;
    }
}
