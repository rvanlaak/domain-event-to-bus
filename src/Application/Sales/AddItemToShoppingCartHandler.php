<?php

namespace App\Application\Sales;

use App\Domain\CommandHandling\Command;
use App\Domain\CommandHandling\CommandHandler;
use App\Domain\Sales\ShoppingCartId;
use App\Domain\Sales\ShoppingCartRepository;

final readonly class AddItemToShoppingCartHandler implements CommandHandler
{
    public function __construct(private ShoppingCartRepository $cartRepository)
    {
    }

    public function handle(Command|AddItemToShoppingCartCommand $command): void
    {
        $cart = $this->cartRepository->get($command->cartId);

        $cart->addItem(
            $command->productName,
            $command->regularPrice,
            $command->salesPrice,
        );

        /**
         * Keep in mind, the flush does not do any domain event handling yet, that should solely happen when the flush
         * was successfully completed.
         *
         * @see AggregateRootDomainEventDispatcher
         */
        $this->cartRepository->flush();
    }
}
