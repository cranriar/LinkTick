<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain;

use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemDiscount;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemOrderId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemProductId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemQuantity;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemStatus;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemSubTotal;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTax;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTotal;

final class OrderItem{
    private $id;
    private $orderId;
    private $productId;
    private $quantity;
    private $discount;
    private $subTotal;
    private $tax;
    private $total;
    private $status;
  

    public function __construct(
        OrderItemId $id,
        OrderItemOrderId $orderId,
        OrderItemProductId $productId,
        OrderItemQuantity $quantity,
        OrderItemDiscount $discount,
        OrderItemSubTotal $subTotal,
        OrderItemTax $tax,
        OrderItemTotal $total,
        OrderItemStatus $status,
    )
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->discount = $discount;
        $this->subTotal = $subTotal;
        $this->tax = $tax;
        $this->total = $total;
        $this->status = $status;
    }

    public function id(): OrderItemId
    {
        return $this->id;
    }

    public function orderId(): OrderItemOrderId{
        return $this->orderId;
    }

    public function productId(): OrderItemProductId{
        return $this->productId;
    }
    public function quantity():OrderItemQuantity{
        return $this->quantity;
    }

    public function discount(): OrderItemDiscount{
        return $this->discount;
    }
    public function subTotal(): OrderItemSubTotal{
        return $this->subTotal;
    }
    public function tax(): OrderItemTax{
        return $this->tax;
    }
    public function total(): OrderItemTotal{
        return $this->total;
    }
    public function status(): OrderItemStatus{
        return $this->status;
    }

    public static function create(
        OrderItemId $id,
        OrderItemOrderId $orderId,
        OrderItemProductId $productId,
        OrderItemQuantity $quantity,
        OrderItemDiscount $discount,
        OrderItemSubTotal $subTotal,
        OrderItemTax $tax,
        OrderItemTotal $total,
        OrderItemStatus $status
    ): OrderItem
    {
        $orderItem = new self(
            $id,
            $orderId,
            $productId,
            $quantity,
            $discount,
            $subTotal,
            $tax,
            $total,
            $status,
        );

        return $orderItem;
    }

}