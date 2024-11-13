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
use Src\BoundedContext\Product\Domain\ValueObjects\ProductTax;

final class CreateProductUseCase{
    private $repository;
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        string $productDescription,
        float $productDiscount,
        string $productName,
        float $productPrice,
        float $productTax,
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
        $tax = new ProductTax($productTax);
        $sku = new ProductSku($productSku);
        $status = new ProductStatus($productStatus);
        $stock = new ProductStock($productStock);

        $product = Product::create(
            $id,
            $description,
            $discount,
            $name,
            $price,
            $tax,
            $sku,
            $status,
            $stock,
        );
        $this->repository->save($product);
    }

}
