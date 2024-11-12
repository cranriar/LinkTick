<?php
declare(strict_types=1);
namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderDiscount;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderStatus;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderSubTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTax;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderUserId;
use Src\BoundedContext\Product\Domain\Contracts\OrderRepositoryContract;

final class CreateOrderUseCase{
    private $repository;
    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        int $userId,
        float $discount,
        float $subTotal,
        float $tax,
        float $total,
        bool $status
    ) : void
    {
        $id = new OrderId($id);
        $userId = new OrderUserId($userId);
        $discount = new OrderDiscount($discount);
        $subTotal = new OrderSubTotal($subTotal);
        $tax = new OrderTax($tax);
        $total = new OrderTotal($total);
        $status = new OrderStatus($status);

        $order = Order::create(
            $id,
            $userId,
            $discount,
            $subTotal,
            $tax,
            $total,
            $status,
        );
        $this->repository->save($order);
    }

}
