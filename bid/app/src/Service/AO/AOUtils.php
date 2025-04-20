<?php

namespace App\Service\AO;

use App\Entity\AO;
use App\Entity\AOLog;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class AOUtils
{
    public function __construct(readonly EntityManagerInterface $entityManager)
    {
    }

    public function logChanges(AO $ao, User $user, string $action, array $changes = []): void
    {
        $log = new AOLog();
        $log->setAo($ao);
        $log->setUser($user);
        $log->setChangedAt(new \DateTime());
        $log->setAction($action);
        $log->setChanges($changes);

        $this->entityManager->persist($log);
    }

    public function logDocument(AO $ao, User $user, array $documentData, string $action): void
    {
        $log = new AOLog();
        $log->setAo($ao);
        $log->setUser($user);
        $log->setAction($action);
        $log->setChanges([
            'document_id' => $documentData['id'] ?? 0,
            'file_name' => $documentData['fileName'],
            'original_name' => $documentData['originalName']
        ]);
        $log->setChangedAt(new DateTimeImmutable());

        $this->entityManager->persist($log);
        $this->entityManager->flush();
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