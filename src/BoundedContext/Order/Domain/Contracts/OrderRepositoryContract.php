<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\Contracts;

use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderDiscount;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderSubTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTax;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTotal;

interface OrderRepositoryContract
{
    public function save(Order $order): OrderId;
    public function cancel(OrderId $id): void;
    public function update(OrderId $id,OrderDiscount $discount, 
                            OrderSubTotal $subTotal,
                            OrderTax $tax,
                            OrderTotal $total): void;
    public function find(OrderId $id): ?Order;
    // public function Delete(OrderId $id): void;
    // public function list(): ?object;
}
