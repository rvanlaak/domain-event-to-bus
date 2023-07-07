<?php

namespace App\Domain;

use App\Domain\EventHandling\DomainEvent;

/**
 * Abstract helper methods that will allow aggregate roots to record domain events.
 */
trait EventRecordingCapability
{
    /** @var DomainEvent[] */
    private array $events = [];

    /**
     * @return DomainEvent[]
     */
    public function getRecordedEvents(): iterable
    {
        yield $this->events;

        $this->events = [];
    }

    /**
     * Temporarily store a domain event with data about the intent on why the write model has changed.
     *
     * Ideally this method should be defined as protected method on the AggregateRoot interface, but PHP as language
     * does not support that.
     */
    protected function recordEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }
}
