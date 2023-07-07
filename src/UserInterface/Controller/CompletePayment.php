<?php

namespace App\UserInterface\Controller;

use App\Application\Sales\PayShoppingCartCommand;
use App\Domain\CommandHandling\CommandBus;
use App\Domain\Sales\ShoppingCartId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Such a payment completion typically gets sent server-to-server by the payment service provider.
 *
 * Controllers should be responsible for making sure the request is correct, and the data on the request is validated
 * in order to create the command.
 */
final readonly class CompletePayment
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $this->commandBus->dispatch(new PayShoppingCartCommand(
            cartId: ShoppingCartId::create($request->get('cartId')),
            memberId: $request->get('memberId'),
            paymentMethod: $request->get('paymentMethod'),
            paidPrice: $request->get('paidPrice'),
        ));

        return new JsonResponse(['status' => '200']);
    }
}
