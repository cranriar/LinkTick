<?php
declare(strict_types=1);
namespace Src\BoundedContext\Product\Application;

use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDiscount;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductPrice;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductSku;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductStatus;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductStock;

final class CreateProductUseCase{
    private $repository;
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        string $productDescription,
        int $productDiscount,
        string $productName,
        int $productPrice,
        string $productSku,
        bool $productStatus,
        int $productStock,
    ) : void
    {
        $id = new ProductId($id);
        $description = new ProductDescription($productDescription);
        $discount = new ProductDiscount($productDiscount);
        $name = new ProductName($productName);
        $price = new ProductPrice($productPrice);
        $sku = new ProductSku($productSku);
        $status = new ProductStatus($productStatus);
        $stock = new ProductStock($productStock);

        $product = Product::create(
            $id,
            $description,
            $discount,
            $name,
            $price,
            $sku,
            $status,
            $stock,
        );
        $this->repository->save($product);
    }

}
