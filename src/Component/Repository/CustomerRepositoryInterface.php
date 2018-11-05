<?php

namespace App\Component\Repository;

use App\Component\Model\CustomerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    /**
     * @return int
     */
    public function countCustomers(): int;

    /**
     * @param int $count
     *
     * @return array|CustomerInterface[]
     */
    public function findLatest(int $count): array;
}
