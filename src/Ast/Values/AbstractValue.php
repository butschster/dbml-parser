<?php

declare(strict_types=1);

namespace Butschster\Dbml\Ast\Values;

abstract class AbstractValue
{
    public function __construct(private int $offset, private $value)
    {
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
