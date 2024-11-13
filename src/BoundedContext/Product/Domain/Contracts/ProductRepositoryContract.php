<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\Contracts;

use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductSku;

interface ProductRepositoryContract
{
    public function save(Product $product): void;
    public function update(ProductId $id,Product $product): void;
    public function delete(ProductId $id): void;
    public function find(ProductId $id): ?Product;
    public function findByCriteria(ProductName $productName, 
                    ProductDescription $productDescription, ProductSku $productSku
                    ): ?Product;
    public function list(): object;
}
