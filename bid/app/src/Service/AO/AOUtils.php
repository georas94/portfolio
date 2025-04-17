<?php

namespace App\Service\AO;

use App\Entity\AO;
use App\Entity\AOLog;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AOUtils
{
    public static function logChanges(AO $ao, User $user, EntityManagerInterface $entityManager, string $action, array $changes = []): void
    {
        $log = new AOLog();
        $log->setAo($ao);
        $log->setUser($user);
        $log->setChangedAt(new \DateTime());
        $log->setAction($action);
        $log->setChanges($changes);

        $entityManager->persist($log);
    }

    public static function getEntityChanges(AO $original, AO $updated): array
    {
        $changes = [];

        $reflection = new \ReflectionClass(AO::class);
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $propName = $property->getName();

            $oldValue = $property->getValue($original);
            $newValue = $property->getValue($updated);

            if ($oldValue != $newValue) {
                $changes[$propName] = [
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }

        return $changes;
    }
}