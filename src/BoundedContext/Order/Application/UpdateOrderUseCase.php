<?php
declare(strict_types=1);
namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderDiscount;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderSubTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTax;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTotal;

final class UpdateOrderUseCase{
    private $repository;
    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        float $discount,
        float $subTotal,
        float $tax,
        float $total
    ) : void
    {
        $orderId = new OrderId($id);
        $orderDiscount = new OrderDiscount($discount);
        $orderSubTotal = new OrderSubTotal($subTotal);
        $orderTax = new OrderTax($tax);
        $orderTotal = new OrderTotal($total);
        $this->repository->update($orderId,
                        $orderDiscount,
                        $orderSubTotal,
                        $orderTax,
                        $orderTotal);
    }

}
