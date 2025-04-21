<?php

namespace App\Repository;

use App\Entity\AO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**∞
 * @extends ServiceEntityRepository<AO>
 *
 * @method AO|null find($id, $lockMode = null, $lockVersion = null)
 * @method AO|null findOneBy(array $criteria, array $orderBy = null)
 * @method AO[]    findAll()
 * @method AO[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AO::class);
    }

    public function searchFiltered(string $term, ?float $budgetMin, ?float $budgetMax): array
    {
        $qb = $this->createQueryBuilder('ao')
            ->join('ao.entreprise', 'e')
            ->addSelect('e');

        if ($term) {
            $qb->andWhere('ao.nom LIKE :term OR e.nom LIKE :term')
                ->setParameter('term', "%$term%");
        }

        if ($budgetMin) {
            $qb->andWhere('ao.budget >= :budgetMin')
                ->setParameter('budgetMin', $budgetMin);
        }

        if ($budgetMax) {
            $qb->andWhere('ao.budget <= :budgetMax')
                ->setParameter('budgetMax', $budgetMax);
        }

        return $qb->getQuery()->getResult();
    }
}