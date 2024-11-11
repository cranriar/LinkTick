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

final class DeleteProductUseCase{
    private $repository;
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $productId
    ) : void
    {
        $id = new ProductId($productId);
        $this->repository->delete($id);
    }

}
