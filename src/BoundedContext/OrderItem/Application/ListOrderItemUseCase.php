<?php
declare(strict_types=1);
namespace Src\BoundedContext\OrderItem\Application;

use Src\BoundedContext\OrderItem\Domain\Contracts\OrderItemRepositoryContract;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemOrderId;

final class ListOrderItemUseCase{
    private $repository;
    public function __construct(OrderItemRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $orderId) : void
    {
        $orderItemOrderId = new OrderItemOrderId($orderId);
        $this->repository->list($orderItemOrderId);
    }

}
