<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AOLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: AO::class)]
    #[ORM\JoinColumn(nullable: false)]
    private AO $ao;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $changedAt;

    #[ORM\Column(type: 'json')]
    private array $changes = [];

    #[ORM\Column(length: 50)]
    private string $action;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAo(): AO
    {
        return $this->ao;
    }

    public function setAo(AO $ao): void
    {
        $this->ao = $ao;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getChangedAt(): \DateTimeInterface
    {
        return $this->changedAt;
    }

    public function setChangedAt(\DateTimeInterface $changedAt): void
    {
        $this->changedAt = $changedAt;
    }

    public function getChanges(): array
    {
        return $this->changes;
    }

    public function setChanges(array $changes): void
    {
        $this->changes = $changes;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }
}