<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Application;

use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;

final class ListProductUseCase{
    private $repository;
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;        
    }
    public function __invoke()
    {
        $products = $this->repository->list();   
        return $products;
    }
}