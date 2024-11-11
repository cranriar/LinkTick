<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain;

use PhpParser\Node\Expr\Cast\Array_;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDiscount;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductPrice;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductSku;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductStatus;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductStock;

final class Product{
    private $description;
    private $discount;
    private $id;
    private $name;
    private $price;
    private $sku;
    private $status;
    private $stock;

    public function __construct(
        ProductId $id,
        ProductDescription $description,
        ProductDiscount $discount,
        ProductName $name,
        ProductPrice $price,
        ProductSku $sku,
        ProductStatus $status,
        ProductStock $stock
    )
    {
        $this->id = $id;
        $this->description = $description;
        $this->discount = $discount;
        $this->name = $name;
        $this->price = $price;
        $this->sku = $sku;
        $this->status = $status;
        $this->stock = $stock;
        // $this->id = $id;

    }

    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function discount(): ProductDiscount
    {
        return $this->discount;
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }

    public function sku(): ProductSku
    {
        return $this->sku;
    }

    public function status(): ProductStatus
    {
        return $this->status;
    }

    public function stock(): ProductStock
    {
        return $this->stock;
    }

    public static function create(
        ProductId $id,
        ProductDescription $description,
        ProductDiscount $discount,
        ProductName $name,
        ProductPrice $price,
        ProductSku $sku,
        ProductStatus $status,
        ProductStock $stock
    ): Product 
    {
        $product = new self(
            $id,
            $description,
            $discount,
            $name,
            $price,
            $sku,
            $status,
            $stock,
        );

        return $product;
    }

}