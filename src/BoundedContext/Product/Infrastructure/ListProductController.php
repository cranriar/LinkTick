<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Application\ListProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Repositories\EloquentProductRepository;

final class ListProductController{
    private $repository;

    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
        
    }

    public function __invoke(Request $request)
    {
        $listProductUseCase = new ListProductUseCase($this->repository);
        $products = $listProductUseCase->__invoke();
        return $products;
    }
}