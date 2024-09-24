<?php

namespace App\DataFixtures;

use App\Entity\Carrier;
use App\Entity\Customer;
use App\Entity\DeliveryNotes;
use App\Entity\Invoice;
use App\Entity\Pump;
use App\Entity\Tank;
use App\Entity\User;
use App\Enum\FuelTypeString;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_USERS = 15;
    private const NB_PUMP = 5;
    private const NB_TANKS = 3;
    private const NB_CARRIER = 15;

    private UserPasswordHasherInterface $hasher;
    private $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // users
        // create 3 lambda user
        $users = [];
        for ($i = 0; $i < self::NB_USERS; $i++) {
            $user = new User();
            $user->setEmail('user'.$i . '@station.com');
            $user->setLastname($this->faker->lastName());
            $user->setFirstname($this->faker->firstName());
            $user->setPhoneNumber($this->faker->unique()->e164PhoneNumber());
            $password = $this->hasher->hashPassword($user, 'pass'.$i);
            $user->setPassword($password);
            $user->setRoles([]);
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $users[$i] = $user;
            $manager->persist($user);
        }
        // create pump
        for ($i = 0; $i < self::NB_TANKS; $i++) {
            $pump = new Pump();
            $pump->setEssenceQuantity($this->faker->randomFloat(2, 500.678, 900.53));
            $pump->setGasoilQuantity($this->faker->randomFloat(2, 500.678, 900.53));
            $pump->setCreatedAt(new \DateTime());
            $pump->setUpdatedAt(new \DateTime());
            $manager->persist($pump);
        }
        // create tanks
        $fuelTypes = [FuelTypeString::TYPE_DIESEL->value, FuelTypeString::TYPE_ESSENCE->value];
        for ($i = 0; $i < self::NB_PUMP; $i++) {
            $tank = new Tank();
            $tank->setQuantityAvailable($this->faker->randomFloat(2, 1100.43, 4000));
            $tank->setFuelType($fuelTypes[$this->faker->randomFloat(0, 0, 1)]);
            $tank->setVolume(6000);
            $tank->setName('Cuve '.($i + 1));
            $tank->setCreatedAt(new \DateTime());
            $tank->setUpdatedAt(new \DateTime());
            $manager->persist($tank);
        }
        $carriers = [];
        // create carriers
        for ($i = 0; $i < self::NB_CARRIER; $i++) {
            $carrier = new Carrier();
            $carrier->setAddress($this->faker->address);
            $carrier->setIsActive(true);
            $carrier->setName($this->faker->company);
            $carrier->setOrdersDelivered($this->faker->randomFloat(0, 10, 30));
            $carrier->setOrdersNotDelivered($this->faker->randomFloat(0, 3, 8));
            $carrier->setCreatedAt(new \DateTime());
            $carrier->setUpdatedAt(new \DateTime());
            $carriers[$i] = $carrier;
            $manager->persist($carrier);
        }
        // create customers
        $customers = [];
        for ($i = 0; $i < self::NB_CARRIER; $i++) {
            $customer = new Customer();
            $customer->setAddress($this->faker->address);
            $customer->setName($this->faker->name);
            $customer->setEmail($this->faker->email);
            $customer->setPhoneNumber($this->faker->phoneNumber);
            $customer->setCreatedAt(new \DateTime());
            $customer->setUpdatedAt(new \DateTime());
            $customers[$i] = $customer;
            $manager->persist($customer);
        }
        // create deliveryNotes
        for ($i = 0; $i < self::NB_CARRIER; $i++) {
            $deliveryNotes = new DeliveryNotes();
            $deliveryNotes->setNotes($this->faker->text);
            $deliveryNotes->setCarrier($carriers[$i]);
            $deliveryNotes->setCustomer($customers[$i]);
            $deliveryNotes->setIsPaid(true);
            $deliveryNotes->setCreatedAt(new \DateTime());
            $deliveryNotes->setUpdatedAt(new \DateTime());
            $manager->persist($deliveryNotes);
        }
        // create invoice
        for ($i = 0; $i < self::NB_CARRIER; $i++) {
            $invoice = new Invoice();
            $invoice->setInvoiceNumber($this->faker->uuid());
            $invoice->setCustomer($customers[$i]);
            $invoice->setProcesor($users[$i]);
            $invoice->setTotal($this->faker->randomFloat(2, 3000000, 8000000));
            $invoice->setCreatedAt(new \DateTime());
            $invoice->setUpdatedAt(new \DateTime());
            $manager->persist($invoice);
        }
        // principal admin user
        $user = new User();
        $user->setEmail('admin@station.com');
        $user->setLastname($this->faker->lastName());
        $user->setFirstname($this->faker->firstName());
        $password = $this->hasher->hashPassword($user, 'admin');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPhoneNumber($this->faker->unique()->e164PhoneNumber());
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $manager->persist($user);

        $manager->flush();
    }
}
