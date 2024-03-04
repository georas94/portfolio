<?php

namespace App\Repository;

use App\Entity\ShoppingCartItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShoppingCartItem>
 *
 * @method ShoppingCartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingCartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingCartItem[]    findAll()
 * @method ShoppingCartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingCartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingCartItem::class);
    }

    public function save(ShoppingCartItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShoppingCartItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
