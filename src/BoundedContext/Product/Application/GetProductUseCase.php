<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Application;

use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;

final class GetProductUseCase{
    private $repository;
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $ProductId)
    {
        $id = new ProductId($ProductId);
        $product = $this->repository->find($id);
        return $product;
    }
}