<?php

namespace App\UserInterface\Controller;

use App\Application\Sales\AddItemToShoppingCartCommand;
use App\Domain\CommandHandling\CommandBus;
use App\Domain\Sales\ShoppingCartId;
use Money\Money;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * While shopping, add a product to the cart.
 *
 * Controllers should be responsible for making sure the request is correct, and the data on the request is validated
 * in order to create the command.
 */
final readonly class AddItemToShoppingCart
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $this->commandBus->dispatch(new AddItemToShoppingCartCommand(
            cartId: ShoppingCartId::create($request->get('cartId')),
            productName: $request->get('productName'),
            regularPrice: Money::EUR($request->get('regularPrice')),
            salesPrice: Money::EUR($request->get('salesPrice')),
        ));

        return new JsonResponse(['status' => '200']);
    }
}
