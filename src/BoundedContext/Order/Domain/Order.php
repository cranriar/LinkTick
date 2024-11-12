<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain;

use Src\BoundedContext\Order\Domain\ValueObjects\OrderDiscount;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderStatus;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderSubTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTax;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderUserId;

final class Order{
    private $id;
    private $userId;
    private $discount;
    private $subTotal;
    private $tax;
    private $total;
    private $status;
  

    public function __construct(
        OrderId $id,
        OrderUserId $userId,
        OrderDiscount $discount,
        OrderSubTotal $subTotal,
        OrderTax $tax,
        OrderTotal $total,
        OrderStatus $status
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->discount = $discount;
        $this->subTotal = $subTotal;
        $this->tax = $tax;
        $this->total = $total;
        $this->status = $status;
    }

    public function id(): OrderId
    {
        return $this->id;
    }

    public function userId(): OrderUserId{
        return $this->userId;
    }
    public function discount(): OrderDiscount{
        return $this->discount;
    }
    public function subTotal(): OrderSubTotal{
        return $this->subTotal;
    }
    public function tax(): OrderTax{
        return $this->tax;
    }
    public function total(): OrderTotal{
        return $this->total;
    }
    public function status(): OrderStatus{
        return $this->status;
    }

    public static function create(
        OrderId $id,
        OrderUserId $userId,
        OrderDiscount $discount,
        OrderSubTotal $subTotal,
        OrderTax $tax,
        OrderTotal $total,
        OrderStatus $status
    ): Order
    {
        $order = new self(
            $id,
            $userId,
            $discount,
            $subTotal,
            $tax,
            $total,
            $status,
        );

        return $order;
    }

}