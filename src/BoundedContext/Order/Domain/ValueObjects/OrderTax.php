<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderTax
{
    private $value;

    /**
     * OrderTotal constructor.
     * @param float $tax
     * @throws InvalidArgumentException
     */
    public function __construct(float $tax)
    {
        $this->validate($tax);
        $this->value = $tax;
    }

    /**
     * @param float $tax
     * @throws InvalidArgumentException
     */
    private function validate(float $tax): void
    {
        $options = array(
            'options' => array(
                'min_range' => 0.00,
'max_range' => 1000000.00
)
        );

        if (!filter_var($total, FILTER_VALIDATE_FLOAT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $tax)
            );
        }
    }

    public function value(): float
    {
        return $this->value;
    }

}