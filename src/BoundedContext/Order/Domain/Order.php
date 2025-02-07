<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain;


final class Order{
    private $id;
    private $userId;
    private $subTotal;
    private $tax;
    private $total;
    private $status;

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