<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Product\Infrastructure\ListProductController as InfrastructureListProductController;

class ListProductController extends Controller
{
    private $listProductController;

    public function __construct(InfrastructureListProductController $listProductController)
    {
        $this->listProductController = $listProductController;
    }

    public function __invoke(Request $request)
    {
        $data = [];
        $products = $this->listProductController->__invoke($request);
        return response($products , 201);
    }
}
