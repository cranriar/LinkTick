<?php

declare(strict_types=1);

namespace Src\BoundedContext\OrderItem\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderItemId
{
    private $value;

    /**
     * OrderItemId constructor.
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function __construct(int $id)
    {
        $this->validate($id);
        $this->value = $id;
    }

    /**
     * @param int $tax
     * @throws InvalidArgumentException
     */
    private function validate(int $tax): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
'max_range' => 1000000
)
        );

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $id)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }

}