<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\RoleString;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'user_';
    private const NB_USERS = 50;

    private UserPasswordHasherInterface $hasher;
    private $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Faker\Factory::create();
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        /** Users **/

        // principal admin user
        $adminUser = new User();
        $adminUser->setEmail('admin@admin.com');
        $adminUser->setFirstname($this->faker->firstName());
        $adminUser->setLastname($this->faker->lastName());
        $password = $this->hasher->hashPassword($adminUser, 'admin');
        $adminUser->setPassword($password);
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setIsPasswordChanged(true);
        $adminUser->setCreatedBy($adminUser);
        $manager->persist($adminUser);

        // create lambda users
        //store user id to add reference
        $userId = 1;
        for ($i = 0; $i < self::NB_USERS; $i++) {
            $user = new User();
            $user->setEmail('user' . $userId . '@frais.com');
            $user->setFirstname($this->faker->firstName());
            $user->setLastname($this->faker->lastName());
            $password = $this->hasher->hashPassword($user, 'pass'.$userId);
            $user->setPassword($password);
            $user->setIsPasswordChanged(false);
            $user->setCreatedBy($adminUser);
            switch ($userId){
                case 1:
                case 7:
                    $user->setRoles([RoleString::ROLE_ACCOUNTANT->name]);
                    break;
                case 2:
                case 5:
                    $user->setRoles([RoleString::ROLE_MANAGER->name]);
                    break;
                case 3:
                case 4:
                    $user->setRoles([RoleString::ROLE_TREASURER->name]);
                    break;
                default:
                    $user->setRoles([RoleString::ROLE_EMPLOYEE->name]);
                    break;
            }
            $this->addReference(self::USER_REFERENCE . $userId, $user);
            $userId++;
            $manager->persist($user);
        }

        $manager->flush();
    }
}
