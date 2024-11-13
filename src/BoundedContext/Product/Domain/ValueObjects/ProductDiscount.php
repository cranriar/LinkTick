<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

final class ProductDiscount
{
    private $value;

    public function __construct(float $name)
    {
        $this->value = $name;
    }

    public function value(): float
    {
        return $this->value;
    }
}
