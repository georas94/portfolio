<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Crée un utilisateur admin en production'
)]
class CreateAdminCommand extends Command
{
    private  EntityManagerInterface $em;
    private  UserPasswordHasherInterface $hasher;
    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ) {
        $this->em = $em;
        $this->hasher = $hasher;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email admin')
            ->addArgument('password', InputArgument::REQUIRED, 'Mot de passe')
            ->addOption(
                'env',
                null,
                InputOption::VALUE_OPTIONAL,
                'Environnement',
                'dev'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $env = $input->getOption('env');

        if ($env === 'prod') {
            $io->warning('Vous êtes en environnement PRODUCTION');
            if (!$io->confirm('Continuer ?', false)) {
                return Command::FAILURE;
            }
        }

        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        // Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $io->error('Email invalide');
            return Command::FAILURE;
        }

        if (strlen($password) < 12) {
            $io->error('Le mot de passe doit faire au moins 12 caractères');
            return Command::FAILURE;
        }

        // Création
        $admin = new User();
        $admin->setEmail($email)
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($admin, $password));
        $admin->setIsValid(true);
        $admin->setFirstname('Admin');
        $admin->setLastname('Admin');
        $admin->setPhoneNumber('+22670374624');

        $this->em->persist($admin);
        $this->em->flush();

        $io->success(sprintf('Admin %s créé avec succès', $email));
        return Command::SUCCESS;
    }
}