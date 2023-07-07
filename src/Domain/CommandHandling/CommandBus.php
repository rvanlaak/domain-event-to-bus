<?php

namespace App\Domain\CommandHandling;

interface CommandBus
{
    public function dispatch(Command $command): void;
}