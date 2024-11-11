<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Product\Infrastructure\CreateProductController as InfrastructureCreateProductController;

class CreateProductController extends Controller
{
    private $createProductController;

    public function __construct(InfrastructureCreateProductController $createProductController)
    {
        $this->createProductController = $createProductController;
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
        $newProduct = new ProductResource($this->createProductController->__invoke($request));
        return response($newProduct , 201);
    }
}