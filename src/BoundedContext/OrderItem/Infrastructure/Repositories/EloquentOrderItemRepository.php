<?php
declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Infrastructure\Repositories;

use App\Models\OrderItem;
use Src\BoundedContext\OrderItem\Domain\Contracts\OrderItemRepositoryContract;
use Src\BoundedContext\OrderItem\Domain\OrderItem as DomainOrderItem;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemDiscount;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemOrderId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemProductId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemQuantity;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemStatus;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemSubTotal;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTax;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTotal;

final class EloquentOrderItemRepository implements OrderItemRepositoryContract
{
    private $eloquentModelOrderItem;

    public function __construct()
    {
        $this->eloquentModelOrderItem = new OrderItem();
    }

    public function save(DomainOrderItem $orderItem) : void{
        $newOrderItem = $this->eloquentModelOrderItem;

        $data = [
            'order_id' => $orderItem->orderId()->value(),
            'product_id' => $orderItem->productId()->value(),
            'quantity' => $orderItem->quantity()->value(),
            'discount' => $orderItem->discount()->value(),
            'sub_total' => $orderItem->subTotal()->value(),
            'tax' => $orderItem->tax()->value(),
            'total' => $orderItem->total()->value(),
            'status' => $orderItem->status()->value(),
        ];
        $orderId = $newOrderItem->create($data)->id;
    }

    public function update(
            OrderItemId $id,
            OrderItemQuantity $quantity,
            OrderItemDiscount $discount, 
            OrderItemSubTotal $subTotal,
            OrderItemTax $tax,
            OrderItemTotal $total): void
    {
        $orderItemToUpdate = $this->eloquentModelOrderItem;
        $data = [
            'subTotal' => $discount->value(),
            'tax' => $subTotal->value(),
            'total' => $tax->value(),
            'status' => $total->value(),
        ];
        $orderItemToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }

    public function cancel(OrderItemId $id): void{
        $this->eloquentModelOrderItem
            ->findOrFail($id->value())
            ->delete();
    }

    public function find(OrderItemId $id): ?DomainOrderItem
    {
        $order = $this->eloquentModelOrderItem->findOrFail($id->value());
        // Return Domain Order model
        return new DomainOrderItem(
            new OrderItemId($order->id),
            new OrderItemOrderId($order->order_id),
            new OrderItemProductId($order->Product_id),
            new OrderItemQuantity($order->quantity),
            new OrderItemDiscount($order->discount),
            new OrderItemSubTotal($order->name),
            new OrderItemTax($order->price),
            new OrderItemTotal($order->sku),
            new OrderItemStatus((bool) $order->status)
        );
    }   
    public function list(OrderItemOrderId $orderId): object{
        $order = $this->eloquentModelOrderItem
            ->get();
        return $order;
    }

}