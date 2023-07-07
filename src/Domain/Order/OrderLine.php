<?php

namespace App\Domain\Order;

use Money\Money;

/**
 * The order line is a direct representation of a shopping basket item once a payment successfully has been made.
 */
final readonly class OrderLine
{
    public function __construct(
        public string $productName,
        public Money $regularPrice,
        public Money $paidDiscountPrice,
    )
    {
    }
}
