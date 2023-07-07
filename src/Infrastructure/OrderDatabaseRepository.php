<?php

namespace App\Infrastructure\Order;

use App\Domain\AggregateRoot;
use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;

final class OrderDatabaseRepository implements OrderRepository
{
    /**
     * Typically a ORM should take of this, but this is the simplified way how an Unit of Work gets managed.
     */
    private array $managedAggregateRoots = [];

    public function persist(Order|AggregateRoot $entity): void
    {
        // TODO: Implement persist() method.
    }

    public function flush(): void
    {
        // TODO: Implement flush() method.
    }

    public function getAllManagedAggregateRoots(): array
    {
        return $this->managedAggregateRoots;
    }

    public function __destruct()
    {
        $this->managedAggregateRoots = [];
    }
}
