<?php

namespace App\Domain\Order;

use App\Domain\EventHandling\DomainEvent;
use Money\Money;

/**
 * This event carries the data that is valuable to the outside world, to notifying interested consumers that
 * an order was paid.
 */
class OrderWasPaid implements DomainEvent
{
    public function __construct(
        public OrderId $orderId,
        public string $memberId,
        public Money $pricePaid,
    )
    {
    }
}
