<?php

namespace App\Domain\Sales;

use App\Domain\EventHandling\DomainEvent;

final readonly class ItemWasAddedToCart implements DomainEvent
{
    public function __construct(
        public ShoppingCartId $id,
        public string $memberId,
        public string $productName,
    )
    {
    }
}
