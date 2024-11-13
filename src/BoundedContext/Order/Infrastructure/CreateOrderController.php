<?php
declare(strict_types=1);

namespace Src\BoundedContext\Order\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Order\Application\CreateOrderUseCase;
use Src\BoundedContext\Order\Application\UpdateOrderUseCase;
use Src\BoundedContext\Order\Infrastructure\Repositories\EloquentOrderRepository;
use Src\BoundedContext\OrderItem\Application\CreateOrderItemUseCase;
use Src\BoundedContext\OrderItem\Infrastructure\Repositories\EloquentOrderItemRepository;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Repositories\EloquentProductRepository;

final class CreateOrderController{
    private $orderRepository;
    private $orderItemRepository;
    private $productRepository;

    public function __construct(EloquentOrderRepository $orderRepository, 
                                EloquentProductRepository $productRepository,
                                EloquentOrderItemRepository $orderItemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function __invoke(Request $request)
    {
        //inicializando orden 
        $id = (int) 1;
        $userId = $request->input('userId');
        $products = $request->input('products');
        $createOrderUseCase = new CreateOrderUseCase($this->orderRepository);
        $orderId = $createOrderUseCase->__invoke($id,$userId,1.00,1.00,1.00,1.00,true);
        $getProductUseCase = new GetProductUseCase($this->productRepository);
        $discount = 0;
        $subTotal = 0;
        $tax = 0;
        $total = 0;
        foreach ($products as $key => $value) {
            $product = $getProductUseCase->__invoke($value['productId']);
            if($product->stock()->value() >=  $value['quantity']){
                $newOrderItem = new CreateOrderItemUseCase($this->orderItemRepository);
                $newOrderItemId = (int) 1;
                $newOrderItemOrderId = $orderId->value();
                $newOrderItemProductId = $product->id()->value();
                $newOrderItemQuantity = (int) $value['quantity'];
                $newOrderItemDiscount = $product->discount()->value() * $value['quantity'];
                $newOrderItemSubTotal = ($product->price()->value() * $value['quantity']) - $newOrderItemDiscount;
                $newOrderItemTax = ($product->tax()->value() * $value['quantity']);
                $newOrderItemTotal = $newOrderItemSubTotal + $newOrderItemTax;
                $newOrderItem->__invoke(
                    $newOrderItemId,
                    $newOrderItemOrderId,
                    $newOrderItemProductId,
                    $newOrderItemQuantity,
                    $newOrderItemDiscount,
                    $newOrderItemSubTotal,
                    $newOrderItemTax,
                    $newOrderItemTotal,
                    true
                );
                $discount += $newOrderItemDiscount;
                $subTotal += $newOrderItemSubTotal;
                $tax += $newOrderItemTax;
                $total += $newOrderItemTotal;
            }
            
        }
        $updateOrderUseCase = new UpdateOrderUseCase($this->orderRepository);
        $updateOrderUseCase->__invoke($orderId->value(),$discount,$subTotal,$tax,$total);
    }

}
