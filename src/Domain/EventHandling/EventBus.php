<?php

namespace App\Domain\EventHandling;

use App\Domain\EventHandling\DomainEvent;

/**
 * Bus that is responsible for dispatching domain events that did happen while executing a command.
 */
interface EventBus
{
    /**
     * Allows dispatching one or more domain events to tell the outside world something intentful happened.
     */
    public function dispatch(DomainEvent ... $event): void;
}
