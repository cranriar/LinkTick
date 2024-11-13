<?php
declare(strict_types=1);
namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;

final class CancelOrderUseCase{
    private $repository;
    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
    ) : void
    {
        $orderId = new OrderId($id);
        $this->repository->cancel($orderId);
    }

}
