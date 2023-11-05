<?php

namespace App\Repository;

use App\Entity\User;
use App\Enum\Role;
use App\Repository\ResultSet\UserResultSet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface, AbstractResultInterface
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct($registry, User::class);
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function getCreatedUsers(UserInterface $user): array
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->andWhere('u.createdBy = :user')
            ->setParameter(':user',  $user);

        $qb->addOrderBy('u.id', 'DESC');

        return $this->getResult($qb, $user);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function updatePassword(User $user, FormInterface $form): bool
    {
        $newHashedPassword = $this->userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData());

        $user->setPassword($newHashedPassword);
        $user->setIsPasswordChanged(true);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return true;
    }

    public function getResult(QueryBuilder $queryBuilder, mixed $additionalData): array
    {
        $result = [];
        /** @var User $user */
        foreach ($queryBuilder->getQuery()->getResult() as $user) {
            $result[] = new UserResultSet($user, Role::role(current($user->getRoles())));
        }

        return $result;
    }
}
