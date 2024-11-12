<?php
declare(strict_types=1);

namespace Src\BoundedContext\Order\Infrastructure\Repositories;

use App\Models\Order;
use Src\BoundedContext\Order\Domain\Order as DomainOrder;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderDiscount;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderStatus;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderSubTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTax;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderTotal;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderUserId;
use Src\BoundedContext\Product\Domain\Contracts\OrderRepositoryContract;

final class EloquentOrderRepository implements OrderRepositoryContract
{
    private $eloquentModelOrder;

    public function __construct()
    {
        $this->eloquentModelOrder = new Order();
    }

    public function save(DomainOrder $order) : void{
        $newProduct = $this->eloquentModelOrder;

        $data = [
            'userId' => $order->userId()->value(),
            'discount' => $order->discount()->value(),
            'subTotal' => $order->subTotal()->value(),
            'tax' => $order->tax()->value(),
            'total' => $order->total()->value(),
            'status' => $order->status()->value(),
        ];
        $newProduct->create($data);
    }

    public function update(OrderId $id, DomainOrder $order): void{
        $orderToUpdate = $this->eloquentModelOrder;
        $data = [
            'discount' => $order->discount()->value(),
            'subTotal' => $order->subTotal()->value(),
            'tax' => $order->tax()->value(),
            'total' => $order->total()->value(),
            'status' => $order->status()->value(),
        ];
        $orderToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }

    public function delete(OrderId $id): void{
        $this->eloquentModelOrder
            ->findOrFail($id->value())
            ->delete();
    }

    public function find(OrderId $id): ?DomainOrder
    {
        $order = $this->eloquentModelOrder->findOrFail($id->value());
        // Return Domain Order model
        return new DomainOrder(
            new OrderId($order->id),
            new OrderUserId($order->userId),
            new OrderDiscount($order->discount),
            new OrderSubTotal($order->name),
            new OrderTax($order->price),
            new OrderTotal($order->sku),
            new OrderStatus((bool) $order->status),
        );
    }   
    public function list(): object{
        $order = $this->eloquentModelOrder
            ->get();
        return $order;
    }

}