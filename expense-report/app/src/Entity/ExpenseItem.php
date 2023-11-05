<?php

namespace App\Entity;

use App\ValueObject\ExpenseType as ExpenseTypeVO;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity]
#[Vich\Uploadable]
class ExpenseItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Expense::class, inversedBy: 'expenseItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Expense $expense;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $amount = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(length: 255)]
    private ?string $expenseType = null;

    #[ORM\Column]
    private ?bool $isAdvanceTaken = null;

    #[ORM\Column(nullable: true)]
    private ?int $advancedFeesAmount = null;

    #[Vich\UploadableField(mapping: 'expenses', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;


    public function getTypeForDisplay(): ?string
    {
        return ExpenseTypeVO::fromString($this->expenseType)->getValue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getExpenseType(): ?string
    {
        return $this->expenseType;
    }

    public function setExpenseType(?string $expenseType): void
    {
        $this->expenseType = $expenseType;
    }

    public function getIsAdvanceTaken(): ?bool
    {
        return $this->isAdvanceTaken;
    }

    public function setIsAdvanceTaken(?bool $isAdvanceTaken): void
    {
        $this->isAdvanceTaken = $isAdvanceTaken;
    }

    public function getAdvancedFeesAmount(): ?int
    {
        return $this->advancedFeesAmount;
    }

    public function setAdvancedFeesAmount(?int $advancedFeesAmount): void
    {
        $this->advancedFeesAmount = $advancedFeesAmount;
    }

    public function getExpense(): ?Expense
    {
        return $this->expense;
    }

    public function setExpense(?Expense $expense): self
    {
        $this->expense = $expense;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
}