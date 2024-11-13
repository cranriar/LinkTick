<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\BoundedContext\Order\Infrastructure\CreateOrderController as InfrastructureCreateOrderController;

class CreateOrderController extends Controller
{
    private $createOrderController;

    public function __construct(InfrastructureCreateOrderController $createOrderController)
    {
        $this->createOrderController = $createOrderController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function __invoke(Request $request)
     {
         // $product = $this->createProductController->__invoke($request);  
         $newOrder = $this->createOrderController->__invoke($request);
         return response($newOrder , 201);
     }
}
