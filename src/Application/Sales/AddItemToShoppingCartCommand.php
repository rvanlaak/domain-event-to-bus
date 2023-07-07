<?php

namespace App\Application\Sales;

use App\Domain\CommandHandling\Command;
use App\Domain\Sales\ShoppingCartId;
use Money\Money;

/**
 * Lightweight DTO to trigger adding an item to a shopping cart.
 *
 * Do not pass the shopping cart itself and it's state on the command bus, as its latest state should be fetched from
 * the database when handling the command.
 */
final readonly class AddItemToShoppingCartCommand implements Command
{
    public function __construct(
        public ShoppingCartId $cartId,
        public string $productName,
        public Money $regularPrice,
        public Money $salesPrice,
    )
    {
    }
}
