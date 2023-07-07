<?php

namespace App\Application\Sales;

use App\Domain\CommandHandling\Command;
use App\Domain\Sales\ShoppingCartId;
use Money\Money;

final readonly class PayShoppingCartCommand implements Command
{
    public function __construct(
        public ShoppingCartId $cartId,
        public string $memberId,
        public string $paymentMethod,
        public Money $paidPrice,
    )
    {
    }
}
