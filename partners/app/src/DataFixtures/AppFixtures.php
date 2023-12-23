<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\ApplicationRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_USERS = 3;

    private UserPasswordHasherInterface $hasher;
    private $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Faker\Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        // users roles

        //principal user role
        $teamMemberApplicationRole = new ApplicationRole();
        $teamMemberApplicationRole->setDescription('Team member role');
        $teamMemberApplicationRole->setName('Team member');
        $teamMemberApplicationRole->setIsActive(true);
        $buyerApplicationRole = new ApplicationRole();
        $buyerApplicationRole->setDescription('Buyer role');
        $buyerApplicationRole->setName('Buyer');
        $buyerApplicationRole->setIsActive(true);
        $manager->persist($teamMemberApplicationRole);
        $manager->persist($buyerApplicationRole);

        // users
        // create 3 lambda user
        for ($i = 0; $i < self::NB_USERS; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setName($this->faker->lastName());
            $user->setSurname($this->faker->firstName());
            $user->setIsVerified(true);
            $password = $this->hasher->hashPassword($user, 'pass'.$i);
            $user->setPassword($password);
            $user->setRoles([]);
            $user->setApplicationRole($buyerApplicationRole);
            $manager->persist($user);
        }
        // principal admin user
        $user = new User();
        $user->setEmail('admin@fere.com');
        $user->setName($this->faker->lastName());
        $user->setSurname($this->faker->firstName());
        $user->setIsVerified(true);
        $password = $this->hasher->hashPassword($user, 'rashid');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setApplicationRole($teamMemberApplicationRole);
        $manager->persist($user);

        $manager->flush();
    }
}
