<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTrait;
use App\Repository\ShiftRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: ShiftRepository::class)]
class Shift
{
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shifts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;

    #[ORM\ManyToOne(inversedBy: 'shifts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pump $pump = null;

    #[ORM\Column]
    private ?float $gasoilQuantityAtStart = null;

    #[ORM\Column]
    private ?float $essenceQuantityAtStart = null;

    #[ORM\Column(nullable: true)]
    private ?float $gasoilQuantityAtEnd = null;

    #[ORM\Column(nullable: true)]
    private ?float $essenceQuantityAtEnd = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getPump(): ?Pump
    {
        return $this->pump;
    }

    public function setPump(?Pump $pump): static
    {
        $this->pump = $pump;

        return $this;
    }

    public function getGasoilQuantityAtStart(): ?float
    {
        return $this->gasoilQuantityAtStart;
    }

    public function setGasoilQuantityAtStart(float $gasoilQuantityAtStart): static
    {
        $this->gasoilQuantityAtStart = $gasoilQuantityAtStart;

        return $this;
    }

    public function getEssenceQuantityAtStart(): ?float
    {
        return $this->essenceQuantityAtStart;
    }

    public function setEssenceQuantityAtStart(float $essenceQuantityAtStart): static
    {
        $this->essenceQuantityAtStart = $essenceQuantityAtStart;

        return $this;
    }

    public function getGasoilQuantityAtEnd(): ?float
    {
        return $this->gasoilQuantityAtEnd;
    }

    public function setGasoilQuantityAtEnd(?float $gasoilQuantityAtEnd): static
    {
        $this->gasoilQuantityAtEnd = $gasoilQuantityAtEnd;

        return $this;
    }

    public function getEssenceQuantityAtEnd(): ?float
    {
        return $this->essenceQuantityAtEnd;
    }

    public function setEssenceQuantityAtEnd(?float $essenceQuantityAtEnd): static
    {
        $this->essenceQuantityAtEnd = $essenceQuantityAtEnd;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): static
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    #[Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ($this->getEssenceQuantityAtEnd() > $this->getEssenceQuantityAtStart()) {
            $context->buildViolation('La quantité d\'essence de clôture saisie ne peut être supérieur à sa quantité de départ')
                ->atPath('essenceQuantityAtEnd')
                ->addViolation();
        }
        if ($this->getGasoilQuantityAtEnd() > $this->getGasoilQuantityAtStart()) {
            $context->buildViolation('La quantité de gasoil de clôture saisie ne peut être supérieur à sa quantité de départ')
                ->atPath('gasoilQuantityAtEnd')
                ->addViolation();
        }
    }
}
