<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderItemQuantity
{
    private $value;

    /**
     * OrderItemQuantity constructor.
     * @param int $quantity
     * @throws InvalidArgumentException
     */
    public function __construct(int $quantity)
    {
        $this->validate($quantity);
        $this->value = $quantity;
    }

    /**
     * @param int $quantity
     * @throws InvalidArgumentException
     */
    private function validate(int $quantity): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
'max_range' => 10
)
        );

        if (!filter_var($quantity, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $quantity)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }

}