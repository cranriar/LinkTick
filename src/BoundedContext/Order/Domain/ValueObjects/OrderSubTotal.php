<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderSubTotal
{
    private $value;

    /**
     * OrderSubTotal constructor.
     * @param float $subTotal
     * @throws InvalidArgumentException
     */
    public function __construct(float $subTotal)
    {
        $this->validate($subTotal);
        $this->value = $subTotal;
    }

    /**
     * @param float $subTotal
     * @throws InvalidArgumentException
     */
    private function validate(float $subTotal): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1.00,
'max_range' => 1000000.00
)
        );

        if (!filter_var($subTotal, FILTER_VALIDATE_FLOAT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $subTotal)
            );
        }
    }

    public function value(): float
    {
        return $this->value;
    }

}