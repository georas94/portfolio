<?php

namespace App\DataFixtures;

use App\Entity\Tank;
use App\Entity\User;
use App\Enum\FuelTypeString;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    private const NB_USERS = 50;
    private const NB_TANKS = 8;

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

        // create tanks
        $fuelTypes = [FuelTypeString::TYPE_DIESEL->value, FuelTypeString::TYPE_ESSENCE->value];
        for ($i = 0; $i < self::NB_TANKS; $i++) {
            $tank = new Tank();
            $tank->setQuantityAvailable($this->faker->randomFloat(2, 1100.43, 5000));
            $tank->setFuelType($fuelTypes[$this->faker->randomFloat(0, 0, 1)]);
            $tank->setVolume(6000);
            $tank->setName('Cuve '.($i + 1));
            $manager->persist($tank);
        }

        $manager->flush();
    }
}
