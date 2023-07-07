<?php

namespace App\Domain\Order;

use Symfony\Component\Uid\Ulid;

final readonly class OrderId
{
    public string $id;

    public function __construct()
    {
        $this->id = Ulid::generate(new \DateTimeImmutable('now'));
    }
}
