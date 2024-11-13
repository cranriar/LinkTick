<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

final class ProductTax
{
    private $value;

    public function __construct(float $tax)
    {
        $this->value = $tax;
    }

    public function value(): float
    {
        return $this->value;
    }
}
