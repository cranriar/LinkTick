<?php
declare(strict_types=1);
namespace Src\BoundedContext\OrderItem\Application;

use Src\BoundedContext\OrderItem\Domain\Contracts\OrderItemRepositoryContract;
use Src\BoundedContext\OrderItem\Domain\ValueObjects\OrderItemId;

final class CancelOrderItemUseCase{
    private $repository;
    public function __construct(OrderItemRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id) : void
    {
        $orderItemId = new OrderItemId($id);
        $this->repository->cancel($orderItemId);
    }

}
