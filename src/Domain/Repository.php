<?php

namespace App\Domain;

/**
 * Repositories are responsible for reading aggregate roots, and to persist and flush write actions on aggregate roots
 * to the implementing persistence layer (e.g. the database, or remote API).
 */
interface Repository
{
    /**
     * Registers a root entity to the unit of work of the persistence layer.
     */
    public function persist(AggregateRoot $entity): void;

    /**
     * Will flush all changes that are registered to the entities in the unit of work of the persistence layer.
     *
     * This method is not responsible for recording nor dispatching the domain events.
     */
    public function flush(): void;

    /**
     * Returns all aggregate roots that currently are under management, and that thereby possibly could have recorded
     * domain events after write.
     *
     * @return AggregateRoot[]
     */
    public function getAllManagedAggregateRoots(): array;
}