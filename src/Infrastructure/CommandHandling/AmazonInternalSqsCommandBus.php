<?php

namespace App\Infrastructure\CommandHandling;

use App\Domain\CommandHandling\Command;
use App\Domain\CommandHandling\CommandBus;

/**
 * Example stub implementation to explain for running a command. See interface for clear description on the intent.
 */
class AmazonInternalSqsCommandBus implements CommandBus
{
    public function dispatch(Command $command): void
    {
        // TODO: Implement dispatch() method.
    }
}
