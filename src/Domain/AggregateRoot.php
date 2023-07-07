<?php

namespace App\Domain;

use App\Domain\EventHandling\DomainEvent;

/**
 * Root entity within the bounded context, which is responsible for keeping track of all intent
 * that happened on changes to it's write model.
 *
 * The aggregate root domain write methods themselves are responsible for recording events.
 */
interface AggregateRoot
{
    /**
     * After calling this method, the aggregate its local storage with recorded events should be emptied.
     *
     * @return DomainEvent[]
     */
    public function getRecordedEvents(): iterable;
}
