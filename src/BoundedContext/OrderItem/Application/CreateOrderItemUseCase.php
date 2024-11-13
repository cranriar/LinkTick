<?php
declare(strict_types=1);
namespace Src\BoundedContext\OrderItem\Application;

use Src\BoundedContext\OrderItem\Domain\Contracts\OrderItemRepositoryContract;
use Src\BoundedContext\OrderItem\Domain\OrderItem;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemDiscount;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemOrderId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemProductId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemQuantity;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemStatus;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemSubTotal;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTax;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTotal;

final class CreateOrderItemUseCase{
    private $repository;
    public function __construct(OrderItemRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id,
                            int $orderId,
                            int $productId,
                            int $quantity,
                            float $discount,
                            float $subTotal,
                            float $tax,
                            float $total,
                            bool $status) : void
    {

        $orderItemId = new OrderItemId($id);
        $orderItemOrderId = new OrderItemOrderId($orderId);
        $orderItemProductId = new OrderItemProductId($productId);
        $orderItemQuantity = new OrderItemQuantity($quantity);
        $orderItemDiscount = new OrderItemDiscount($discount);
        $orderItemSubTotal = new OrderItemSubTotal($subTotal);
        $orderItemTax = new OrderItemTax($tax);
        $orderItemTotal = new OrderItemTotal($total);
        $orderItemStatus = new OrderItemStatus($status);
        $orderItem = OrderItem::create(
            $orderItemId,
            $orderItemOrderId,
            $orderItemProductId,
            $orderItemQuantity,
            $orderItemDiscount,
            $orderItemSubTotal,
            $orderItemTax,
            $orderItemTotal,
            $orderItemStatus
        );
        $this->repository->save($orderItem);
    }

}
