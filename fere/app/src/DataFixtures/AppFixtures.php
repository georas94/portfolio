<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Inventory;
use App\Entity\PaymentType;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\Seller;
use App\Entity\User;
use App\Entity\ApplicationRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_PRODUCTS = 100;
    private const NB_USERS = 3;
    private const SIZES = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
    private const GENDERS = ['MEN', 'WOMEN', 'CHILDREN', 'ALL'];

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

        // products categories
        $productCategories = [];
        $productCategory1 = new ProductCategory();
        $productCategory1->setName('clothes');
        $productCategory1->setIsActive(true);
        $manager->persist($productCategory1);
        $productCategories[] = $productCategory1;
        $productCategory2 = new ProductCategory();
        $productCategory2->setName('beauty');
        $productCategory2->setIsActive(true);
        $manager->persist($productCategory2);
        $productCategories[] = $productCategory2;
        $productCategory3 = new ProductCategory();
        $productCategory3->setName('jewelry');
        $productCategory3->setIsActive(true);
        $manager->persist($productCategory3);
        $productCategories[] = $productCategory3;
        $productCategory4 = new ProductCategory();
        $productCategory4->setName('home');
        $productCategory4->setIsActive(true);
        $manager->persist($productCategory4);
        $productCategories[] = $productCategory4;

        //Seller
        $seller = new Seller();
        $sellerAddress = new Address();
        $sellerAddress->setComment('No comment');
        $sellerAddress->setLatitude('12.393230');
        $sellerAddress->setLongitude('-1.502792');
        $seller->setIsActive(true);
        $seller->setName('Seller 1');
        $seller->setAddress($sellerAddress);
        $seller->setRated($this->faker->randomFloat(1, 3.5, 5));
        $manager->persist($seller);

        // create n number products
        for ($i = 0; $i < self::NB_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName($this->faker->word());
            $product->setReference($this->faker->uuid());
            $product->setPrice($this->faker->randomFloat(0, 30000, 650000));
            $product->setRated($this->faker->randomFloat(1, 2.5, 5));
            $product->setSize(self::getRandomSize());
            $product->setCategory(self::getRandomProductCategory($productCategories));
            if($product->getCategory()->getName() === 'home'){
                $product->setGender('ALL');
            }else {
                $product->setGender(self::getRandomGender());
            }
            $product->setSeller($seller);

            $manager->persist($product);
            $inventory = new Inventory();
            $inventory->setQuantity(rand(1, 30));
            $inventory->setProduct($product);
            $manager->persist($inventory);
        }

        //Payment types
        $paymentType = new PaymentType();
        $paymentType->setIsActive(true);
        $paymentType->setOperatorName('Paypal');
        $manager->persist($paymentType);
        $paymentType2 = new PaymentType();
        $paymentType2->setIsActive(true);
        $paymentType2->setOperatorName('Orange Money');
        $manager->persist($paymentType2);
        $paymentType3 = new PaymentType();
        $paymentType3->setIsActive(true);
        $paymentType3->setOperatorName('Cash');
        $manager->persist($paymentType3);

        $manager->flush();
    }

    private static function getRandomSize(): string
    {
        return self::SIZES[rand(0, (count(self::SIZES)- 1))];
    }

    private static function getRandomGender(): string
    {
        return self::GENDERS[rand(0, (count(self::GENDERS)- 1))];
    }

    private static function getRandomProductCategory(array $products): ProductCategory
    {
        return $products[rand(0, (count($products)- 1))];
    }
}
