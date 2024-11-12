<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\Contracts;

use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;

interface OrderRepositoryContract
{
    public function save(Order $order): void;
    public function update(OrderId $id,Order $order): void;
    public function Delete(OrderId $id): void;
    public function find(OrderId $id): ?Order;
    public function list(): ?object;
}
