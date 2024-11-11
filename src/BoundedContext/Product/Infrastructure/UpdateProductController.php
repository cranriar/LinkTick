<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Application\UpdateProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Repositories\EloquentProductRepository;

final class UpdateProductController{
    private $repository;

    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
        
    }

    public function __invoke(Request $request)
    {
        $productDescription = $request->input('description');
        $productDiscoun = $request->input('discount');
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productSku = $request->input('sku');
        $productStatus = $request->input('status');
        $productStock = $request->input('stock');
        $productId = $request->input('id');
        $updateProductUseCase = new UpdateProductUseCase($this->repository);
        $updateProductUseCase->__invoke(
                        $productDescription,
                        $productDiscoun,
                        $productId,
                        $productName,
                        $productPrice,
                        $productSku,
                        $productStatus,
                        $productStock);

        $getProductUseCase = new GetProductUseCase($this->repository);
        $product = $getProductUseCase->__invoke($productId);
        return $product;

    }
}