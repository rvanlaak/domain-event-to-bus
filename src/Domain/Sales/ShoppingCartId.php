<?php

namespace App\Domain\Sales;

use Symfony\Component\Uid\Ulid;

final readonly class ShoppingCartId
{
    public string $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate(new \DateTimeImmutable('now'));
    }

    public static function create(string $id): self
    {
        return new self($id);
    }
}
