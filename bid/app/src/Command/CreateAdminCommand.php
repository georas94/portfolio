<?php

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create-admin')]
class CreateAdminCommand extends Command
{
    public function __construct(readonly UserPasswordHasherInterface $passwordHasher,
                                readonly UserRepository $userRepository,
                                readonly EntityManagerInterface $entityManager,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($this->userRepository->findOneBy(['email' => $input->getArgument('email')])) {
            $io->error('Admin existe déjà !');
            return Command::FAILURE;
        }

        $admin = new User();
        $admin->setEmail('admin@ao.bf')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordHasher->hashPassword(
                $admin,
                'rashid'
            ))
            ->setIsValid(true);
        $admin->setFirstname('Admin');
        $admin->setLastname('Admin');
        $admin->setPhoneNumber('+22670447553');
        $this->entityManager->persist($admin);

        $this->entityManager->flush();

        $io->success('Admin créé avec succès');
        return Command::SUCCESS;
    }
}