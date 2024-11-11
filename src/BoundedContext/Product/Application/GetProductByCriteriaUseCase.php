<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Application;

use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductSku;

final class GetProductByCriteriaUseCase{
    private $repository;
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $productName,
        string $productDescription,
        string $productSku,
    )
    {
        $name  = new ProductName($productName);
        $description = new ProductDescription($productDescription);
        $sku = new ProductSku($productSku);
        $product = $this->repository->findByCriteria($name, $description,$sku);
        return $product;
    }
}