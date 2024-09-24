<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTrait;
use App\Repository\PumpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: PumpRepository::class)]
class Pump
{
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $gasoilQuantity = null;

    #[ORM\Column]
    private ?float $essenceQuantity = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'pumps')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'pump', targetEntity: Shift::class)]
    private Collection $shifts;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->shifts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGasoilQuantity(): ?float
    {
        return $this->gasoilQuantity;
    }

    public function setGasoilQuantity(float $gasoilQuantity): static
    {
        $this->gasoilQuantity = $gasoilQuantity;

        return $this;
    }

    public function getEssenceQuantity(): ?float
    {
        return $this->essenceQuantity;
    }

    public function setEssenceQuantity(float $essenceQuantity): static
    {
        $this->essenceQuantity = $essenceQuantity;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Shift>
     */
    public function getShifts(): Collection
    {
        return $this->shifts;
    }

    public function addShift(Shift $shift): static
    {
        if (!$this->shifts->contains($shift)) {
            $this->shifts->add($shift);
            $shift->setPump($this);
        }

        return $this;
    }

    public function removeShift(Shift $shift): static
    {
        if ($this->shifts->removeElement($shift)) {
            // set the owning side to null (unless already changed)
            if ($shift->getPump() === $this) {
                $shift->setPump(null);
            }
        }

        return $this;
    }
}
