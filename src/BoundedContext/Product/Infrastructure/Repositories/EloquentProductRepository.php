<?php
declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure\Repositories;

use App\Models\Product as ModelsProduct;
use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
// use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
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

final class EloquentProductRepository implements ProductRepositoryContract
{
    private $eloquentModelProduct;

    public function __construct()
    {
        $this->eloquentModelProduct = new ModelsProduct();
    }

    public function save(Product $product) : void{
        $newProduct = $this->eloquentModelProduct;

        $data = [
            'description' => $product->description()->value(),
            'discount' => $product->discount()->value(),
            'name' => $product->name()->value(),
            'price' => $product->price()->value(),
            'tax' => $product->tax()->value(),
            'sku' => $product->sku()->value(),
            'status' => $product->status()->value(),
            'stock' => $product->stock()->value(),
        ];
        $newProduct->create($data);
    }

    public function update(ProductId $id, Product $product): void{
        $productToUpdate = $this->eloquentModelProduct;
        $data = [

            'description' => $product->description()->value(),
            'discount' => $product->discount()->value(),
            'name' => $product->name()->value(),
            'price' => $product->price()->value(),
            'sku' => $product->sku()->value(),
            'status' => $product->status()->value(),
            'stock' => $product->stock()->value(),
        ];
        $productToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }

    public function delete(ProductId $id): void{
        $this->eloquentModelProduct
            ->findOrFail($id->value())
            ->delete();
    }

    public function find(ProductId $id): ?Product
    {
        $product = $this->eloquentModelProduct->findOrFail($id->value());
        // Return Domain User model
        return new Product(
            new ProductId($product->id),
            new ProductDescription($product->description),
            new ProductDiscount($product->discount),
            new ProductName($product->name),
            new ProductPrice($product->price),
            new ProductTax($product->tax),
            new ProductSku($product->sku),
            new ProductStatus((bool) $product->status),
            new ProductStock($product->stock)
        );
    }

    public function findByCriteria(ProductName $productName, 
        ProductDescription $productDescription, 
        ProductSku $productSku): ?Product
    {
        $product = $this->eloquentModelProduct
            ->where('name', $productName->value())
            ->where('description', $productDescription->value())
            ->where('sku', $productSku->value())
            ->firstOrFail();
        $status = (bool) $product->status;
            return new Product(
                new ProductId($product->id),
                new ProductDescription($product->description),
                new ProductDiscount($product->discount),
                new ProductName($product->name),
                new ProductPrice($product->price),
                new ProductTax($product->tax),
                new ProductSku($product->sku),
                new ProductStatus($status),
                new ProductStock($product->stock)
            );
        
    }

    public function list(): object{
        $products = $this->eloquentModelProduct
            ->get();
        return $products;
    }

}