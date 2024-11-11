<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Product\Infrastructure\UpdateProductController as InfrastructureUpdateProductController;

class UpdateProductController extends Controller
{
    private $updateProductController;

    public function __construct(InfrastructureUpdateProductController $updateProductController)
    {
        $this->updateProductController = $updateProductController;
    }

    public function __invoke(Request $request)
    {
        $product = new ProductResource($this->updateProductController->__invoke($request));
        return response($product , 201);
    }
    
}
