<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Product\Infrastructure\GetProductController as InfrastructureGetProductController;

class GetProductController extends Controller
{
    private $getProductController;

    public function __construct(InfrastructureGetProductController $getProductController)
    {
        $this->getProductController = $getProductController;
    }

    public function __invoke(Request $request)
    {
        $product = new ProductResource($this->getProductController->__invoke($request));
        return response($product , 201);
    }
}
