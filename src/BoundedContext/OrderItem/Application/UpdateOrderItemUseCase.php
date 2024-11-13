<?php
declare(strict_types=1);
namespace Src\BoundedContext\OrderItem\Application;

use Src\BoundedContext\OrderItem\Domain\Contracts\OrderItemRepositoryContract;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemDiscount;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemQuantity;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemSubTotal;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTax;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemTotal;

final class UpdateOrderItemUseCase{
    private $repository;
    public function __construct(OrderItemRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id,
                            int $quantity,
                            float $discount,
                            float $subTotal,
                            float $tax,
                            float $total) : void
    {

        $orderItemId = new OrderItemId($id);
        $orderItemQuantity = new OrderItemQuantity($quantity);
        $orderItemDiscount = new OrderItemDiscount($discount);
        $orderItemSubTotal = new OrderItemSubTotal($subTotal);
        $orderItemTax = new OrderItemTax($tax);
        $orderItemTotal = new OrderItemTotal($total);
        $this->repository->update(
            $orderItemId,
            $orderItemQuantity,
            $orderItemDiscount,
            $orderItemSubTotal,
            $orderItemTax,
            $orderItemTotal,
        );
    }

}
