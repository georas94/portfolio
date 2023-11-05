<?php

namespace App\Entity;

use App\Repository\ExpenseRepository;
use App\ValueObject\Status;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenseRepository::class)]
class Expense
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_REJECTED_FROM_DRAFT = 'from_draft_to_delete';
    public const STATUS_TO_REVIEW_ACCOUNTING = 'to_review_accounting';
    public const STATUS_REJECTED_FROM_ACCOUNTING = 'rejected_from_accounting';
    public const STATUS_TO_REVIEW_MANAGER = 'to_review_manager';
    public const STATUS_REJECTED_FROM_MANAGER = 'rejected_from_manager';
    public const STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY = 'to_review_from_manager_to_treasury';
    public const STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY = 'to_review_from_accountant_to_treasury';
    public const STATUS_VALIDATED_FROM_TREASURY = 'validated_from_treasury';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $totalAmount = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?int $advancedTotalAmount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private array $currentPlace;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'expense', targetEntity: ExpenseItem::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $expenseItems;

    #[ORM\Column(length: 100)]
    private ?string $status = null;

    public function __construct()
    {
        $this->expenseItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(int $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateCreation(): ?DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCurrentPlace(): array
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace, $context = []): void
    {
        $this->currentPlace = $currentPlace;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusForDisplay(): ?string
    {
        return Status::fromString($this->status)->getValue();
    }

    public function setExpenseItems(ArrayCollection|Collection $expenseItems): self
    {
        $this->expenseItems = $expenseItems;

        return $this;
    }

    public function getExpenseItems(): Collection
    {
        return $this->expenseItems;
    }

    public function addExpenseItem(ExpenseItem $expenseItems): self
    {
        if (!$this->expenseItems->contains($expenseItems)) {
            $expenseItems->setExpense($this);
            $this->expenseItems->add($expenseItems);
        }

        return $this;
    }

    public function removeExpenseItem(ExpenseItem $expenseItems): self
    {
        if ($this->expenseItems->contains($expenseItems)) {
            $this->expenseItems->removeElement($expenseItems);
        }

        return $this;
    }

    public function getAdvancedTotalAmount(): ?int
    {
        return $this->advancedTotalAmount;
    }

    public function setAdvancedTotalAmount(?int $advancedTotalAmount): self
    {
        $this->advancedTotalAmount = $advancedTotalAmount;

        return $this;
    }
}
