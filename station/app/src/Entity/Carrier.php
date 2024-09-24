<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTrait;
use App\Repository\CarrierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: CarrierRepository::class)]
class Carrier
{
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?int $ordersDelivered = null;

    #[ORM\Column]
    private ?int $ordersNotDelivered = null;

    #[ORM\OneToMany(mappedBy: 'carrier', targetEntity: DeliveryNotes::class, orphanRemoval: true)]
    private Collection $deliveryNotes;

    public function __construct()
    {
        $this->deliveryNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOrdersDelivered(): ?int
    {
        return $this->ordersDelivered;
    }

    public function setOrdersDelivered(int $ordersDelivered): static
    {
        $this->ordersDelivered = $ordersDelivered;

        return $this;
    }

    public function getOrdersNotDelivered(): ?int
    {
        return $this->ordersNotDelivered;
    }

    public function setOrdersNotDelivered(int $ordersNotDelivered): static
    {
        $this->ordersNotDelivered = $ordersNotDelivered;

        return $this;
    }

    /**
     * @return Collection<int, DeliveryNotes>
     */
    public function getDeliveryNotes(): Collection
    {
        return $this->deliveryNotes;
    }

    public function addDeliveryNote(DeliveryNotes $deliveryNote): static
    {
        if (!$this->deliveryNotes->contains($deliveryNote)) {
            $this->deliveryNotes->add($deliveryNote);
            $deliveryNote->setCarrier($this);
        }

        return $this;
    }

    public function removeDeliveryNote(DeliveryNotes $deliveryNote): static
    {
        if ($this->deliveryNotes->removeElement($deliveryNote)) {
            // set the owning side to null (unless already changed)
            if ($deliveryNote->getCarrier() === $this) {
                $deliveryNote->setCarrier(null);
            }
        }

        return $this;
    }
}
