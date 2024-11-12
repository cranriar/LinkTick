<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderItemStatus
{
    private $value;

    /**
     * OrderItemStatus constructor.
     * @param bool $status
     * @throws InvalidArgumentException
     */
    public function __construct(bool $status)
    {
        $this->validate($status));
        $this->value = $status);
    }

    /**
     * @param bool $status)
     * @throws InvalidArgumentException
     */
    private function validate(bool $status)): void
    {

        if (!filter_var($status, FILTER_VALIDATE_BOOL, [])) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $status)
            );
        }
    }

    public function value(): bool
    {
        return $this->value;
    }

}