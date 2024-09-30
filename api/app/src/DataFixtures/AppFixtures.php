<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    private const NB_USERS = 50;

//    private UserPasswordHasherInterface $hasher;
    private $faker;

    public function __construct()
    {
//        $this->hasher = $hasher;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::NB_USERS; $i++) {
            $user = new User();
            $user->setName($this->faker->lastName());
            $user->setEmail('user'.$i . '@station.com');
            $user->setPhoneNumber($this->faker->unique()->e164PhoneNumber());
            $manager->persist($user);
        }
        $manager->flush();
    }
}
