<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain\Contracts;

use Src\BoundedContext\OrderItem\Domain\OrderItem;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemDiscount;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemOrderId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemQuantity;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemSubTotal;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTax;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTotal;

interface OrderItemRepositoryContract
{
    public function save(OrderItem $orderItem): void;
    public function cancel(OrderItemId $id): void;
    public function list(OrderItemOrderId $orderId): object;
    public function update(OrderItemId $id,
        OrderItemQuantity $quantity,
        OrderItemDiscount $discount,
        OrderItemSubTotal $subTotal,
        OrderItemTax $tax,
        OrderItemTotal $total,
    ): void;
}
