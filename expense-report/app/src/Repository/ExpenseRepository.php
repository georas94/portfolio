<?php

namespace App\Repository;

use App\Entity\Expense;
use App\Entity\User;
use App\Repository\ResultSet\ExpenseResultSet;
use App\Service\ExpenseService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

class ExpenseRepository extends ServiceEntityRepository implements ExpenseRepositoryInterface, AbstractResultInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expense::class);
    }

    public function getManagerialExpenses(UserInterface $user): array
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e')
                    ->andWhere('e.status != :statusDraft')
                    ->andWhere('e.status != :statusRejectedFromDraft')
                    ->setParameter(':statusDraft',Expense::STATUS_DRAFT)
                    ->setParameter(':statusRejectedFromDraft', Expense::STATUS_REJECTED_FROM_DRAFT)
;
            $qb->addOrderBy('e.id', 'DESC')
            ;
        return $this->getResult($qb, $user);
    }

    public function getEmployeeExpenses(UserInterface $user): array
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e')
            ->andWhere('e.user = :user')
            ->andWhere('e.status != :statusDraft')
            ->andWhere('e.status != :statusRejectedFromDraft')
            ->setParameter(':user', $user)
            ->setParameter(':statusDraft',Expense::STATUS_DRAFT)
            ->setParameter(':statusRejectedFromDraft', Expense::STATUS_REJECTED_FROM_DRAFT);

        $qb->addOrderBy('e.id', 'DESC');

        return $this->getResult($qb, $user);
    }

    public function getManagerialExpensesToValidate(UserInterface $user): array
    {
        $arrayStatus = ExpenseService::getStatusWhichUserCanValidate($user);
        $qb = $this->createQueryBuilder('e')
            ->select('e')
            ->andWhere('e.status IN(:status)')
            ->setParameter(':status', implode(', ', $arrayStatus))
            ->setMaxResults(5);

        $qb->addOrderBy('e.id', 'DESC');
        return $this->getResult($qb, $user);
    }

    public function getResult(QueryBuilder $queryBuilder, mixed $additionalData): array
    {
        $result = [];
        foreach ($queryBuilder->getQuery()->getResult() as $item) {
            $resultSet = new ExpenseResultSet();
            $resultSet->setExpense($item);
            $resultSet->setCanEdit(ExpenseService::canEdit($item, $additionalData));
            $result[] = $resultSet;
        }

        return $result;
    }
}
