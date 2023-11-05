<?php


namespace App\Repository\ResultSet;

use App\Entity\Expense;

class ExpenseResultSet
{
    public Expense $expense;

    public bool $canEdit;

    public function getExpense(): Expense
    {
        return $this->expense;
    }

    public function canEdit(): bool
    {
        return $this->canEdit;
    }

    public function setCanEdit(bool $canEdit): void
    {
        $this->canEdit = $canEdit;
    }

    public function setExpense(Expense $expense): void
    {
        $this->expense = $expense;
    }

}
