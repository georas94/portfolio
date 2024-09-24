<?php

namespace App\Service;


use App\Entity\Tank;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Throwable;

class TankService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function createOrUpdateTank(Tank $tank): void
    {
        try {
            $this->entityManager->persist($tank);
            $this->entityManager->flush();
        }catch (Throwable){
            throw new LogicException();
        }
    }}
