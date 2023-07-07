<?php

namespace App\Infrastructure\EventHandling;

use App\Domain\EventHandling\DomainEvent;
use App\Domain\EventHandling\EventBus;

/**
 * Example stub implementation to explain how a domain event would get dispatched.
 */
class KafkaPublishingEventBus implements EventBus
{

    public function dispatch(DomainEvent $event): void
    {
        // TODO: Implement dispatch() method.
    }
}