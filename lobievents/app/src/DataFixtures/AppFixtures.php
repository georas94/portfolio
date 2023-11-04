<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_PRODUCTS = 50;
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
        // users
        // create 3 lambda user
        for ($i = 0; $i < self::NB_USERS; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setName($this->faker->lastName());
            $user->setSurname($this->faker->firstName());
            $user->setIsVerified(true);
            $user->setIsSeller(false);
            $password = $this->hasher->hashPassword($user, 'pass'.$i);
            $user->setPassword($password);
            $user->setRoles([]);
            $manager->persist($user);
        }
        // principal admin user
        $user = new User();
        $user->setEmail('admin@fere.com');
        $user->setName($this->faker->lastName());
        $user->setSurname($this->faker->firstName());
        $user->setIsVerified(true);
        $user->setIsSeller(true);
        $password = $this->hasher->hashPassword($user, 'rashid');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        // products
        $productCategory1 = new ProductCategory();
        $productCategory1->setName('catégorie 1');
        $productCategory1->setIsActive(true);
        $manager->persist($productCategory1);
        $productCategory2 = new ProductCategory();
        $productCategory2->setName('catégorie 2');
        $productCategory2->setIsActive(false);
        $manager->persist($productCategory2);
        // create n number products
        for ($i = 0; $i < self::NB_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName($this->faker->word());
            $product->setReference($this->faker->uuid());
            $product->setPrice($this->faker->randomFloat(2, 30000, 650000));
            $product->setRated($this->faker->numberBetween(0, 5));
            if ($i % 2 === 0){
                $product->setCategory($productCategory1);
            }else{
                $product->setCategory($productCategory2);
            }

            $manager->persist($product);
        }

        $manager->flush();
    }
}
