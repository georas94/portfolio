<?php

namespace App\Repository;

use App\Entity\Purchase;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Purchase>
 *
 * @method Purchase|null find($id, $lockMode = null, $lockVersion = null)
 * @method Purchase|null findOneBy(array $criteria, array $orderBy = null)
 * @method Purchase[]    findAll()
 * @method Purchase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Purchase::class);
    }

    public function save(Purchase $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Purchase $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Finds carts that have not been modified since the given date.
     *
     * @param DateTime $limitDate
     * @param int $limit
     *
     * @return array
     */
    public function findCartsNotModifiedSince(DateTime $limitDate, int $limit = 10): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.status = :status')
            ->andWhere('o.updatedAt < :date')
            ->setParameter('status', Purchase::STATUS_CART)
            ->setParameter('date', $limitDate)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
