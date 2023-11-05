<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;

interface AbstractResultInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param mixed $additionalData
     * @return array
     */
    public function getResult(QueryBuilder $queryBuilder, mixed $additionalData): array;
}