<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

final class ProductStock
{
    private $value;

    public function __construct(int $name)
    {
        $this->value = $name;
    }

    public function value(): int
    {
        return $this->value;
    }
}
