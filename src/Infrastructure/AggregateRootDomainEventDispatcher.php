<?php

namespace App\Infrastructure;

use App\Domain\AggregateRoot;
use App\Domain\EventHandling\DomainEvent;
use App\Domain\EventHandling\EventBus;
use App\Domain\Repository;

/**
 * On compilation of the framework, this manager gets injected all instances of repositories, so it is aware for which
 * aggregate roots it has to handle events after flush.
 */
final readonly class AggregateRootDomainEventDispatcher
{
    /**
     * @param Repository[] $repositories
     */
    public function __construct(
        private array $repositories,
        private EventBus $eventBus,
    )
    {
    }

    /**
     * On the chosen framework, this method would get registered on the event dispatcher to run after a flush of the
     * repositories happened.
     */
    public function afterFlush(): void
    {
        /** @var AggregateRoot[] $allAllAggregateRoots */
        $allAllAggregateRoots = array_merge_recursive(...array_map(
            static fn(Repository $repository) => $repository->getAllManagedAggregateRoots(),
            $this->repositories
        ));

        /** @var DomainEvent[] $eventsToPublish */
        $eventsToPublish = array_map(
            static fn(AggregateRoot $aggregateRoot) => $aggregateRoot->getRecordedEvents(),
            $allAllAggregateRoots
        );

        /**
         * As dispatching events happens after the flush, it is decoupled from the repository transaction and will
         * only happen when that database / API transaction is successful.
         */
        $this->eventBus->dispatch(...$eventsToPublish);
    }
}
