<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\CreateProductUseCase;
use Src\BoundedContext\Product\Application\GetProductByCriteriaUseCase;
use Src\BoundedContext\Product\Infrastructure\Repositories\EloquentProductRepository;

final class CreateProductController{
    private $repository;

    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
        
    }

    public function __invoke(Request $request)
    {

        $productDescription = $request->input('description');
        $productDiscoun = $request->input('discount');
        $productId = (int) 1;
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productTax = $request->input('tax');
        $productSku = $request->input('sku');
        $productStatus = $request->input('status');
        $productStock = $request->input('stock');
        $createProductUseCase = new CreateProductUseCase($this->repository);
        $createProductUseCase->__invoke(
            $productId,
            $productDescription,
            $productDiscoun,
            $productName,
            $productPrice,
            $productTax,
            $productSku,
            $productStatus,
            $productStock,
        );

        $getProductUseCase = new GetProductByCriteriaUseCase($this->repository);
        $newProduct = $getProductUseCase->__invoke($productDescription,$productName,$productSku);
        return $newProduct;

    }
}