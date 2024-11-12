<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderItemTotal
{
    private $value;

    /**
     * OrderItemTotal constructor.
     * @param float $total
     * @throws InvalidArgumentException
     */
    public function __construct(float $total)
    {
        $this->validate($total);
        $this->value = $total;
    }

    /**
     * @param float $total
     * @throws InvalidArgumentException
     */
    private function validate(float $total): void
    {
        $options = array(
            'options' => array(
                'min_range' => 0.00,
'max_range' => 1000000.00
)
        );

        if (!filter_var($total, FILTER_VALIDATE_FLOAT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $total)
            );
        }
    }

    public function value(): float
    {
        return $this->value;
    }

}