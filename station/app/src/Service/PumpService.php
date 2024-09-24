<?php

namespace App\Service;


use App\Entity\Pump;
use App\Entity\Shift;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Throwable;

class PumpService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function createOrUpdatePump(Pump $pump): void
    {
        try {
            $this->entityManager->persist($pump);
            $this->entityManager->flush();
        }catch (Throwable){
            throw new LogicException('Error when inserting the pump');
        }
    }

    public function startOrEndShift(Shift $shift): void
    {
        try {
            $this->entityManager->persist($shift);
            $this->entityManager->flush();
        }catch (Throwable){
            throw new LogicException('Error when inserting the shift');
        }
    }
}
