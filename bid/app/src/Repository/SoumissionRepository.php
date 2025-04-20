<?php

namespace App\Repository;

use App\Entity\Soumission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**∞
 * @extends ServiceEntityRepository<Soumission>
 *
 * @method Soumission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soumission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soumission[]    findAll()
 * @method Soumission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoumissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soumission::class);
    }
}