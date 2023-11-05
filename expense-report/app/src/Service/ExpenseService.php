<?php

namespace App\Service;

use App\Entity\Expense;
use App\Entity\ExpenseItem;
use App\Entity\User;
use App\Enum\RoleString;
use App\Enum\Status;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use LogicException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

class ExpenseService
{
    const MAX_EXPENSE_ACCOUNTING_AMOUNT = 100000;
    private EntityManagerInterface $entityManager;
    private WorkflowInterface $expenseWorkflow;
    private DocumentService $documentService;
    private TranslatorInterface $translatorInterface;

    public function __construct(EntityManagerInterface $entityManager, WorkflowInterface $expenseWorkflow, DocumentService $documentService, TranslatorInterface $translatorInterface)
    {
        $this->entityManager = $entityManager;
        $this->expenseWorkflow = $expenseWorkflow;
        $this->documentService = $documentService;
        $this->translatorInterface = $translatorInterface;
    }

    public static function canEdit(Expense $expense, UserInterface $user): bool
    {
        switch ($expense->getStatus()) {
            case Expense::STATUS_DRAFT:
                if (in_array(RoleString::ROLE_EMPLOYEE->name, $user->getRoles(), true)) {
                    return true;
                }
                return false;
            case Expense::STATUS_TO_REVIEW_ACCOUNTING:
                if (in_array(RoleString::ROLE_ACCOUNTANT->name, $user->getRoles(), true)) {
                    return true;
                }
                return false;
            case Expense::STATUS_TO_REVIEW_MANAGER:
                if (in_array(RoleString::ROLE_MANAGER->name, $user->getRoles(), true)) {
                    return true;
                }
                return false;
            default:
                return false;
        }
    }

    public function canSendToManager(Expense $expense): bool
    {
        if ($this->expenseWorkflow->can($expense, Expense::STATUS_TO_REVIEW_MANAGER)){
            return true;
        }
        return false;
    }

    public function canSendToTreasury(Expense $expense, User $user): bool
    {
        switch (current($user->getRoles())) {
            case RoleString::ROLE_ACCOUNTANT->name:
                if($expense->getStatus() === Expense::STATUS_TO_REVIEW_ACCOUNTING && $expense->getTotalAmount() <= self::MAX_EXPENSE_ACCOUNTING_AMOUNT){
                    return true;
                }
                return false;
            case RoleString::ROLE_MANAGER->name:
                if($expense->getStatus() === Expense::STATUS_TO_REVIEW_MANAGER){
                    return true;
                }
                return false;
            default:
               return false;
        }
    }

    public static function canReject(Expense $expense): bool
    {
        return match ($expense->getStatus()) {
            Expense::STATUS_TO_REVIEW_ACCOUNTING, Expense::STATUS_TO_REVIEW_MANAGER => true,
            default => false,
        };
    }

    public static function getStatusWhichUserCanValidate(UserInterface $user): array
    {
        switch (current($user->getRoles())) {
            case RoleString::ROLE_ACCOUNTANT->name:
                return [Expense::STATUS_TO_REVIEW_ACCOUNTING];
            case RoleString::ROLE_MANAGER->name:
                return [Expense::STATUS_TO_REVIEW_MANAGER];
            case RoleString::ROLE_TREASURER->name:
                return [Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY, Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY];
            default:
                return [];
        }
    }

