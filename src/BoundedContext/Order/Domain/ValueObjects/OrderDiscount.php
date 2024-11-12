<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderDiscount
{
    private $value;

    /**
     * OrderTotal constructor.
     * @param float $discount
     * @throws InvalidArgumentException
     */
    public function __construct(float $discount)
    {
        $this->validate($discount);
        $this->value = $discount;
    }

    /**
     * @param float $discount
     * @throws InvalidArgumentException
     */
    private function validate(float $discount): void
    {
        $options = array(
            'options' => array(
                'min_range' => 0.00,
'max_range' => 1000000.00
)
        );

        if (!filter_var($discount, FILTER_VALIDATE_FLOAT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $discount)
            );
        }
    }

    public function value(): float
    {
        return $this->value;
    }

}