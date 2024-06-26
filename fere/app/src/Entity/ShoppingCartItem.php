<?php

namespace App\Entity;

use App\Repository\ShoppingCartItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use LogicException;

#[ORM\Entity(repositoryClass: ShoppingCartItemRepository::class)]
class ShoppingCartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Product $product = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(value: 1)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?ShoppingCart $orderRef = null;

    /**
     * Tests if the given item given corresponds to the same order item.
     *
     * @param ShoppingCartItem $item
     *
     * @return bool
     */
    public function equals(ShoppingCartItem $item): bool
    {
        if (!$this->getProduct() || !$item->getProduct()) {
            throw new LogicException('Aucun produit fournit en paramètre');
        }

        return $this->getProduct()->getId() === $item->getProduct()->getId();
    }

    /**
     * Calculates the item total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        if (!$this->getProduct()) {
            throw new LogicException('Aucun produit fournit en paramètre');
        }

        return $this->getProduct()->getPrice() * $this->getQuantity();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderRef(): ?ShoppingCart
    {
        return $this->orderRef;
    }

    public function setOrderRef(?ShoppingCart $orderRef): static
    {
        $this->orderRef = $orderRef;

        return $this;
    }
}
