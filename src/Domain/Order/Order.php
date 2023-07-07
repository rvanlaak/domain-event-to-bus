<?php

namespace App\Domain\Order;

use App\Domain\EventRecordingCapability;
use App\Domain\Sales\ShoppingCart;
use Money\Money;
use Symfony\Component\Uid\AbstractUid;

/**
 * Sample aggregate root order entity that will demonstrate how domain events get recorded when intentful events took
 * place
 */
final class Order implements AggregateRoot
{
    use EventRecordingCapability;

    public readonly OrderId $orderId;

    /**
     * Only allow constructing an order from another static named constructor.
     */
    private function __construct(
        private readonly string $memberId,
        /** @var OrderLine[] */
        private readonly array $orderLines,
        private readonly Money $paidPrice,
    )
    {
        // Generation of the aggregate root identifier OrderId is encapsulated inside the construction of the order.
        $this->orderId = new OrderId();

        $this->recordEvent(new OrderWasPaid(
            $this->orderId,
            $this->memberId,
            $this->paidPrice,
        ));
    }

    /**
     * Let the aggregate root object transform (and thereafter dispose) the shopping basket
     */
    public static function fromPaidPayment(ShoppingCart $basket, Money $paidPrice): self
    {
        return new self($basket->memberId, $basket->toOrderLines(), $paidPrice);
    }
}
