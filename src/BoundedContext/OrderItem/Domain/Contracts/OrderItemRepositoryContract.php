<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain\Contracts;

use Src\BoundedContext\OrderItem\Domain\OrderItem;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemOrderId;

interface OrderItemRepositoryContract
{
    public function save(OrderItem $orderItem): void;
    public function update(OrderItemId $id,OrderItem $orderItem): void;
    public function Delete(OrderItemId $id): void;
    public function find(OrderItemId $id): ?OrderItem;
    public function list(OrderItemOrderId $orderId): object;
}
