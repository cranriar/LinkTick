<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

final class ProductStatus
{
    private $value;

    public function __construct(bool $status)
    {
        $this->value = $status;
    }

    public function value(): bool
    {
        return $this->value;
    }
}
