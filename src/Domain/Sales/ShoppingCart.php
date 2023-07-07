<?php

namespace App\Domain\Sales;

use App\Domain\AggregateRoot;
use App\Domain\EventRecordingCapability;
use App\Domain\Order\OrderLine;
use Money\Money;

final class ShoppingCart implements AggregateRoot
{
    use EventRecordingCapability;

    private readonly ShoppingCartId $id;

    /**
     * Cart items is mutable, and hence not readonly.
     *
     * @var array[array{'productName': string, "regularPrice": Money, "salesPrice": Money}]
     */
    private array $items = [];

    public function __construct(
        /**
         * Member id can not change on a cart, and hence is readonly.
         */
        public readonly string $memberId,
    )
    {
        $this->id = new ShoppingCartId();
    }

    public function addItem(string $productName, Money $regularPrice, Money $salesPrice): void
    {
        $this->items[] = [
            'productName' => $productName,
            'regularPrice' => $regularPrice,
            'salesPrice' => $salesPrice,
        ];
        $this->recordEvent(new ItemWasAddedToCart(
            $this->id,
            $this->memberId,
            $productName,
        ));
    }

    /**
     * Can get used while the cart would be marked as paid. It would be expected that the cart gets destroyed once the
     * successful payment was processed.
     *
     * @return OrderLine[]
     */
    public function toOrderLines(): array
    {
        if (empty($this->items)) {
            throw new \DomainException('Can not create order lines from empty basket.');
        }

        return array_map(
            static fn($item) => new OrderLine($item['productName'], $item['regularPrice'], $item['salesPrice']),
            $this->items
        );
    }

    public function getRecordedEvents(): iterable
    {
        // TODO: Implement getRecordedEvents() method.
    }
}