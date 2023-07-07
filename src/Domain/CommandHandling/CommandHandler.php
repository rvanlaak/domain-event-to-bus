<?php

namespace App\Domain\CommandHandling;

/**
 * The implementations of the command handler could automatically get registered to the DI container, so during
 * application compilation the handlers can automatically get registered to the command bus to handle their
 * typehinted commands.
 */
interface CommandHandler
{
    public function handle(Command $command): void;
}