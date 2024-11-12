<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderStatus
{
    private $value;

    /**
     * OrderId constructor.
     * @param bool $status
     * @throws InvalidArgumentException
     */
    public function __construct(bool $status)
    {
        $this->validate($status);
        $this->value = $status;
    }

    /**
     * @param bool $status
     * @throws InvalidArgumentException
     */
    private function validate(bool $status): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($status, FILTER_VALIDATE_BOOLEAN, $options)) {
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