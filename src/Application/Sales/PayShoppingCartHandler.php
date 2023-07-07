<?php

namespace App\Application\Sales;

use App\Domain\CommandHandling\Command;
use App\Domain\CommandHandling\CommandHandler;
use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;
use App\Domain\Sales\ShoppingCartRepository;

final readonly class PayShoppingCartHandler implements CommandHandler
{
    public function __construct(
        private ShoppingCartRepository $cartRepository,
        private OrderRepository $orderRepository,
    )
    {
    }

    public function handle(Command|PayShoppingCartCommand $command): void
    {
        $cart = $this->cartRepository->get($command->cartId);

        $order = Order::fromPaidPayment($cart, $command->paidPrice);

        $this->orderRepository->persist($order);

        /**
         * Some commandBus middleware implementations even have a middleware at the end of the chain that do the flush
         * in order to only have to do one single transaction.
         *
         * Keep in mind, the flush does not do any domain event handling yet, that should solely happen when the flush
         * was successfully completed.
         *
         * @see AggregateRootDomainEventDispatcher
         */
        $this->cartRepository->flush();
        $this->orderRepository->flush();
    }
}