    public function sendExpenseToNextLevel(Expense $expense): void
    {
        $this->entityManager->beginTransaction();
        try {
            switch ($expense->getStatus()) {
                case Expense::STATUS_TO_REVIEW_ACCOUNTING:
                    if ($this->expenseWorkflow->can($expense, Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY)) {
                        $this->expenseWorkflow->apply($expense, Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY);
                        $expense->setStatus(Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY);
                        break;
                    }
                    throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY);
                case Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY:
                case Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY:
                if ($this->expenseWorkflow->can($expense, Expense::STATUS_VALIDATED_FROM_TREASURY)) {
                    $this->expenseWorkflow->apply($expense, Expense::STATUS_VALIDATED_FROM_TREASURY);
                    $expense->setStatus(Expense::STATUS_VALIDATED_FROM_TREASURY);
                    break;
                }
                throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_VALIDATED_FROM_TREASURY);
                case Expense::STATUS_TO_REVIEW_MANAGER:
                    if ($this->expenseWorkflow->can($expense, Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY)) {
                        $this->expenseWorkflow->apply($expense, Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY);
                        $expense->setStatus(Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY);
                        break;
                    }
                    throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY);
                default:
                    break;
            }
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Throwable $exception) {
            $this->entityManager->rollback();
            throw new LogicException($exception->getMessage());
        }
    }

    public function rejectExpense(Expense $expense): ?Expense
    {
        $this->entityManager->beginTransaction();
        try {
            switch ($expense->getStatus()) {
                case Expense::STATUS_DRAFT:
                    if ($this->expenseWorkflow->can($expense, Expense::STATUS_REJECTED_FROM_DRAFT)) {
                        $this->expenseWorkflow->apply($expense, Expense::STATUS_REJECTED_FROM_DRAFT);
                        $expense->setStatus(Expense::STATUS_REJECTED_FROM_DRAFT);
                        break;
                    }
                    throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_REJECTED_FROM_DRAFT);
                case Expense::STATUS_TO_REVIEW_ACCOUNTING:
                    if ($this->expenseWorkflow->can($expense, Expense::STATUS_REJECTED_FROM_ACCOUNTING)) {
                        $this->expenseWorkflow->apply($expense, Expense::STATUS_REJECTED_FROM_ACCOUNTING);
                        $expense->setStatus(Expense::STATUS_REJECTED_FROM_ACCOUNTING);
                        break;
                    }
                    throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_REJECTED_FROM_ACCOUNTING);
                case Expense::STATUS_TO_REVIEW_MANAGER:
                    if ($this->expenseWorkflow->can($expense, Expense::STATUS_REJECTED_FROM_MANAGER)) {
                        $this->expenseWorkflow->apply($expense, Expense::STATUS_REJECTED_FROM_MANAGER);
                        $expense->setStatus(Expense::STATUS_REJECTED_FROM_MANAGER);
                        break;
                    }
                    throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_REJECTED_FROM_MANAGER);
                default:
                    break;
            }
            $this->entityManager->flush();
            $this->entityManager->commit();
            return $expense;
        } catch (Throwable $exception) {
            $this->entityManager->rollback();
            throw new LogicException($exception->getMessage());
        }
    }

    public function sendToManager(Expense $expense): void
    {
        $this->entityManager->beginTransaction();
        try {
            if ($this->expenseWorkflow->can($expense, Expense::STATUS_TO_REVIEW_MANAGER)) {
                $this->expenseWorkflow->apply($expense, Expense::STATUS_TO_REVIEW_MANAGER);
                $expense->setStatus(Expense::STATUS_TO_REVIEW_MANAGER);
                $this->entityManager->flush();
                $this->entityManager->commit();
            } else {
                throw new LogicException('Cannot perform transition ' . $expense->getStatus() . ' to ' . Expense::STATUS_TO_REVIEW_MANAGER);
            }
        } catch (Throwable $exception) {
            $this->entityManager->rollback();
            throw new LogicException($exception->getMessage());
        }

    }

    public function updateEmployeeExpense(Expense $expense, ExpenseItem $expenseItem): ?Expense
    {
        $this->entityManager->beginTransaction();
        try {
            if ($this->expenseWorkflow->can($expense, Expense::STATUS_TO_REVIEW_ACCOUNTING)) {
                $this->expenseWorkflow->apply($expense, Expense::STATUS_TO_REVIEW_ACCOUNTING);
                $expense->setStatus(Expense::STATUS_TO_REVIEW_ACCOUNTING);
            }
            $amounts = $this->getExpenseTotalAmount($expense);
            if($amounts['amountTotal'] <= 0){
                throw new Exception($this->translatorInterface->trans('app.error.expense.employee.update.totalAmount'));
            }

            $expense->setTotalAmount($amounts['amountTotal']);
            $expense->setAdvancedTotalAmount($amounts['advancedAmountTotal']);
            $this->entityManager->persist($expense);
            $this->entityManager->flush();
            $this->entityManager->commit();
            return $expense;
        }catch (Throwable $exception){
            $this->entityManager->rollback();
            $this->documentService->deleteLocalDocument($expenseItem->getImageFile()->getFilename());
            throw new LogicException($exception->getMessage());
        }
    }

    public function createEmployeeDraftExpense(User $user, Expense $expense): void
    {
        try {
            $currentDate = new DateTime('now', new DateTimeZone('Africa/Ouagadougou'));
            $this->expenseWorkflow->getMarking($expense);
            $expense->setStatus(Expense::STATUS_DRAFT);
            $expense->setDateCreation($currentDate);
            $expense->setDate($currentDate);
            $expense->setTotalAmount(0);
            $expense->setAdvancedTotalAmount(0);
            $expense->setUser($user);
        }catch (Throwable){
            throw new LogicException($this->translatorInterface->trans('app.error.user.employee.create'));
        }
    }

    public function getExpenseTotalAmount(Expense $expense): array
    {
        $amountTotal = 0;
        $advancedAmountTotal = 0;
        /** @var ExpenseItem $expenseItem */
        foreach ($expense->getExpenseItems() as $expenseItem) {
            $amountTotal += $expenseItem->getAmount();
            if($expenseItem->getAdvancedFeesAmount()){
                $advancedAmountTotal += $expenseItem->getAdvancedFeesAmount();
            }
        }

        return ['amountTotal' => $amountTotal, 'advancedAmountTotal' => $advancedAmountTotal];
    }
}