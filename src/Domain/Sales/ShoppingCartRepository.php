<?php

namespace App\Domain\Sales;

use App\Domain\Repository;

interface ShoppingCartRepository extends Repository
{

    /**
     * This method internally registers the found aggregate root, so it can be iterated when flushing changes
     * and dispatching domain events.
     *
     * @throws \DomainException when cart was not found
     */
    public function get(ShoppingCartId $cartId): ShoppingCart;
}
